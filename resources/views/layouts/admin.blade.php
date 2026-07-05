<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Dashboard Admin - MindClash')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #111827 0%, #0f172a 100%);
            position: fixed;
            padding: 30px 20px;
            border-right: 1px solid rgba(139, 92, 246, 0.2);
            overflow-y: auto;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 40px;
            color: #8b5cf6;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: #cbd5e1;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu a:hover {
            background: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
            border-left-color: #8b5cf6;
        }

        .menu a.active {
            background: rgba(139, 92, 246, 0.3);
            color: #c4b5fd;
            border-left-color: #8b5cf6;
        }

        .content {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(139, 92, 246, 0.2);
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            background: linear-gradient(135deg, #8b5cf6 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6 0%, #06b6d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        .section-title {
            font-size: 22px;
            font-weight: bold;
            margin: 40px 0 25px 0;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 28px;
            background: linear-gradient(180deg, #8b5cf6 0%, #6d28d9 100%);
            border-radius: 2px;
        }

        /* Mobile Responsive Media Query */
        @media (max-width: 991px) {
            .sidebar {
                left: -280px;
                transition: left 0.3s ease-in-out;
                z-index: 1050;
                box-shadow: 5px 0 25px rgba(0, 0, 0, 0.5);
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .content {
                margin-left: 0 !important;
                padding: 80px 20px 20px 20px !important;
            }
            
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(4px);
                z-index: 1040;
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .header .user-info {
                align-self: flex-start;
            }
        }
        
        @stack('styles')
    </style>
</head>
<body>

<!-- Mobile Hamburger Toggle -->
<button class="btn d-lg-none" id="sidebarToggle" style="position: fixed; top: 15px; left: 15px; z-index: 1060; background: rgba(139, 92, 246, 0.2); border: 1px solid rgba(139, 92, 246, 0.4); color: #a78bfa; border-radius: 8px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
    <i class="fas fa-bars" style="font-size: 20px;"></i>
</button>

<!-- Backdrop Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar">
    <div class="logo">
        <i class="fas fa-brain"></i>
        MindClash
    </div>

    <div class="menu">
        <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>
        <a href="/questions" class="{{ Request::is('questions*') ? 'active' : '' }}">
            <i class="fas fa-question-circle"></i>
            Soal
        </a>
        <a href="/categories" class="{{ Request::is('categories*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i>
            Kategori
        </a>
        <a href="/users" class="{{ Request::is('users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            Pengguna
        </a>
        <a href="/reports" class="{{ Request::is('reports*') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i>
            Laporan
        </a>
        <a href="/settings" class="{{ Request::is('settings*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            Pengaturan
        </a>
        
        <!-- Back Navigation to User Quiz Page -->
        <a href="/quiz-home" style="margin-top: 20px; color: #38bdf8; border-top: 1px solid rgba(139, 92, 246, 0.2); padding-top: 20px;">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Beranda
        </a>
        
        <a href="/logout" style="color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </div>
</div>

<div class="content">
    <div class="header">
        <h1 class="title">
            @yield('title')
        </h1>
        <div class="user-info">
            @if(auth()->check() && auth()->user()->avatar)
                <div class="avatar" style="overflow: hidden; background: transparent; padding: 0;">
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            @else
                <div class="avatar">{{ auth()->check() ? substr(auth()->user()->name, 0, 1) : 'A' }}</div>
            @endif
            <div>
                <div style="font-weight: bold;">{{ auth()->user()->name ?? 'Admin MindClash' }}</div>
                <div style="font-size: 12px; color: #a0aec0;">Diperbarui: {{ date('d F Y') }}</div>
            </div>
        </div>
    </div>

    @yield('content')

</div>

@stack('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (toggleBtn && sidebar && overlay) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });
        
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }
});
</script>

</body>
</html>
