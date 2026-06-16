<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Create Question - MindClash</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: #0f172a;
        color: white;
        font-family: Arial, sans-serif;
    }
    .container {
        margin-top: 50px;
        margin-bottom: 50px;
        max-width: 700px;
    }
    .card {
        background: #1e293b;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    }
    .form-label {
        color: #cbd5e1;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .form-control, .form-select {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
        border-radius: 10px;
        padding: 12px;
    }
    .form-control:focus, .form-select:focus {
        background: rgba(255,255,255,0.05);
        border-color: #7c3aed;
        color: white;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
    }
    .form-control::placeholder {
        color: #64748b;
    }
    .form-select option {
        background: #1e293b;
        color: white;
    }
    .btn-primary {
        background: #7c3aed;
        border: none;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: bold;
    }
    .btn-primary:hover {
        background: #8b5cf6;
    }
    .btn-secondary {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="container">
<div class="card p-4 p-md-5">
<h2 class="mb-4 fw-bold">Add Question</h2>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form method="POST" action="{{ route('questions.store') }}">
    @csrf

    <label class="form-label mt-2">Category</label>
    <select name="category_id" class="form-select mb-3 @error('category_id') is-invalid @enderror" required>
        <option value="">-- Select Category --</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    @error('category_id')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label mt-2">Question Text</label>
    <textarea name="question_text" class="form-control mb-3 @error('question_text') is-invalid @enderror"
              placeholder="Enter the main question here..." required rows="4">{{ old('question_text') }}</textarea>
    @error('question_text')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label mt-2">Option A</label>
    <input type="text" name="option_a" class="form-control mb-3 @error('option_a') is-invalid @enderror"
           placeholder="Type option A" value="{{ old('option_a') }}" required>
    @error('option_a')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label mt-2">Option B</label>
    <input type="text" name="option_b" class="form-control mb-3 @error('option_b') is-invalid @enderror"
           placeholder="Type option B" value="{{ old('option_b') }}" required>
    @error('option_b')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label mt-2">Option C</label>
    <input type="text" name="option_c" class="form-control mb-3 @error('option_c') is-invalid @enderror"
           placeholder="Type option C" value="{{ old('option_c') }}" required>
    @error('option_c')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label mt-2">Option D</label>
    <input type="text" name="option_d" class="form-control mb-3 @error('option_d') is-invalid @enderror"
           placeholder="Type option D" value="{{ old('option_d') }}" required>
    @error('option_d')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <label class="form-label mt-2">Correct Answer</label>
    <select name="correct_answer" class="form-select mb-4 @error('correct_answer') is-invalid @enderror" required>
        <option value="">-- Select Correct Answer --</option>
        <option value="A" {{ old('correct_answer') == 'A' ? 'selected' : '' }}>A</option>
        <option value="B" {{ old('correct_answer') == 'B' ? 'selected' : '' }}>B</option>
        <option value="C" {{ old('correct_answer') == 'C' ? 'selected' : '' }}>C</option>
        <option value="D" {{ old('correct_answer') == 'D' ? 'selected' : '' }}>D</option>
    </select>
    @error('correct_answer')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <div class="d-flex gap-2 mt-2">
        <button type="submit" class="btn btn-primary">Save Question</button>
        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
</div>
</div>

</body>
</html>