<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby Room - MindClash</title>
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

        .lobby-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .lobby-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            margin-bottom: 30px;
        }

        .room-code-badge {
            background: rgba(139, 92, 246, 0.2);
            border: 1px solid rgba(139, 92, 246, 0.4);
            color: #c4b5fd;
            font-family: monospace;
            font-size: 32px;
            padding: 10px 25px;
            border-radius: 15px;
            letter-spacing: 3px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .member-list {
            margin-top: 20px;
        }

        .member-item {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s;
        }

        .member-item:hover {
            border-color: rgba(139, 92, 246, 0.3);
            transform: scale(1.02);
        }

        .member-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6 0%, #06b6d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 16px;
        }

        .member-info {
            flex-grow: 1;
        }

        .member-name {
            font-weight: bold;
            font-size: 16px;
        }

        .member-class {
            font-size: 12px;
            color: #94a3b8;
        }

        .badge-role {
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .pulse-container {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #cbd5e1;
            font-size: 14px;
            justify-content: center;
            margin-top: 20px;
        }

        .pulse-dot {
            width: 10px;
            height: 10px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .btn-start {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            border: none;
            color: white;
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
            display: block;
            width: 100%;
            margin-top: 30px;
        }

        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
        }

        .btn-leave {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-leave:hover {
            background: #ef4444;
            color: white;
        }
    </style>
</head>
<body>

<div class="lobby-container">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ route('rooms.index') }}" class="btn-leave">
            <i class="fas fa-sign-out-alt"></i> Keluar Lobby
        </a>
        <span class="text-secondary" style="font-size: 14px;"><i class="fas fa-brain text-primary"></i> MindClash Multiplayer</span>
    </div>

    @if(session('error'))
        <div class="alert alert-danger" style="border-radius: 12px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="lobby-card text-center">
        <div class="text-secondary mb-1" style="font-size: 14px; font-weight: bold; text-transform: uppercase;">Kode Room</div>
        <div class="room-code-badge" id="roomCodeText">{{ $room->code }}</div>
        
        <h2 class="fw-bold mb-2">{{ $room->name }}</h2>
        <div style="font-size: 15px; color: #a78bfa;">
            Kategori Kuis: <strong>{{ $room->category->name }}</strong>
        </div>

        <div style="font-size: 14px; color: #94a3b8; margin-top: 10px;">
            Host: <span class="badge bg-primary">{{ $room->host->name }}</span>
        </div>
    </div>

    <div class="lobby-card">
        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-3 mb-3">
            <h4 class="fw-bold mb-0"><i class="fas fa-user-friends text-primary me-2"></i> Peserta Lobby</h4>
            <span class="badge bg-secondary" id="memberCountText">{{ $room->users->count() }} Terhubung</span>
        </div>

        <div class="member-list" id="memberListContainer">
            @foreach($room->users as $user)
            <div class="member-item">
                <div class="member-avatar">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="member-info">
                    <div class="member-name">{{ $user->name }}</div>
                    <div class="member-class">Kelas: {{ $user->class ?? '-' }}</div>
                </div>
                @if($user->id === $room->host_id)
                    <span class="badge bg-warning text-dark badge-role"><i class="fas fa-crown"></i> HOST</span>
                @else
                    <span class="badge bg-info text-white badge-role">Pemain</span>
                @endif
            </div>
            @endforeach
        </div>

        @if(auth()->id() === $room->host_id)
            <button class="btn-start" id="btnStartQuiz">
                <i class="fas fa-gamepad"></i> Mulai Kuis Sekarang
            </button>
        @else
            <div class="pulse-container">
                <div class="pulse-dot"></div>
                <div id="statusMessage">Menunggu Host memulai kuis...</div>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomCode = "{{ $room->code }}";
    const currentUserId = {{ auth()->id() }};
    const hostId = {{ $room->host_id }};
    const startUrl = "{{ route('rooms.start', $room->code) }}";
    const membersUrl = "{{ route('rooms.members', $room->code) }}";
    const quizUrl = "{{ route('rooms.quiz', $room->code) }}";
    const lobbyIndexUrl = "{{ route('rooms.index') }}";

    // 1. AJAX Polling for Members and status
    function pollLobby() {
        fetch(membersUrl)
            .then(res => res.json())
            .then(data => {
                // If room is active, redirect immediately to quiz
                if (data.status === 'active') {
                    window.location.href = quizUrl;
                    return;
                }
                
                // If room is finished, redirect to leaderboard
                if (data.status === 'finished') {
                    window.location.href = "{{ route('rooms.leaderboard', $room->code) }}";
                    return;
                }

                // Update member count
                document.getElementById('memberCountText').innerText = data.members.length + " Terhubung";

                // Redraw member list
                const container = document.getElementById('memberListContainer');
                container.innerHTML = '';

                data.members.forEach(member => {
                    // Check if host
                    const isHost = member.name === "{{ $room->host->name }}";
                    const avatarLetter = member.name.substring(0, 1);

                    const itemHtml = `
                        <div class="member-item">
                            <div class="member-avatar">${avatarLetter}</div>
                            <div class="member-info">
                                <div class="member-name">${member.name}</div>
                                <div class="member-class">Kelas: ${member.class || '-'}</div>
                            </div>
                            ${isHost 
                                ? '<span class="badge bg-warning text-dark badge-role"><i class="fas fa-crown"></i> HOST</span>' 
                                : '<span class="badge bg-info text-white badge-role">Pemain</span>'
                            }
                        </div>
                    `;
                    container.innerHTML += itemHtml;
                });
            })
            .catch(err => console.error("Gagal melakukan sinkronisasi lobby: ", err));
    }

    // Start polling every 3 seconds
    const intervalId = setInterval(pollLobby, 3000);

    // 2. Start Quiz Event (Host only)
    const btnStart = document.getElementById('btnStartQuiz');
    if (btnStart) {
        btnStart.addEventListener('click', function() {
            btnStart.disabled = true;
            btnStart.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memulai...';

            fetch(startUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Stop interval and redirect
                    clearInterval(intervalId);
                    window.location.href = quizUrl;
                } else {
                    alert(data.error || 'Terjadi kesalahan.');
                    btnStart.disabled = false;
                    btnStart.innerHTML = '<i class="fas fa-gamepad"></i> Mulai Kuis Sekarang';
                }
            })
            .catch(err => {
                alert('Gagal memulai kuis.');
                btnStart.disabled = false;
                btnStart.innerHTML = '<i class="fas fa-gamepad"></i> Mulai Kuis Sekarang';
            });
        });
    }
});
</script>
</body>
</html>
