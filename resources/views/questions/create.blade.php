@extends('layouts.admin')

@section('page_title', 'Tambah Soal - MindClash')

@section('title')
    <i class="fas fa-plus"></i> Tambah Soal Baru
@endsection

@push('styles')
<style>
    .form-container {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        padding: 30px;
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #c4b5fd;
        font-weight: 600;
        font-size: 14px;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        color: #e2e8f0;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #8b5cf6;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 10px rgba(139, 92, 246, 0.3);
        color: white;
    }

    .form-control::placeholder {
        color: #64748b;
    }

    .form-select option {
        background: #0f172a;
        color: white;
    }

    .btn-save {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: bold;
        flex: 1;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    .btn-cancel {
        background: rgba(139, 92, 246, 0.2);
        color: #c4b5fd;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-block;
        text-align: center;
        flex: 1;
    }
    
    .btn-cancel:hover {
        background: rgba(139, 92, 246, 0.3);
        color: #c4b5fd;
    }
    
    .invalid-feedback {
        color: #fca5a5;
        font-size: 12px;
        margin-top: 5px;
    }
</style>
@endpush

@section('content')
<div class="form-container">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; color: #fca5a5;">
        <strong>Error!</strong> Mohon periksa kembali isian form Anda.
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('questions.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Kategori <span style="color: #ef4444;">*</span></label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Teks Pertanyaan <span style="color: #ef4444;">*</span></label>
            <textarea name="question_text" class="form-control @error('question_text') is-invalid @enderror"
                      placeholder="Masukkan pertanyaan di sini..." required rows="4">{{ old('question_text') }}</textarea>
            @error('question_text')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Pilihan A <span style="color: #ef4444;">*</span></label>
            <input type="text" name="option_a" class="form-control @error('option_a') is-invalid @enderror"
                   placeholder="Teks pilihan A" value="{{ old('option_a') }}" required>
            @error('option_a')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Pilihan B <span style="color: #ef4444;">*</span></label>
            <input type="text" name="option_b" class="form-control @error('option_b') is-invalid @enderror"
                   placeholder="Teks pilihan B" value="{{ old('option_b') }}" required>
            @error('option_b')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Pilihan C <span style="color: #ef4444;">*</span></label>
            <input type="text" name="option_c" class="form-control @error('option_c') is-invalid @enderror"
                   placeholder="Teks pilihan C" value="{{ old('option_c') }}" required>
            @error('option_c')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Pilihan D <span style="color: #ef4444;">*</span></label>
            <input type="text" name="option_d" class="form-control @error('option_d') is-invalid @enderror"
                   placeholder="Teks pilihan D" value="{{ old('option_d') }}" required>
            @error('option_d')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Jawaban Benar <span style="color: #ef4444;">*</span></label>
            <select name="correct_answer" class="form-select @error('correct_answer') is-invalid @enderror" required>
                <option value="">-- Pilih Jawaban Benar --</option>
                <option value="A" {{ old('correct_answer') == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('correct_answer') == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('correct_answer') == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('correct_answer') == 'D' ? 'selected' : '' }}>D</option>
            </select>
            @error('correct_answer')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Soal</button>
            <a href="{{ route('questions.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>
@endsection