<!DOCTYPE html>
<html>
<head>
    <title>MindClash - Quiz Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        .navbar-top {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            margin-bottom: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #8b5cf6;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 36px;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .welcome-title {
            font-size: 48px;
            font-weight: bold;
            background: linear-gradient(135deg, #8b5cf6 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .welcome-subtitle {
            font-size: 18px;
            color: #cbd5e1;
            margin-bottom: 30px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .category-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 15px;
            padding: 30px;
            text-decoration: none;
            color: white;
            border: 2px solid transparent;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .category-card:hover {
            border-color: #8b5cf6;
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.3);
        }

        .category-card:hover::before {
            left: 100%;
        }

        .category-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #8b5cf6;
        }

        .category-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }

        .category-desc {
            font-size: 14px;
            color: #a0aec0;
            margin-bottom: 15px;
        }

        .category-count {
            display: inline-block;
            background: rgba(139, 92, 246, 0.2);
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 12px;
            color: #c4b5fd;
        }

        .start-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            transition: all 0.3s;
        }

        .start-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        }

        .footer {
            text-align: center;
            color: #64748b;
            margin-top: 50px;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 12px;
            padding: 20px;
            border: 2px solid rgba(139, 92, 246, 0.2);
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            border-color: #8b5cf6;
            transform: translateY(-3px);
        }

        .stat-icon {
            font-size: 24px;
            color: #8b5cf6;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #cbd5e1;
            font-size: 13px;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }

        .dashboard-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 50px;
        }

        @media (max-width: 992px) {
            .dashboard-row {
                grid-template-columns: 1fr;
            }
        }

        .dashboard-box {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 15px;
            padding: 25px;
            border: 2px solid rgba(139, 92, 246, 0.2);
        }

        .box-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #c4b5fd;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            padding: 12px;
            color: #a0aec0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 12px;
            text-transform: uppercase;
        }

        .history-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        .score-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
        }

        .score-high {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .score-medium {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .score-low {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .btn-review-link {
            background: rgba(139, 92, 246, 0.2);
            color: #c4b5fd;
            border: 1px solid #8b5cf6;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-review-link:hover {
            background: #8b5cf6;
            color: white;
        }
    </style>
</head>
<body>

<div class="navbar-top">
    <div class="container-main">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <i class="fas fa-brain"></i>
                MindClash
            </div>
            <div>
                <span style="margin-right: 20px;">Welcome, <strong>{{ Auth::user()->name ?? 'User' }}</strong></span>
                <a href="/logout" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container-main">
    @if(session('error'))
        <div class="alert alert-danger" style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #86efac; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    <div class="welcome-section">
        <h1 class="welcome-title">Selamat Datang di MindClash!</h1>
        <p class="welcome-subtitle">Pilih kategori dan mulai kerjakan soal-soal untuk menguji kemampuanmu</p>
        <a href="/leaderboard" style="display: inline-block; margin-top: 20px; padding: 10px 25px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(139, 92, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <i class="fas fa-trophy"></i> Lihat Peringkat Kelas
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tasks"></i></div>
            <div class="stat-label">Total Kuis</div>
            <div class="stat-value">{{ $totalQuizzes }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-percentage"></i></div>
            <div class="stat-label">Rata-Rata Skor</div>
            <div class="stat-value">{{ $avgScore }}%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-award"></i></div>
            <div class="stat-label">Skor Tertinggi</div>
            <div class="stat-value">{{ $highestScore }}%</div>
        </div>
    </div>

    <!-- Dashboard Row (Chart & History) -->
    <div class="dashboard-row">
        <!-- History Table -->
        <div class="dashboard-box">
            <h3 class="box-title"><i class="fas fa-history"></i> Riwayat Kuis Terakhir</h3>
            <div class="table-responsive">
                @if($quizResults->isEmpty())
                    <div style="text-align: center; color: #a0aec0; padding: 30px;">
                        <i class="fas fa-info-circle" style="font-size: 28px; margin-bottom: 10px;"></i>
                        <div>Belum ada kuis yang dikerjakan</div>
                    </div>
                @else
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Skor</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizResults->take(5) as $result)
                            <tr>
                                <td>{{ $result->category->name }}</td>
                                <td>
                                    <span class="score-badge {{ $result->score >= 80 ? 'score-high' : ($result->score >= 60 ? 'score-medium' : 'score-low') }}">
                                        {{ $result->score }}%
                                    </span>
                                </td>
                                <td>{{ $result->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="/quiz/review/{{ $result->id }}" class="btn-review-link">Review</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Progress Chart -->
        <div class="dashboard-box">
            <h3 class="box-title"><i class="fas fa-chart-line"></i> Perkembangan Nilaimu</h3>
            @if($quizResults->isEmpty())
                <div style="text-align: center; color: #a0aec0; padding: 30px;">
                    <i class="fas fa-chart-line" style="font-size: 28px; margin-bottom: 10px;"></i>
                    <div>Butuh minimal 1 kuis untuk grafik statistik</div>
                </div>
            @else
                <canvas id="userScoreChart" style="max-height: 250px;"></canvas>
            @endif
        </div>
    </div>

    <h2 class="welcome-title text-center" style="font-size: 32px; margin: 50px 0 20px 0; background: none; -webkit-text-fill-color: initial; color: white;">Pilih Kategori Kuis</h2>

    <div class="categories-grid">
        @foreach($categories as $category)
        <a href="/quiz/{{ $category->id }}" class="category-card">
            <div class="category-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="category-name">{{ $category->name }}</div>
            <p class="category-desc">{{ $category->description }}</p>
            <span class="category-count">{{ $category->questions->count() }} Soal</span>
            <button class="start-btn">Mulai Quiz</button>
        </a>
        @endforeach
    </div>

    <div class="footer">
        <p>&copy; 2024 MindClash. Tingkatkan pengetahuanmu setiap hari!</p>
    </div>
</div>

@if(!$quizResults->isEmpty())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('userScoreChart').getContext('2d');
        
        const rawResults = {!! json_encode($quizResults->reverse()->values()) !!};
        const dates = rawResults.map(item => {
            const date = new Date(item.created_at);
            return `${date.getDate()}/${date.getMonth() + 1}`;
        });
        const scores = rawResults.map(item => item.score);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Skor Kuis (%)',
                    data: scores,
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#06b6d4',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#a0aec0'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#a0aec0'
                        }
                    }
                }
            }
        });
    });
</script>
@endif

</body>
</html>
