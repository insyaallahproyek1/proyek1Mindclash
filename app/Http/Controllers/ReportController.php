<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $reports = QuizResult::with(['user', 'category'])->orderBy('created_at', 'desc')->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function print()
    {
        $reports = QuizResult::with(['user', 'category'])->orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('admin.reports.print', compact('reports'));
        return $pdf->download('Laporan-Nilai-Siswa-' . date('d-m-Y') . '.pdf');
    }
}
