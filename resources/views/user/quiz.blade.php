<!DOCTYPE html>
<html>
<head>
    <title>Quiz - {{ $category->name }}</title>
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

        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(139, 92, 246, 0.3);
        }

        .category-title {
            font-size: 28px;
            font-weight: bold;
            color: #8b5cf6;
        }

        .progress-info {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .timer {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(239, 68, 68, 0.1);
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .timer-value {
            font-size: 20px;
            font-weight: bold;
            color: #ef4444;
        }

        .progress-bar-custom {
            width: 200px;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #8b5cf6 0%, #06b6d4 100%);
            transition: width 0.3s;
        }

        .question-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 15px;
            padding: 35px;
            margin-bottom: 30px;
            border: 2px solid rgba(139, 92, 246, 0.2);
        }

        .question-number {
            display: inline-block;
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .question-text {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
            color: white;
            line-height: 1.4;
        }

        .options {
            display: grid;
            gap: 15px;
        }

        .option-item {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .option-item:hover {
            background: rgba(139, 92, 246, 0.1);
            border-color: #8b5cf6;
            transform: translateX(5px);
        }

        .option-item input[type="radio"] {
            cursor: pointer;
            width: 20px;
            height: 20px;
            accent-color: #8b5cf6;
        }

        .option-item.selected {
            background: rgba(139, 92, 246, 0.2);
            border-color: #8b5cf6;
        }

        .option-label {
            flex: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .option-letter {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: rgba(139, 92, 246, 0.2);
            border-radius: 50%;
            font-weight: bold;
            color: #c4b5fd;
            min-width: 30px;
        }

        .option-text {
            font-size: 16px;
            color: #e2e8f0;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: space-between;
        }

        .btn-prev, .btn-next, .btn-submit {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
        }

        .btn-prev {
            background: rgba(139, 92, 246, 0.2);
            border: 2px solid #8b5cf6;
            color: #c4b5fd;
        }

        .btn-prev:hover {
            background: #8b5cf6;
            color: white;
        }

        .btn-next {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            color: white;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .back-link {
            color: #8b5cf6;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .back-link:hover {
            gap: 12px;
        }
    </style>
</head>
<body>

<div class="quiz-container">
    <a href="/quiz-home" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="quiz-header">
        <div class="category-title">{{ $category->name }}</div>
        <div class="progress-info">
            <div class="timer">
                <i class="fas fa-clock text-danger"></i>
                <span class="timer-value" id="countdown">--:--</span>
            </div>
            <div class="progress-bar-custom">
                <div class="progress-fill" id="progressFill" style="width: {{ (1 / $totalQuestions) * 100 }}%"></div>
            </div>
            <span id="progressText">1/{{ $totalQuestions }}</span>
        </div>
    </div>

    <form id="quizForm" method="POST" action="/quiz/submit">
        @csrf
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        
        @php $qNumber = 1; @endphp
        @foreach($questions as $index => $question)
        <div class="question-card" id="question-{{ $question->id }}" style="display: {{ $index == 0 ? 'block' : 'none' }};">
            <div class="question-number">Soal {{ $qNumber }}/{{ $totalQuestions }}</div>
            <div class="question-text">{{ $question->question_text }}</div>
            
            <div class="options">
                <label class="option-item">
                    <input type="radio" name="question_{{ $question->id }}" value="A" onchange="selectOption(this)">
                    <span class="option-label">
                        <span class="option-letter">A</span>
                        <span class="option-text">{{ $question->option_a }}</span>
                    </span>
                </label>

                <label class="option-item">
                    <input type="radio" name="question_{{ $question->id }}" value="B" onchange="selectOption(this)">
                    <span class="option-label">
                        <span class="option-letter">B</span>
                        <span class="option-text">{{ $question->option_b }}</span>
                    </span>
                </label>

                <label class="option-item">
                    <input type="radio" name="question_{{ $question->id }}" value="C" onchange="selectOption(this)">
                    <span class="option-label">
                        <span class="option-letter">C</span>
                        <span class="option-text">{{ $question->option_c }}</span>
                    </span>
                </label>

                <label class="option-item">
                    <input type="radio" name="question_{{ $question->id }}" value="D" onchange="selectOption(this)">
                    <span class="option-label">
                        <span class="option-letter">D</span>
                        <span class="option-text">{{ $question->option_d }}</span>
                    </span>
                </label>
            </div>

            <div class="button-group">
                <button type="button" class="btn-prev" onclick="previousQuestion()" {{ $index == 0 ? 'disabled' : '' }}>
                    <i class="fas fa-chevron-left"></i> Sebelumnya
                </button>

                @if($index == $totalQuestions - 1)
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check"></i> Selesai & Lihat Hasil
                    </button>
                @else
                    <button type="button" class="btn-next" onclick="nextQuestion()">
                        Selanjutnya <i class="fas fa-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
        @php $qNumber++; @endphp
        @endforeach
    </form>
</div>

<script>
    let currentQuestionIndex = 0;
    const totalQuestions = {{ $totalQuestions }};
    
    // Timer setup
    let timeLimitMinutes = {{ $category->time_limit ?? 10 }};
    let timeRemaining = timeLimitMinutes * 60;
    const countdownEl = document.getElementById('countdown');

    function updateTimer() {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        countdownEl.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        
        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            alert('Waktu Anda telah habis! Kuis akan otomatis dikirim.');
            document.getElementById('quizForm').submit();
        } else {
            timeRemaining--;
        }
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);

    function updateProgress() {
        const progressFill = document.getElementById('progressFill');
        const progressText = document.getElementById('progressText');
        const currentNum = currentQuestionIndex + 1;
        
        progressFill.style.width = `${(currentNum / totalQuestions) * 100}%`;
        progressText.textContent = `${currentNum}/${totalQuestions}`;
    }

    function showQuestion(index) {
        document.querySelectorAll('[id^="question-"]').forEach(el => el.style.display = 'none');
        document.getElementById('question-{{ $questions[0]->id }}').parentElement.querySelectorAll('[id^="question-"]')[index].style.display = 'block';
        currentQuestionIndex = index;
        updateProgress();
    }

    function nextQuestion() {
        if (currentQuestionIndex < totalQuestions - 1) {
            currentQuestionIndex++;
            const cards = document.querySelectorAll('.question-card');
            cards.forEach((card, idx) => {
                card.style.display = idx === currentQuestionIndex ? 'block' : 'none';
            });
            updateProgress();
        }
    }

    function previousQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            const cards = document.querySelectorAll('.question-card');
            cards.forEach((card, idx) => {
                card.style.display = idx === currentQuestionIndex ? 'block' : 'none';
            });
            updateProgress();
        }
    }

    function selectOption(input) {
        const optionItem = input.closest('.option-item');
        optionItem.parentElement.querySelectorAll('.option-item').forEach(item => {
            item.classList.remove('selected');
        });
        optionItem.classList.add('selected');
    }
</script>

</body>
</html>
