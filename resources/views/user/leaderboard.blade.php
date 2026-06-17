<!DOCTYPE html>
<html>
<head>
    <title>MindClash - Peringkat Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .page-header {
            color: white;
            margin-bottom: 40px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 1.1rem;
        }

        .back-btn-container {
            margin-bottom: 20px;
        }

        .back-btn-container a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn-container a:hover {
            text-decoration: underline;
        }

        .leaderboard-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #667eea;
        }

        thead th {
            padding: 15px;
            text-align: center;
            color: #333;
            font-weight: 600;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody td {
            padding: 15px;
            text-align: center;
        }

        tbody td:first-child {
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        tbody td:nth-child(2) {
            text-align: left;
        }

        .student-name {
            font-weight: 500;
            color: #333;
        }

        .current-user {
            color: #667eea;
            font-size: 0.85rem;
        }

        .score-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
            font-size: 1rem;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-excellent {
            background-color: #d4edda;
            color: #155724;
        }

        .status-good {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-need-improve {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-not-started {
            color: #ff6b6b;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .footer-stat {
            text-align: center;
            padding: 10px;
        }

        .stat-value {
            color: #667eea;
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .motivational {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid white;
            color: white;
            padding: 15px 20px;
            margin-top: 30px;
            border-radius: 8px;
            backdrop-filter: blur(10px);
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .motivational-icon {
            font-size: 1.5rem;
        }

        .motivational-text strong {
            display: block;
            margin-bottom: 5px;
        }

        .action-buttons {
            margin-top: 30px;
            text-align: center;
        }

        .action-buttons a {
            background: white;
            color: #667eea;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s;
            margin: 0 10px;
        }

        .action-buttons a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }
            table th, table td {
                padding: 10px !important;
            }
            .page-header h1 {
                font-size: 1.8rem;
            }
        }

        .empty-state {
            padding: 30px;
            text-align: center;
            color: #999;
        }

        .empty-state i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="page-header">
        <h1>🏆 Peringkat Kelas</h1>
        <p>Kelas {{ $classCode }} - Motivasi Dirimu untuk Belajar Lebih Baik!</p>
    </div>

    <!-- Back Button -->
    <div class="back-btn-container">
        <a href="/quiz-home">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Leaderboard Card -->
    <div class="leaderboard-card">
        <!-- Card Header -->
        <div class="card-header">
            <h2><i class="fas fa-chart-bar"></i> Daftar Peringkat Siswa</h2>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">Peringkat</th>
                        <th style="width: 40%; text-align: left;">Nama Siswa</th>
                        <th style="width: 20%;">Rata-rata Skor</th>
                        <th style="width: 15%;">Quiz Dikerjakan</th>
                        <th style="width: 15%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaderboard as $index => $student)
                        @php
                            $rank = $index + 1;
                            $isCurrentUser = $student->user_id === $currentUser->id;
                            $bgColor = $isCurrentUser ? '#e7f3ff' : ($index % 2 === 0 ? '#ffffff' : '#f8f9fa');
                            $medalIcon = '';
                            if ($rank === 1) {
                                $medalIcon = '🥇';
                            } elseif ($rank === 2) {
                                $medalIcon = '🥈';
                            } elseif ($rank === 3) {
                                $medalIcon = '🥉';
                            }
                        @endphp
                        <tr style="background-color: {{ $bgColor }}; {{ $isCurrentUser ? 'border-left: 5px solid #667eea;' : '' }}">
                            <td style="font-weight: 600; font-size: 1.1rem;">
                                {{ $medalIcon ?: '#' . $rank }}
                            </td>
                            <td style="text-align: left;">
                                <div class="student-name">{{ $student->name }}</div>
                                @if($isCurrentUser)
                                    <span class="current-user">← Kamu</span>
                                @endif
                            </td>
                            <td>
                                <div class="score-badge">
                                    {{ number_format($student->avg_score, 1) }}%
                                </div>
                            </td>
                            <td style="color: #666;">
                                {{ $student->total_quizzes }} Quiz
                            </td>
                            <td>
                                @if($student->total_quizzes === 0)
                                    <span class="status-badge status-not-started">Belum Mulai</span>
                                @elseif($student->avg_score >= 80)
                                    <span class="status-badge status-excellent">✓ Luar Biasa!</span>
                                @elseif($student->avg_score >= 60)
                                    <span class="status-badge status-good">⚡ Bagus</span>
                                @else
                                    <span class="status-badge status-need-improve">📚 Terus Belajar</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    Belum ada data peringkat. Mulai kerjakan quiz sekarang!
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Stats -->
        <div class="card-footer">
            <div class="footer-stat">
                <div class="stat-value">{{ count($leaderboard) }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>
            <div class="footer-stat">
                <div class="stat-value">{{ $leaderboard->count() > 0 ? number_format($leaderboard->first()->avg_score, 1) : '0' }}</div>
                <div class="stat-label">Skor Tertinggi</div>
            </div>
            <div class="footer-stat">
                <div class="stat-value">{{ $leaderboard->count() > 0 ? number_format($leaderboard->avg('avg_score'), 1) : '0' }}</div>
                <div class="stat-label">Rata-rata Kelas</div>
            </div>
        </div>
    </div>

    <!-- Motivational Message -->
    <div class="motivational">
        <div class="motivational-icon">💪</div>
        <div>
            <strong>Motivasi Belajar:</strong> Lihat posisimu dan terus tingkatkan nilai! Setiap quiz adalah kesempatan untuk belajar dan berkembang. Kerja keras akan membawa hasil! 🎯
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="/quiz-home">
            <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Quiz
        </a>
    </div>
</div>

</body>
</html>
