<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalQuestions = Question::count();
        $totalCategories = Category::count();
        
        $categoryScores = \DB::table('quiz_results')
            ->select('category_id', \DB::raw('AVG(score) as avg_score'))
            ->groupBy('category_id')
            ->get()
            ->pluck('avg_score', 'category_id')
            ->toArray();

        $categories = Category::with('questions')->get()->map(function ($cat) use ($categoryScores) {
            $cat->avg_score = isset($categoryScores[$cat->id]) ? round($categoryScores[$cat->id], 1) : 0;
            return $cat;
        });

        $users = User::latest()->take(5)->get();

        return view('dashboard-new', compact(
            'totalUsers',
            'totalQuestions',
            'totalCategories',
            'categories',
            'users'
        ));
    }
}
