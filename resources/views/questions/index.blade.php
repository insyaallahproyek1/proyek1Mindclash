<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Questions - MindClash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body{background:#0f172a;color:white;font-family:Arial;}
        .container{margin-top:50px;}
        .card-box{background:#1e293b;border-radius:20px;padding:25px;box-shadow:0 0 20px rgba(0,0,0,0.3);}
        .muted{color:#94a3b8;}
        .q-title{color:#e2e8f0;margin-bottom:10px;font-weight:700;}
        .options{display:grid;grid-template-columns:1fr;gap:8px;}
        .opt{background:#0b1220;border:1px solid rgba(148,163,184,.25);border-radius:12px;padding:10px 12px;}
        .badge-cat{background:#7c3aed;}
        .btn-primary{background:#7c3aed;border:none;}
        .btn-primary:hover{background:#8b5cf6;}
        .action-buttons{display:flex;gap:8px;margin-top:15px;}
        .action-buttons a,.action-buttons button{font-size:0.875rem;padding:0.25rem 0.75rem;}
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Questions</h1>
            <div class="muted">Total: {{ $questions->count() }}</div>
        </div>
        <a href="{{ route('questions.create') }}" class="btn btn-primary">+ Add Question</a>
    </div>

    @if ($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @forelse ($questions as $question)
    <div class="card-box mb-4">
        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
            <div class="q-title" style="flex:1;">
                {{ $question->question_text }}
            </div>
            <div class="action-buttons">
                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $question->id }}">Delete</button>
            </div>
        </div>

        <div class="muted mb-3">
            Category: <span class="badge rounded-pill badge-cat px-3 py-2">{{ $question->category->name ?? '-' }}</span>
        </div>

        <div class="options">
            <div class="opt">A: {{ $question->option_a }}</div>
            <div class="opt">B: {{ $question->option_b }}</div>
            <div class="opt">C: {{ $question->option_c }}</div>
            <div class="opt">D: {{ $question->option_d }}</div>
        </div>

        <div class="mt-3 muted">
            Correct Answer: <b>{{ $question->correct_answer }}</b>
        </div>
    </div>
    @empty
    <div class="card-box">
        <div class="muted">No questions found.</div>
    </div>
    @endforelse
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Delete this question?')) {
                let token = '{{ csrf_token() }}';
                fetch(`/questions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                })
                .then(() => location.reload())
                .catch(e => alert('Error: ' + e));
            }
        });
    });
});
</script>

</body>
</html>
</body>
</html>
