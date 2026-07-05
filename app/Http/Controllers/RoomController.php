<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomUser;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Show rooms index page (create/join room)
     */
    public function index()
    {
        $categories = Category::with('questions')->get();
        
        $activeRooms = Room::with(['host', 'category'])
            ->whereIn('status', ['waiting', 'active'])
            ->where('created_at', '>=', now()->subDay())
            ->latest()
            ->get();

        return view('user.rooms.index', compact('categories', 'activeRooms'));
    }

    /**
     * Create a new room
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Nama room wajib diisi.',
            'category_id.required' => 'Pilih kategori terlebih dahulu.',
        ]);

        // Ensure category has questions to avoid infinite loop
        $category = Category::withCount('questions')->findOrFail($request->category_id);
        if ($category->questions_count === 0) {
            return back()->withErrors(['category_id' => 'Kategori yang dipilih tidak memiliki soal.'])->withInput();
        }

        // Generate unique 6 digit code
        do {
            $code = strval(rand(100000, 999999));
        } while (Room::where('code', $code)->exists());

        $room = Room::create([
            'code' => $code,
            'name' => $request->name,
            'host_id' => auth()->id(),
            'category_id' => $request->category_id,
            'status' => 'waiting',
        ]);

        // Add host to room members
        RoomUser::create([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('rooms.lobby', $code);
    }

    /**
     * Join a room with code
     */
    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'Masukkan kode room.',
        ]);

        $room = Room::where('code', $request->code)->first();

        if (!$room) {
            return back()->with('error', 'Room tidak ditemukan.');
        }

        if ($room->status === 'finished') {
            return back()->with('error', 'Kuis di room ini sudah selesai.');
        }

        // Add user to room if not already in
        $exists = RoomUser::where('room_id', $room->id)
            ->where('user_id', auth()->id())
            ->exists();

        if (!$exists) {
            RoomUser::create([
                'room_id' => $room->id,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('rooms.lobby', $room->code);
    }

    /**
     * Room lobby page
     */
    public function lobby($code)
    {
        $room = Room::with(['host', 'category', 'users'])->where('code', $code)->firstOrFail();

        return view('user.rooms.lobby', compact('room'));
    }

    /**
     * JSON API to fetch lobby members (polling)
     */
    public function members($code)
    {
        $room = Room::with('users')->where('code', $code)->firstOrFail();
        
        return response()->json([
            'status' => $room->status,
            'members' => $room->users->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'class' => $user->class,
                ];
            })
        ]);
    }

    /**
     * Start the quiz (Host only)
     */
    public function start($code)
    {
        $room = Room::where('code', $code)->firstOrFail();

        if ($room->host_id !== auth()->id()) {
            return response()->json(['error' => 'Hanya host yang dapat memulai kuis.'], 403);
        }

        $room->update(['status' => 'active']);

        return response()->json(['success' => true]);
    }

    /**
     * Render the room quiz page
     */
    public function quiz($code)
    {
        $room = Room::with('category')->where('code', $code)->firstOrFail();

        if ($room->status === 'waiting') {
            return redirect()->route('rooms.lobby', $code)->with('error', 'Kuis belum dimulai oleh host.');
        }

        if ($room->status === 'finished') {
            return redirect()->route('rooms.leaderboard', $code)->with('error', 'Kuis di room ini sudah selesai.');
        }

        // Check if user already submitted results for this room
        $hasResult = QuizResult::where('room_id', $room->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($hasResult) {
            return redirect()->route('rooms.leaderboard', $code)->with('info', 'Anda sudah mengerjakan kuis ini.');
        }

        $category = $room->category;
        $questions = Question::where('category_id', $room->category_id)->get();

        if ($questions->isEmpty()) {
            return redirect()->route('rooms.lobby', $code)->with('error', 'Kategori kuis ini tidak memiliki soal.');
        }

        $totalQuestions = $questions->count();
        $currentQuestion = 1;

        return view('user.rooms.quiz', compact('room', 'category', 'questions', 'totalQuestions', 'currentQuestion'));
    }

    /**
     * Submit room quiz answers
     */
    public function submit(Request $request, $code)
    {
        $room = Room::where('code', $code)->firstOrFail();

        // Check if already submitted
        $existing = QuizResult::where('room_id', $room->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->route('rooms.leaderboard', $code);
        }

        $questions = Question::where('category_id', $room->category_id)->get();

        $correctAnswers = 0;
        $answers = [];

        foreach ($questions as $question) {
            $userAnswer = $request->input('question_' . $question->id);
            $answers[$question->id] = $userAnswer;

            if ($userAnswer === $question->correct_answer) {
                $correctAnswers++;
            }
        }

        $totalQuestions = $questions->count();
        $percentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
        $score = round($percentage);

        // Save result linked to room_id
        QuizResult::create([
            'user_id' => auth()->id(),
            'category_id' => $room->category_id,
            'room_id' => $room->id,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'score' => $score,
            'answers' => $answers,
        ]);

        return redirect()->route('rooms.leaderboard', $code)->with('success', 'Jawaban berhasil dikirim! Menunggu peserta lain selesai.');
    }

    /**
     * Show leaderboard for the specific room
     */
    public function leaderboard($code)
    {
        $room = Room::with(['host', 'category', 'users'])->where('code', $code)->firstOrFail();

        // Get all members of the room
        $membersCount = RoomUser::where('room_id', $room->id)->count();

        // Get quiz results for this room
        $results = QuizResult::with('user')
            ->where('room_id', $room->id)
            ->orderByDesc('score')
            ->orderBy('created_at')
            ->get();

        // If all members have submitted, we can auto-finish the room
        if ($results->count() >= $membersCount && $room->status === 'active') {
            $room->update(['status' => 'finished']);
        }

        return view('user.rooms.leaderboard', compact('room', 'results', 'membersCount'));
    }

    /**
     * Finish the room manually (Host only)
     */
    public function finish($code)
    {
        $room = Room::where('code', $code)->firstOrFail();

        if ($room->host_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Hanya host yang dapat menutup kuis room.');
        }

        $room->update(['status' => 'finished']);

        return redirect()->route('rooms.leaderboard', $code)->with('success', 'Room kuis telah resmi ditutup.');
    }
}
