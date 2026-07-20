<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Kuis - {{ $category->name }}</title>
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

        .result-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .result-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            border: 2px solid rgba(139, 92, 246, 0.2);
            margin-bottom: 30px;
        }

        .score-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            height: 200px;
            margin: 0 auto 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            font-size: 60px;
            font-weight: bold;
            box-shadow: 0 0 40px rgba(139, 92, 246, 0.5);
        }

        .result-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .result-message {
            font-size: 18px;
            color: #a0aec0;
            margin-bottom: 30px;
        }

        .score-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .detail-box {
            background: rgba(139, 92, 246, 0.1);
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            padding: 20px;
        }

        .detail-label {
            font-size: 12px;
            text-transform: uppercase;
            color: #a0aec0;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .detail-value {
            font-size: 32px;
            font-weight: bold;
            color: #8b5cf6;
        }

        .questions-review {
            margin-top: 50px;
        }

        .review-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 25px;
            text-align: left;
        }

        .question-review-item {
            background: rgba(255, 255, 255, 0.05);
            border-left: 4px solid #8b5cf6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .question-review-item.correct {
            border-left-color: #10b981;
        }

        .question-review-item.incorrect {
            border-left-color: #ef4444;
        }

        .review-question {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            color: white;
        }

        .review-answer {
            display: grid;
            gap: 10px;
        }

        .answer-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .answer-label {
            font-weight: bold;
            width: 120px;
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

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn-home, .btn-retry {
            padding: 15px 40px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-home {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            color: white;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
            color: white;
        }

        .btn-retry {
            background: rgba(139, 92, 246, 0.2);
            border: 2px solid #8b5cf6;
            color: #c4b5fd;
        }

        .btn-retry:hover {
            background: #8b5cf6;
            color: white;
        }

        .percentage-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }

        .percentage-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
            transition: width 0.5s;
        }

        .percentage-fill.medium {
            background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
        }

        .percentage-fill.low {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .result-card {
                padding: 30px 15px;
            }

            .score-circle {
                width: 140px;
                height: 140px;
                font-size: 40px;
                margin-bottom: 20px;
            }

            .result-title {
                font-size: 26px;
            }

            .result-message {
                font-size: 15px;
            }

            .score-details {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .detail-box {
                padding: 12px;
            }

            .detail-value {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }

            .btn-home, .btn-retry {
                width: 100%;
                justify-content: center;
                padding: 12px 20px;
                font-size: 15px;
            }

            .review-title {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .question-review-item {
                padding: 15px;
            }

            .review-question {
                font-size: 14.5px;
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
                font-size: 13.5px;
            }
        }
    </style>
</head>
<body>

<div class="result-container">
    <div class="result-card">
        <div class="score-circle">{{ $score }}%</div>
        <h1 class="result-title">Review Hasil Kuis</h1>
        <p class="result-message">Kuis diselesaikan pada {{ $result->created_at->format('d M Y - H:i') }}</p>

        <div class="score-details">
            <div class="detail-box">
                <div class="detail-label">Jawaban Benar</div>
                <div class="detail-value">{{ $correctAnswers }}/{{ $totalQuestions }}</div>
            </div>
            <div class="detail-box">
                <div class="detail-label">Skor Akhir</div>
                <div class="detail-value">{{ $score }}%</div>
            </div>
            <div class="detail-box">
                <div class="detail-label">Kategori</div>
                <div class="detail-value" style="font-size: 18px;">{{ $category->name }}</div>
            </div>
        </div>

        <div class="percentage-bar">
            <div class="percentage-fill {{ $score >= 80 ? '' : ($score >= 60 ? 'medium' : 'low') }}" style="width: {{ $score }}%"></div>
        </div>
    </div>

    @if(count($questions) > 0)
    <div class="questions-review">
        <h2 class="review-title">Pembahasan Soal</h2>
        
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
                                @case('A')
                                    {{ $question->option_a }}
                                @break
                                @case('B')
                                    {{ $question->option_b }}
                                @break
                                @case('C')
                                    {{ $question->option_c }}
                                @break
                                @case('D')
                                    {{ $question->option_d }}
                                @break
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
                            @case('A')
                                {{ $question->option_a }}
                            @break
                            @case('B')
                                {{ $question->option_b }}
                            @break
                            @case('C')
                                {{ $question->option_c }}
                            @break
                            @case('D')
                                {{ $question->option_d }}
                            @break
                        @endswitch
                    </span>
                    <span class="icon-correct">✓</span>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="button-group">
        <a href="/quiz-home" class="btn-home">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
        <a href="/quiz/{{ $category->id }}" class="btn-retry">
            <i class="fas fa-redo"></i> Coba Kuis Lagi
        </a>
    </div>
</div>

</body>
</html>
