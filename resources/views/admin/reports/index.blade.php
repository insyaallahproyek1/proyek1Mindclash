@extends('layouts.admin')

@section('title', 'Laporan Nilai Siswa')

@push('styles')
<style>
    .table-container {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        overflow: hidden;
        margin-bottom: 40px;
    }

    table { width: 100%; border-collapse: collapse; }
    thead { background: rgba(139, 92, 246, 0.1); border-bottom: 2px solid rgba(139, 92, 246, 0.3); }
    th { padding: 20px; text-align: left; color: #c4b5fd; font-weight: bold; text-transform: uppercase; font-size: 12px; }
    td { padding: 18px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); color: #e2e8f0; }
    tbody tr:hover { background: rgba(139, 92, 246, 0.1); }
    
    .badge { padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
    .badge.excellent { background: rgba(16, 185, 129, 0.2); color: #86efac; }
    .badge.good { background: rgba(59, 130, 246, 0.2); color: #93c5fd; }
    .badge.poor { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }

    .btn-action { padding: 8px 15px; border: none; border-radius: 8px; font-size: 12px; cursor: pointer; transition: all 0.3s; text-decoration: none; color: white; display: inline-block; margin-right: 5px; }
    .btn-export { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; display: inline-block; transition: all 0.3s; }
    .btn-export:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4); color: white;}
</style>
@endpush

@section('content')

    @if (session('success'))
        <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid #22c55e; border-radius: 8px; padding: 15px; margin-bottom: 25px; color: #86efac;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 class="section-title" style="margin: 0;"><i class="fas fa-file-alt"></i> Riwayat Pengerjaan Kuis</h3>
        <a href="/reports/print" class="btn-export"><i class="fas fa-print"></i> Cetak Laporan</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Nama Siswa</th>
                    <th>Kategori Kuis</th>
                    <th>Benar / Total</th>
                    <th>Skor Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr>
                    <td style="font-size: 13px; color: #a0aec0;">{{ $report->created_at->format('d M Y, H:i') }}</td>
                    <td><strong>{{ $report->user->name ?? 'User Dihapus' }}</strong> <br><small style="color: #64748b;">Kelas {{ $report->user->class ?? '-' }}</small></td>
                    <td>{{ $report->category->name ?? 'Kategori Dihapus' }}</td>
                    <td>{{ $report->correct_answers }} / {{ $report->total_questions }}</td>
                    <td>
                        <span class="badge {{ $report->score >= 80 ? 'excellent' : ($report->score >= 60 ? 'good' : 'poor') }}" style="font-size: 14px;">
                            {{ $report->score }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #a0aec0; padding: 40px;">
                        <i class="fas fa-history" style="font-size: 32px; margin-bottom: 10px;"></i>
                        <div>Belum ada riwayat pengerjaan kuis</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
