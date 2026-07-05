@extends('layouts.admin')

@section('page_title', 'Dashboard Admin - MindClash')

@section('title')
    <i class="fas fa-tachometer-alt"></i> Dashboard Admin
@endsection

@push('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        padding: 25px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        transition: all 0.3s;
    }

    .stat-card:hover {
        border-color: #8b5cf6;
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 15px;
    }

    .stat-icon.users {
        background: rgba(59, 130, 246, 0.2);
        color: #3b82f6;
    }

    .stat-icon.questions {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
    }

    .stat-icon.categories {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
    }

    .stat-icon.scores {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
    }

    .stat-label {
        color: #a0aec0;
        font-size: 12px;
        text-transform: uppercase;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .stat-value {
        font-size: 32px;
        font-weight: bold;
        color: white;
    }

    .stat-change {
        font-size: 12px;
        margin-top: 10px;
        color: #10b981;
    }

    .table-container {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        overflow-x: auto;
        margin-bottom: 40px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: rgba(139, 92, 246, 0.1);
        border-bottom: 2px solid rgba(139, 92, 246, 0.3);
    }

    th {
        padding: 20px;
        text-align: left;
        color: #c4b5fd;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        white-space: nowrap;
    }

    td {
        padding: 18px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        color: #e2e8f0;
        white-space: nowrap;
    }

    tbody tr:hover {
        background: rgba(139, 92, 246, 0.1);
    }

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .badge.category {
        background: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
    }

    .badge.online {
        background: rgba(16, 185, 129, 0.2);
        color: #86efac;
    }

    .btn-action {
        padding: 8px 15px;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: white;
        display: inline-block;
    }

    .btn-edit {
        background: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
    }

    .btn-edit:hover {
        background: #3b82f6;
        color: white;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: bold;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    .chart-container {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        padding: 25px;
        margin-bottom: 40px;
    }
</style>
@endpush

@section('content')
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon users">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-label">Total Pengguna</div>
            <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
            <div class="stat-change"><i class="fas fa-arrow-up"></i> +12% dari bulan lalu</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon questions">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="stat-label">Total Soal</div>
            <div class="stat-value">{{ $totalQuestions ?? 0 }}</div>
            <div class="stat-change"><i class="fas fa-arrow-up"></i> +8 soal baru</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon categories">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-label">Kategori</div>
            <div class="stat-value">{{ $totalCategories ?? 0 }}</div>
            <div class="stat-change">Sempurna untuk SMP</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon scores">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-label">Rata-Rata Skor</div>
            <div class="stat-value">78%</div>
            <div class="stat-change"><i class="fas fa-arrow-up"></i> Meningkat</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="chart-container">
                <h3 class="section-title" style="margin-top: 0;">
                    <i class="fas fa-chart-bar"></i>
                    Jumlah Soal Per Kategori
                </h3>
                <canvas id="categoriesChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="chart-container">
                <h3 class="section-title" style="margin-top: 0;">
                    <i class="fas fa-chart-line"></i>
                    Rata-rata Skor Siswa Per Kategori
                </h3>
                <canvas id="scoresChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <h3 class="section-title">
        <i class="fas fa-book"></i>
        Daftar Kategori
    </h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Soal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories ?? [] as $category)
                <tr>
                    <td><span class="badge category">{{ $category->name }}</span></td>
                    <td>{{ $category->description }}</td>
                    <td><strong>{{ $category->questions->count() }}</strong> soal</td>
                    <td>
                        <a href="/questions?category={{ $category->id }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Kelola
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #a0aec0; padding: 40px;">
                        <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px;"></i>
                        <div>Belum ada kategori</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Users -->
    <h3 class="section-title">
        <i class="fas fa-user-circle"></i>
        Pengguna Terbaru
    </h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge online"><i class="fas fa-circle"></i> Aktif</span></td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #a0aec0; padding: 40px;">
                        <i class="fas fa-users" style="font-size: 32px; margin-bottom: 10px;"></i>
                        <div>Belum ada pengguna</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script>
// Chart untuk Kategori Soal
const ctx = document.getElementById('categoriesChart');
if (ctx) {
    const categories = {!! json_encode($categories->pluck('name') ?? []) !!};
    const counts = {!! json_encode($categories->pluck('questions')->map->count() ?? []) !!};

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: categories,
            datasets: [{
                label: 'Jumlah Soal',
                data: counts,
                backgroundColor: [
                    'rgba(139, 92, 246, 0.6)',
                    'rgba(59, 130, 246, 0.6)',
                    'rgba(16, 185, 129, 0.6)',
                    'rgba(245, 158, 11, 0.6)',
                    'rgba(168, 85, 247, 0.6)',
                    'rgba(217, 70, 239, 0.6)',
                    'rgba(6, 182, 212, 0.6)',
                    'rgba(34, 197, 94, 0.6)'
                ],
                borderColor: [
                    'rgba(139, 92, 246, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(168, 85, 247, 1)',
                    'rgba(217, 70, 239, 1)',
                    'rgba(6, 182, 212, 1)',
                    'rgba(34, 197, 94, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#cbd5e1'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
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
}

// Chart untuk Rata-rata Skor Per Kategori
const ctxScores = document.getElementById('scoresChart');
if (ctxScores) {
    const categories = {!! json_encode($categories->pluck('name') ?? []) !!};
    const avgScores = {!! json_encode($categories->pluck('avg_score') ?? []) !!};

    new Chart(ctxScores, {
        type: 'line',
        data: {
            labels: categories,
            datasets: [{
                label: 'Rata-rata Skor (%)',
                data: avgScores,
                backgroundColor: 'rgba(6, 182, 212, 0.2)',
                borderColor: 'rgba(6, 182, 212, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#8b5cf6',
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#cbd5e1'
                    }
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
}
</script>
@endpush
