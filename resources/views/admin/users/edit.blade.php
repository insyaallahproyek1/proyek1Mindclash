@extends('layouts.admin')

@section('title', 'Edit Pengguna')

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
    .form-group select {
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
    .form-group select:focus {
        outline: none;
        border-color: #8b5cf6;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 10px rgba(139, 92, 246, 0.3);
    }

    .form-group select option {
        background: #1e293b;
        color: #e2e8f0;
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
    .form-group.error select {
        border-color: #ef4444;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .info-box {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid #22c55e;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        color: #86efac;
        font-size: 13px;
    }
</style>
@endpush

@section('content')

<div style="margin-bottom: 25px;">
    <h3 class="section-title"><i class="fas fa-edit"></i> Edit Pengguna</h3>
</div>

<div class="info-box">
    <i class="fas fa-info-circle"></i> Kosongkan field password jika tidak ingin mengubah password
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
    <form action="/users/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group @error('name') error @enderror">
            <label for="name">Nama Pengguna <span style="color: #ef4444;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama pengguna" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group @error('email') error @enderror">
            <label for="email">Email <span style="color: #ef4444;">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group @error('password') error @enderror">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak mengubah">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('password_confirmation') error @enderror">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru">
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group @error('role') error @enderror">
                <label for="role">Peran <span style="color: #ef4444;">*</span></label>
                <select id="role" name="role" required>
                    <option value="">-- Pilih Peran --</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group @error('class') error @enderror">
                <label for="class">Kelas</label>
                <input type="text" id="class" name="class" value="{{ old('class', $user->class) }}" placeholder="Contoh: 7A, 8B, 9C">
                @error('class')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Perbarui</button>
            <a href="/users" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>

@endsection
