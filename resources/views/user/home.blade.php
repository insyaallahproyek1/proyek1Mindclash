<!DOCTYPE html>
<html>
<head>
    <title>MindClash - Quiz Game</title>
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

        .navbar-top {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            margin-bottom: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #8b5cf6;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 36px;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .welcome-title {
            font-size: 48px;
            font-weight: bold;
            background: linear-gradient(135deg, #8b5cf6 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .welcome-subtitle {
            font-size: 18px;
            color: #cbd5e1;
            margin-bottom: 30px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .category-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 15px;
            padding: 30px;
            text-decoration: none;
            color: white;
            border: 2px solid transparent;
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .category-card:hover {
            border-color: #8b5cf6;
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.3);
        }

        .category-card:hover::before {
            left: 100%;
        }

        .category-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #8b5cf6;
        }

        .category-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }

        .category-desc {
            font-size: 14px;
            color: #a0aec0;
            margin-bottom: 15px;
        }

        .category-count {
            display: inline-block;
            background: rgba(139, 92, 246, 0.2);
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 12px;
            color: #c4b5fd;
        }

        .start-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            transition: all 0.3s;
        }

        .start-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        }

        .footer {
            text-align: center;
            color: #64748b;
            margin-top: 50px;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<div class="navbar-top">
    <div class="container-main">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <i class="fas fa-brain"></i>
                MindClash
            </div>
            <div>
                <span style="margin-right: 20px;">Welcome, <strong>{{ Auth::user()->name ?? 'User' }}</strong></span>
                <a href="/logout" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container-main">
    <div class="welcome-section">
        <h1 class="welcome-title">Selamat Datang di MindClash!</h1>
        <p class="welcome-subtitle">Pilih kategori dan mulai kerjakan soal-soal untuk menguji kemampuanmu</p>
        <a href="/leaderboard" style="display: inline-block; margin-top: 20px; padding: 10px 25px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(139, 92, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <i class="fas fa-trophy"></i> Lihat Peringkat Kelas
        </a>
    </div>

    <div class="categories-grid">
        @foreach($categories as $category)
        <a href="/quiz/{{ $category->id }}" class="category-card">
            <div class="category-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="category-name">{{ $category->name }}</div>
            <p class="category-desc">{{ $category->description }}</p>
            <span class="category-count">{{ $category->questions->count() }} Soal</span>
            <button class="start-btn">Mulai Quiz</button>
        </a>
        @endforeach
    </div>

    <div class="footer">
        <p>&copy; 2024 MindClash. Tingkatkan pengetahuanmu setiap hari!</p>
    </div>
</div>

</body>
</html>
