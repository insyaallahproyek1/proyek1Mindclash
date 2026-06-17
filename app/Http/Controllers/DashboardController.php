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
        $categories = Category::with('questions')->get();
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
