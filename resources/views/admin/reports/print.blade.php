<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            color: #666;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead {
            background-color: #f0f0f0;
        }
        th {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            background-color: #e0e0e0;
        }
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .excellent {
            background-color: #d4edda;
            color: #155724;
        }
        .good {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .poor {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .footer-item {
            margin-top: 30px;
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Nilai Siswa</h1>
        <p>MindClash - Platform Kuis Interaktif</p>
    </div>

    <div class="info">
        <div>
            <strong>Tanggal Cetak:</strong> {{ date('d F Y H:i') }}
        </div>
        <div>
            <strong>Total Riwayat:</strong> {{ count($reports) }} data
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 12%;">Waktu</th>
                <th style="width: 15%;">Nama Siswa</th>
                <th style="width: 15%;">Kelas</th>
                <th style="width: 20%;">Kategori Kuis</th>
                <th style="width: 12%;">Benar / Total</th>
                <th style="width: 12%;">Skor Akhir</th>
                <th style="width: 14%;">Grade</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $report->user->name ?? 'User Dihapus' }}</td>
                    <td>{{ $report->user->class ?? '-' }}</td>
                    <td>{{ $report->category->name ?? 'Kategori Dihapus' }}</td>
                    <td style="text-align: center;">{{ $report->correct_answers }} / {{ $report->total_questions }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $report->score }}</td>
                    <td style="text-align: center;">
                        <span class="badge {{ $report->score >= 80 ? 'excellent' : ($report->score >= 60 ? 'good' : 'poor') }}">
                            @if($report->score >= 80)
                                A (Sangat Baik)
                            @elseif($report->score >= 70)
                                B (Baik)
                            @elseif($report->score >= 60)
                                C (Cukup)
                            @else
                                D (Kurang)
                            @endif
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px;">
                        Belum ada riwayat pengerjaan kuis
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div style="margin-bottom: 20px; font-size: 9px; color: #999;">
            <strong>Keterangan Grade:</strong><br>
            A (80-100) = Sangat Baik | B (70-79) = Baik | C (60-69) = Cukup | D (&lt;60) = Kurang
        </div>
        <table style="border: none; width: 100%; margin-top: 30px;">
            <tr>
                <td style="border: none; text-align: center; padding: 0;">
                    <div class="footer-item">
                        <div style="border-top: 1px solid #333; padding-top: 5px;">
                            Admin MindClash<br>
                            <small style="color: #999;">{{ date('d F Y') }}</small>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
