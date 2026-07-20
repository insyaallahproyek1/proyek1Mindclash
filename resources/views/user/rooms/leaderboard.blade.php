<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Peringkat Room - MindClash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
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

        .leaderboard-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card-custom {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            margin-bottom: 30px;
        }

        .rank-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .rank-table tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s;
        }

        .rank-table tr:hover {
            background: rgba(139, 92, 246, 0.1);
        }

        .rank-table td, .rank-table th {
            padding: 18px 15px;
            text-align: left;
        }

        .rank-table th {
            color: #c4b5fd;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: bold;
            border-bottom: 2px solid rgba(139, 92, 246, 0.3);
        }

        .rank-number {
            width: 50px;
            font-weight: bold;
            font-size: 18px;
        }

        .rank-1 { color: #ffd700; } /* Emas */
        .rank-2 { color: #c0c0c0; } /* Perak */
        .rank-3 { color: #cd7f32; } /* Perunggu */

        .score-value {
            font-weight: bold;
            font-size: 18px;
            color: #10b981;
        }

        .btn-finish-room {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-finish-room:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        }

        .btn-back-home {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back-home:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-2px);
        }

        .user-badge-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-small {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(139, 92, 246, 0.2);
            color: #c4b5fd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        /* Review Styles */
        .questions-review {
            margin-top: 30px;
        }

        .review-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: left;
            color: #c4b5fd;
            border-bottom: 2px solid rgba(139, 92, 246, 0.3);
            padding-bottom: 8px;
        }

        .question-review-item {
            background: rgba(255, 255, 255, 0.03);
            border-left: 4px solid #8b5cf6;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 15px;
            text-align: left;
        }

        .question-review-item.correct {
            border-left-color: #10b981;
            background: rgba(16, 185, 129, 0.03);
        }

        .question-review-item.incorrect {
            border-left-color: #ef4444;
            background: rgba(239, 68, 68, 0.03);
        }

        .review-question {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 12px;
            color: white;
        }

        .review-answer {
            display: grid;
            gap: 8px;
        }

        .answer-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
        }

        .answer-label {
            font-weight: bold;
            width: 110px;
            color: #cbd5e1;
        }

        .answer-text {
            color: #e2e8f0;
            flex: 1;
        }

        .answer-row.correct {
            color: #10b981;
        }

        .answer-row.incorrect {
            color: #ef4444;
        }

        .icon-correct {
            color: #10b981;
            font-weight: bold;
        }

        .icon-incorrect {
            color: #ef4444;
            font-weight: bold;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .card-custom {
                padding: 20px 15px;
                margin-bottom: 20px;
            }

            .leaderboard-container h1 {
                font-size: 24px;
            }

            .rank-table th, .rank-table td {
                padding: 12px 8px;
                font-size: 13px;
            }

            .rank-number {
                width: 35px;
                font-size: 15px;
            }

            .score-value {
                font-size: 15px;
            }

            .user-avatar-small {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .user-badge-container {
                gap: 8px;
            }

            .user-badge-container .fw-bold {
                font-size: 13px !important;
            }

            .user-badge-container .text-secondary {
                font-size: 10px !important;
            }

            .d-flex.justify-content-between.align-items-center.mt-4 {
                flex-direction: column;
                gap: 10px;
            }

            .btn-back-home, .btn-finish-room, form {
                width: 100%;
            }

            .btn-back-home, .btn-finish-room {
                justify-content: center;
                width: 100%;
                padding: 10px 15px;
                font-size: 14px;
            }

            .review-title {
                font-size: 18px;
            }

            .question-review-item {
                padding: 12px 15px;
            }

            .review-question {
                font-size: 14px;
            }

            .answer-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .answer-label {
                width: auto;
                font-size: 12px;
            }

            .answer-text {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<div class="leaderboard-container">
    @if(session('success'))
        <div class="alert alert-success" style="border-radius: 12px; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #86efac;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('info'))
        <div class="alert alert-info" style="border-radius: 12px; background: rgba(59, 130, 246, 0.1); border: 1px solid #3b82f6; color: #93c5fd;">
            <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
        </div>
    @endif

    <div class="card-custom text-center">
        <h1 class="fw-bold mb-2"><i class="fas fa-trophy text-warning"></i> Peringkat Kuis</h1>
        <div style="font-size: 16px; color: #cbd5e1; margin-bottom: 5px;">Room: <strong>{{ $room->name }}</strong></div>
        <div style="font-size: 14px; color: #a78bfa;">Kategori: <strong>{{ $room->category->name }}</strong></div>
        
        <div class="mt-3">
            @if($room->status === 'finished')
                <span class="badge bg-danger px-3 py-2 rounded-pill"><i class="fas fa-lock"></i> Kuis Ditutup</span>
            @else
                <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fas fa-spinner fa-spin"></i> Sedang Berlangsung</span>
            @endif
        </div>
    </div>

    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-3 flex-wrap gap-2">
            <h4 class="fw-bold mb-0">Klasemen Sementara</h4>
            <span class="text-secondary" style="font-size: 14px;">{{ $results->count() }} dari {{ $membersCount }} peserta selesai</span>
        </div>

        <table class="rank-table">
            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Nama Peserta</th>
                    <th>Benar</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @php $rank = 1; @endphp
                @forelse($results as $result)
                <tr class="{{ auth()->id() === $result->user_id ? 'bg-primary-subtle bg-opacity-10' : '' }}">
                    <td class="rank-number">
                        @if($rank === 1)
                            <span class="rank-1"><i class="fas fa-medal"></i> 1</span>
                        @elseif($rank === 2)
                            <span class="rank-2"><i class="fas fa-medal"></i> 2</span>
                        @elseif($rank === 3)
                            <span class="rank-3"><i class="fas fa-medal"></i> 3</span>
                        @else
                            {{ $rank }}
                        @endif
                    </td>
                    <td>
                        <div class="user-badge-container">
                            <div class="user-avatar-small">{{ substr($result->user->name, 0, 1) }}</div>
                            <div>
                                <div class="fw-bold" style="font-size: 15px;">
                                    {{ $result->user->name }}
                                    @if($result->user_id === $room->host_id)
                                        <span class="text-warning" style="font-size: 11px;"><i class="fas fa-crown"></i> Host</span>
                                    @endif
                                </div>
                                <div class="text-secondary" style="font-size: 11px;">Kelas: {{ $result->user->class ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <strong>{{ $result->correct_answers }}</strong> / {{ $result->total_questions }}
                    </td>
                    <td class="score-value">
                        {{ $result->score }}
                    </td>
                </tr>
                @php $rank++; @endphp
                @empty
                <tr>
                    <td colspan="4" class="text-center text-secondary py-5">
                        <i class="fas fa-hourglass-start fs-3 mb-3 d-block" style="opacity: 0.5;"></i>
                        Belum ada peserta yang menyelesaikan kuis.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
            <a href="{{ route('rooms.index') }}" class="btn-back-home">
                <i class="fas fa-arrow-left"></i> Kembali ke Menu Room
            </a>
            
            @if(auth()->id() === $room->host_id && $room->status === 'active')
                <form action="{{ route('rooms.finish', $room->code) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menutup kuis room ini secara resmi? Peserta yang belum selesai tidak akan bisa mengirim jawaban lagi.')">
                    @csrf
                    <button type="submit" class="btn-finish-room">
                        <i class="fas fa-lock"></i> Tutup Kuis Room
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($myResult)
    <div class="card-custom">
        <h4 class="fw-bold mb-3 text-start"><i class="fas fa-file-signature text-info"></i> Pembahasan Jawaban Kamu</h4>
        <div class="questions-review">
            @php
                $answers = $myResult->answers ?? [];
            @endphp
            @foreach($questions as $question)
            @php
                $userAnswer = $answers[$question->id] ?? null;
                $isCorrect = $userAnswer === $question->correct_answer;
            @endphp
            <div class="question-review-item {{ $isCorrect ? 'correct' : 'incorrect' }}">
                <div class="review-question">
                    {{ $question->question_text }}
                </div>
                <div class="review-answer">
                    <div class="answer-row">
                        <span class="answer-label">Jawaban Kamu:</span>
                        <span class="answer-text">
                            @if($userAnswer)
                                {{ $userAnswer }}. 
                                @switch($userAnswer)
                                    @case('A') {{ $question->option_a }} @break
                                    @case('B') {{ $question->option_b }} @break
                                    @case('C') {{ $question->option_c }} @break
                                    @case('D') {{ $question->option_d }} @break
                                @endswitch
                            @else
                                <em>Tidak dijawab / Kehabisan Waktu</em>
                            @endif
                        </span>
                        <span class="{{ $isCorrect ? 'icon-correct' : 'icon-incorrect' }}">
                            {{ $isCorrect ? '✓' : '✗' }}
                        </span>
                    </div>

                    @if(!$isCorrect)
                    <div class="answer-row correct">
                        <span class="answer-label">Jawaban Benar:</span>
                        <span class="answer-text">
                            {{ $question->correct_answer }}.
                            @switch($question->correct_answer)
                                @case('A') {{ $question->option_a }} @break
                                @case('B') {{ $question->option_b }} @break
                                @case('C') {{ $question->option_c }} @break
                                @case('D') {{ $question->option_d }} @break
                            @endswitch
                        </span>
                        <span class="icon-correct">✓</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
    // Poll the leaderboard every 4 seconds to show scores live as players complete!
    const roomStatus = "{{ $room->status }}";
    if (roomStatus === 'active') {
        setTimeout(function() {
            window.location.reload();
        }, 4000);
    }
</script>

</body>
</html>
