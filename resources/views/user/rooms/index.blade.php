<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Kuis - MindClash</title>
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

        .header-section {
            max-width: 900px;
            margin: 0 auto 30px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(-3px);
        }

        .main-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card-custom {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            height: 100%;
            transition: all 0.3s;
        }

        .card-custom:hover {
            border-color: rgba(139, 92, 246, 0.4);
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #c4b5fd;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-control, .form-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.3);
            color: white;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #8b5cf6;
            box-shadow: 0 0 12px rgba(139, 92, 246, 0.4);
            color: white;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-select option {
            background: #0f172a;
            color: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
        }

        .room-item {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .room-item:hover {
            background: rgba(15, 23, 42, 0.7);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .room-name {
            font-weight: bold;
            font-size: 16px;
        }

        .room-meta {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .btn-join-action {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #34d399;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            transition: all 0.3s;
        }

        .btn-join-action:hover {
            background: #10b981;
            color: white;
        }
    </style>
</head>
<body>

<div class="header-section">
    <a href="/quiz-home" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>
    <div>
        <span class="badge bg-primary px-3 py-2 rounded-pill"><i class="fas fa-users"></i> Mode Mabar</span>
    </div>
</div>

<div class="main-container">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; color: #fca5a5;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Buat Room -->
        <div class="col-md-6">
            <div class="card-custom">
                <div class="card-title">
                    <i class="fas fa-plus-circle text-primary"></i> Buat Room Baru
                </div>
                <p class="text-secondary" style="font-size: 14px; margin-bottom: 25px;">Buat kuis grup Anda sendiri dan bagikan kodenya kepada teman-teman Anda untuk bersaing secara real-time.</p>
                
                <form action="{{ route('rooms.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-secondary" style="font-size: 13px; font-weight: 600;">Nama Room Kuis</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Mabar IPA Kelas 7A" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-secondary" style="font-size: 13px; font-weight: 600;">Pilih Kategori Soal</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->questions->count() }} Soal)</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-play"></i> Buat Room
                    </button>
                </form>
            </div>
        </div>

        <!-- Gabung Room -->
        <div class="col-md-6">
            <div class="card-custom d-flex flex-col justify-content-between">
                <div>
                    <div class="card-title">
                        <i class="fas fa-right-to-bracket text-success"></i> Masuk dengan Kode Room
                    </div>
                    <p class="text-secondary" style="font-size: 14px; margin-bottom: 25px;">Masukkan 6 digit kode room yang dibagikan oleh Host untuk bergabung ke dalam kuis yang sama.</p>
                    
                    <form action="{{ route('rooms.join') }}" method="POST" class="mb-5">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="code" class="form-control text-center fs-3 font-monospace" placeholder="123456" maxlength="6" style="letter-spacing: 5px;" required>
                        </div>
                        <button type="submit" class="btn-submit" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                            <i class="fas fa-sign-in-alt"></i> Gabung Room
                        </button>
                    </form>
                </div>

                <div>
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <div class="fs-6 fw-bold mb-3" style="color: #cbd5e1;"><i class="fas fa-list-ul me-2"></i> Room Aktif Saat Ini</div>
                    
                    <div style="max-height: 200px; overflow-y: auto;">
                        @forelse($activeRooms as $room)
                        <div class="room-item">
                            <div>
                                <div class="room-name">{{ $room->name }}</div>
                                <div class="room-meta">
                                    <span class="badge bg-secondary me-2">{{ $room->code }}</span>
                                    <span>Kategori: <strong>{{ $room->category->name }}</strong></span>
                                </div>
                            </div>
                            <form action="{{ route('rooms.join') }}" method="POST">
                                @csrf
                                <input type="hidden" name="code" value="{{ $room->code }}">
                                <button type="submit" class="btn-join-action">Gabung</button>
                            </form>
                        </div>
                        @empty
                        <div class="text-center text-secondary py-4" style="font-size: 14px;">
                            <i class="fas fa-ghost mb-2 fs-4" style="opacity: 0.5;"></i>
                            <div>Belum ada room kuis yang aktif. Buatlah yang pertama!</div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
