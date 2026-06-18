@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@push('styles')
<style>
    .settings-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .settings-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        padding: 30px;
    }

    .settings-card h3 {
        color: #c4b5fd;
        font-size: 18px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: #a0aec0;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(139, 92, 246, 0.3);
        padding: 12px 15px;
        border-radius: 8px;
        color: white;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
    }

    .btn-save {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        margin-top: 10px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    /* Toggle Switch */
    .toggle-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 8px;
    }

    .toggle-label {
        color: #e2e8f0;
        font-size: 15px;
    }

    .toggle-desc {
        color: #64748b;
        font-size: 12px;
        margin-top: 5px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #334155;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #10b981;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #10b981;
    }

    input:checked + .slider:before {
        transform: translateX(24px);
    }
</style>
@endpush

@section('content')

    <div class="settings-container">
        
        <!-- Profil Admin -->
        <div class="settings-card">
            <h3><i class="fas fa-user-shield"></i> Profil Administrator</h3>
            
            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #86efac; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="/settings/profile" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group" style="text-align: center; margin-bottom: 30px;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6 0%, #06b6d4 100%); display: inline-flex; align-items: center; justify-content: center; overflow: hidden; border: 3px solid rgba(139, 92, 246, 0.5); margin-bottom: 15px;">
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="font-size: 40px; font-weight: bold; color: white;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="avatar" class="btn-save" style="background: rgba(255,255,255,0.1); width: auto; font-size: 12px; padding: 8px 15px; cursor: pointer; display: inline-block; margin-top: 0;">
                            <i class="fas fa-camera"></i> Ubah Foto
                        </label>
                        <input type="file" id="avatar" name="avatar" style="display: none;" accept="image/*" onchange="document.getElementById('file-name').innerText = this.files[0].name">
                        <div id="file-name" style="font-size: 12px; color: #a0aec0; margin-top: 5px;"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name ?? 'Admin MindClash' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email ?? 'admin@mindclash.com' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password Baru (Kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>
                <button type="submit" class="btn-save">Simpan Perubahan Profil</button>
            </form>
        </div>

        <!-- Preferensi Sistem -->
        <div class="settings-card">
            <h3><i class="fas fa-sliders-h"></i> Preferensi Aplikasi</h3>
            
            <div class="toggle-wrapper">
                <div>
                    <div class="toggle-label">Mode Pemeliharaan (Maintenance)</div>
                    <div class="toggle-desc">Siswa tidak akan bisa login saat diaktifkan</div>
                </div>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>

            <div class="toggle-wrapper">
                <div>
                    <div class="toggle-label">Tampilkan Leaderboard Publik</div>
                    <div class="toggle-desc">Siswa bisa melihat nilai siswa di kelas lain</div>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="toggle-wrapper">
                <div>
                    <div class="toggle-label">Pendaftaran Akun Terbuka</div>
                    <div class="toggle-desc">Mengizinkan pengguna baru untuk mendaftar mandiri</div>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <button class="btn-save" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);" onclick="alert('Preferensi Disimpan!')">Simpan Preferensi</button>
        </div>

    </div>

@endsection
