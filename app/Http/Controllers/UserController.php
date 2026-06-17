<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show home page with all categories for users
     */
    public function home()
    {
        $categories = Category::with('questions')->get();
        return view('user.home', compact('categories'));
    }

    /**
     * Show quiz for selected category
     */
    public function showQuiz($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $questions = Question::where('category_id', $categoryId)
            ->get();

        if ($questions->isEmpty()) {
            return redirect('/quiz-home')->with('error', 'Tidak ada soal untuk kategori ini');
        }

        $totalQuestions = $questions->count();
        $currentQuestion = 1;

        return view('user.quiz', compact('category', 'questions', 'totalQuestions', 'currentQuestion'));
    }

    /**
     * Submit quiz answers and show results
     */
    public function submitQuiz(Request $request)
    {
        $categoryId = $request->input('category_id');
        $category = Category::findOrFail($categoryId);
        $questions = Question::where('category_id', $categoryId)->get();

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
        $percentage = round(($correctAnswers / $totalQuestions) * 100, 2);
        $score = round($percentage);

        // Save quiz result to database
        QuizResult::create([
            'user_id' => auth()->id(),
            'category_id' => $categoryId,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'score' => $score,
        ]);

        return view('user.result', compact(
            'category',
            'questions',
            'correctAnswers',
            'totalQuestions',
            'percentage',
            'score',
            'answers'
        ));
    }

    /**
     * Show leaderboard for current user's class
     */
    public function leaderboard()
    {
        $currentUser = auth()->user();
        $classCode = $currentUser->class;

        if (!$classCode) {
            return redirect('/quiz-home')->with('error', 'Kelas belum ditentukan');
        }

        // Get all users in the same class
        $usersInClass = \App\Models\User::where('class', $classCode)
            ->where('role', 'user')
            ->get();

        // Get leaderboard data
        $leaderboard = $usersInClass->map(function ($user) {
            $quizResults = QuizResult::where('user_id', $user->id)->get();
            $avgScore = $quizResults->count() > 0 
                ? round($quizResults->avg('score'), 2)
                : 0;
            $totalQuizzes = $quizResults->count();

            return (object) [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avg_score' => $avgScore,
                'total_quizzes' => $totalQuizzes,
                'class' => $user->class,
            ];
        })
        ->sortByDesc('avg_score')
        ->values();

        return view('user.leaderboard', compact('leaderboard', 'classCode', 'currentUser'));
    }
}
