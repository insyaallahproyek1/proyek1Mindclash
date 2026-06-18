@extends('layouts.admin')

@section('title', 'Edit Kategori')

@push('styles')
<style>
    .form-container {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        padding: 30px;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #c4b5fd;
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        color: #e2e8f0;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #8b5cf6;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 10px rgba(139, 92, 246, 0.3);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-save {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        color: white;
        flex: 1;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    .btn-cancel {
        background: rgba(139, 92, 246, 0.2);
        color: #c4b5fd;
        flex: 1;
    }

    .btn-cancel:hover {
        background: rgba(139, 92, 246, 0.3);
    }

    .error-message {
        color: #fca5a5;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-group.error input,
    .form-group.error textarea {
        border-color: #ef4444;
    }
</style>
@endpush

@section('content')

<div style="margin-bottom: 25px;">
    <h3 class="section-title"><i class="fas fa-edit"></i> Edit Kategori</h3>
</div>

@if ($errors->any())
    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; border-radius: 8px; padding: 15px; margin-bottom: 25px; color: #fca5a5;">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 10px 0 0 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <form action="/categories/{{ $category->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group @error('name') error @enderror">
            <label for="name">Nama Kategori <span style="color: #ef4444;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Masukkan nama kategori" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group @error('description') error @enderror">
            <label for="description">Deskripsi <span style="color: #ef4444;">*</span></label>
            <textarea id="description" name="description" placeholder="Masukkan deskripsi kategori" required>{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Perbarui</button>
            <a href="/categories" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>

@endsection
