<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Question - MindClash</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background:#0f172a;
    color:white;
}
.card{
    background:#1e293b;
    border:none;
    border-radius:20px;
}
.container{
    margin-top:50px;
    max-width:700px;
}
.btn-primary{
    background:#7c3aed;
    border:none;
}
.btn-primary:hover{
    background:#8b5cf6;
}
.form-control, .form-select{
    background:#0f172a;
    border:1px solid #475569;
    color:white;
}
.form-control:focus, .form-select:focus{
    background:#0f172a;
    border-color:#7c3aed;
    color:white;
    box-shadow:0 0 0 0.2rem rgba(124, 58, 237, 0.25);
}
.form-select option{
    background:#1e293b;
    color:white;
}
</style>
</head>
<body>

<div class="container">
<div class="card p-4">
<h2 class="mb-4">Edit Question</h2>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form method="POST" action="{{ route('questions.update', $question->id) }}">
    @csrf
    @method('PUT')

    <label class="form-label">Category</label>
    <select name="category_id" class="form-select mb-3 @error('category_id') is-invalid @enderror" required>
        <option value="">-- Select Category --</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id', $question->category_id) == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    @error('category_id')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label">Question Text</label>
    <textarea name="question_text" class="form-control mb-3 @error('question_text') is-invalid @enderror"
              placeholder="Enter the question" required rows="3">{{ old('question_text', $question->question_text) }}</textarea>
    @error('question_text')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label">Option A</label>
    <input type="text" name="option_a" class="form-control mb-3 @error('option_a') is-invalid @enderror"
           placeholder="Option A" value="{{ old('option_a', $question->option_a) }}" required>
    @error('option_a')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label">Option B</label>
    <input type="text" name="option_b" class="form-control mb-3 @error('option_b') is-invalid @enderror"
           placeholder="Option B" value="{{ old('option_b', $question->option_b) }}" required>
    @error('option_b')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label">Option C</label>
    <input type="text" name="option_c" class="form-control mb-3 @error('option_c') is-invalid @enderror"
           placeholder="Option C" value="{{ old('option_c', $question->option_c) }}" required>
    @error('option_c')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label">Option D</label>
    <input type="text" name="option_d" class="form-control mb-3 @error('option_d') is-invalid @enderror"
           placeholder="Option D" value="{{ old('option_d', $question->option_d) }}" required>
    @error('option_d')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label">Correct Answer</label>
    <select name="correct_answer" class="form-select mb-3 @error('correct_answer') is-invalid @enderror" required>
        <option value="">-- Select Answer --</option>
        <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
        <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
        <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
        <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
    </select>
    @error('correct_answer')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Update Question</button>
        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
</div>
</div>

</body>
</html>
