<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Peringkat - Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background: #ffffff;
            color: #333333;
            min-height: 100vh;
            position: relative;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            position: relative;
            z-index: 1;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            color: #4F46E5;
            letter-spacing: 1px;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: #6B7280;
            text-align: center;
            margin-bottom: 2rem;
        }

        .leaderboard-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .top-users {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .user-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #eaeaea;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .user-card.gold {
            border-top: 5px solid #FFD700;
        }

        .user-card.silver {
            border-top: 5px solid #C0C0C0;
        }

        .user-card.bronze {
            border-top: 5px solid #CD7F32;
        }

        .rank-badge {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .gold .rank-badge {
            background: #FFF9C4;
            color: #B7950B;
        }

        .silver .rank-badge {
            background: #F5F5F5;
            color: #757575;
        }

        .bronze .rank-badge {
            background: #FFCCBC;
            color: #A04000;
        }

        .leaderboard-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 1rem auto;
            object-fit: cover;
            border: 3px solid #eaeaea;
        }

        .leaderboard-name {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0.5rem 0;
            color: #333333;
        }

        .user-points {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4F46E5;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .achievement-label {
            display: inline-block;
            background: #F3F4F6;
            color: #6B7280;
            padding: 0.3rem 0.8rem;
            border-radius: 100px;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .other-users {
            background: #F9FAFB;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .other-users-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #4B5563;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-row {
            background: #ffffff;
            border-radius: 8px;
            padding: 0.8rem 1.2rem;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            border: 1px solid #eaeaea;
        }

        .user-row:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .user-rank {
            width: 35px;
            height: 35px;
            background: #F3F4F6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: bold;
            color: #4B5563;
        }

        .leaderboard-user-info {
            flex: 1;
            margin-left: 1rem;
        }

        .row-user-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333333;
            margin-bottom: 0.25rem;
        }

        .user-stats {
            background: #F3F4F6;
            padding: 0.3rem 0.8rem;
            border-radius: 100px;
            color: #4B5563;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .current-user {
            border-left: 4px solid #4F46E5;
            background: #EEF2FF;
        }

        .my-status {
            background: #ffffff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #eaeaea;
        }

        .my-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .my-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #eaeaea;
        }

        .rank-status {
            font-size: 1.2rem;
            font-weight: bold;
            color: #4F46E5;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #EEF2FF;
            border-radius: 100px;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-button {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .action-button:hover {
            transform: translateY(-3px);
        }

        .learn-button {
            background: #4F46E5;
            color: white;
        }

        .play-button {
            background: #8B5CF6;
            color: white;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
        }

            .top-users {
                grid-template-columns: 1fr;
                gap: 1rem;
        }

            .my-status {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
        }

            .my-info {
                flex-direction: column;
        }

            .action-buttons {
                flex-direction: column;
            }
        }

        .users-scroll-container {
            max-height: 380px;
            overflow-y: auto;
            padding-right: 10px;
            scrollbar-width: thin;
            scrollbar-color: #CBD5E0 #EDF2F7;
        }

        .users-scroll-container::-webkit-scrollbar {
            width: 8px;
        }

        .users-scroll-container::-webkit-scrollbar-track {
            background: #EDF2F7;
            border-radius: 10px;
        }

        .users-scroll-container::-webkit-scrollbar-thumb {
            background-color: #CBD5E0;
            border-radius: 10px;
        }

        .users-scroll-container::-webkit-scrollbar-thumb:hover {
            background-color: #A0AEC0;
        }

        .user-avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            margin-right: 10px;
        }

        .empty-message {
            text-align: center;
            padding: 20px;
            color: #718096;
            font-style: italic;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <div class="container mx-auto">
                <div class="text-center mb-8">
                    <h1 class="page-title">
                        Peringkat <i class="fas fa-trophy ml-2"></i>
                    </h1>
                    <p class="page-subtitle">Pengguna terbaik berdasarkan perolehan poin</p>
                </div>

                <div class="leaderboard-container">
                    <!-- Top 3 Users -->
                    <div class="top-users">
                        @if(count($leaderboard) > 0)
                            <div class="user-card gold">
                                <div class="rank-badge">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <img class="leaderboard-avatar" src="https://ui-avatars.com/api/?name={{ $leaderboard[0]->name }}&background=FFD700&color=fff" alt="{{ $leaderboard[0]->name }}">
                                <h3 class="leaderboard-name">{{ $leaderboard[0]->name }}</h3>
                                <div class="user-points">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($leaderboard[0]->total_points) }}
                                </div>
                                <div class="achievement-label">Peringkat #1</div>
                </div>
                @endif

                        @if(count($leaderboard) > 1)
                            <div class="user-card silver">
                                <div class="rank-badge">
                                    <i class="fas fa-medal"></i>
                                </div>
                                <img class="leaderboard-avatar" src="https://ui-avatars.com/api/?name={{ $leaderboard[1]->name }}&background=C0C0C0&color=fff" alt="{{ $leaderboard[1]->name }}">
                                <h3 class="leaderboard-name">{{ $leaderboard[1]->name }}</h3>
                                <div class="user-points">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($leaderboard[1]->total_points) }}
                                </div>
                                <div class="achievement-label">Peringkat #2</div>
                </div>
                @endif

                        @if(count($leaderboard) > 2)
                            <div class="user-card bronze">
                                <div class="rank-badge">
                                    <i class="fas fa-award"></i>
                                </div>
                                <img class="leaderboard-avatar" src="https://ui-avatars.com/api/?name={{ $leaderboard[2]->name }}&background=CD7F32&color=fff" alt="{{ $leaderboard[2]->name }}">
                                <h3 class="leaderboard-name">{{ $leaderboard[2]->name }}</h3>
                                <div class="user-points">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($leaderboard[2]->total_points) }}
                                </div>
                                <div class="achievement-label">Peringkat #3</div>
                            </div>
                        @endif
                    </div>

                    <!-- Other Users -->
                    <div class="other-users">
                        <div class="other-users-title">
                            <i class="fas fa-users"></i> Pengguna Lainnya
                        </div>

                        <div class="users-scroll-container">
                            @php $count = 0; @endphp
                            @foreach($leaderboard as $index => $user)
                                @if($index > 2)
                                    <div class="user-row {{ isset($currentUser) && $user->id == $currentUser->id ? 'current-user' : '' }}">
                                        <div class="user-rank">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="user-avatar-circle" style="background-color: #{{ substr(md5($user->name), 0, 6) }}">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    <div class="leaderboard-user-info">
                                            <h3 class="row-user-name">{{ $user->name }}</h3>
                                            <div class="user-stats">
                                                <i class="fas fa-star"></i>
                                                {{ number_format($user->total_points) }} Poin
                                            </div>
                                        </div>
                                    </div>
                                    @php $count++; @endphp
                                        @endif
                            @endforeach
                            @if($count == 0)
                                <div class="empty-message">
                                    <p>Belum ada data pengguna lainnya.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(isset($currentUser))
                        <div class="my-status">
                            <div class="my-info">
                                <img src="https://ui-avatars.com/api/?name={{ $currentUser->name }}&background=4F46E5&color=fff" alt="{{ $currentUser->name }}" class="my-avatar">
                                <div class="leaderboard-user-info">
                                    <h3 class="row-user-name">{{ $currentUser->name }}</h3>
                                    <div class="user-stats">
                                        <i class="fas fa-star"></i>
                                        {{ number_format($currentUser->total_points ?? 0) }} Poin
                            </div>
                        </div>
                            </div>
                            <div class="rank-status">
                                <i class="fas fa-chart-line"></i>
                                Peringkat ke-{{ $currentUserRank }}
                            </div>
                    </div>

                    @if(!in_array($currentUser->role, ['admin', 'superadmin']))
                            <div class="action-buttons">
                                <a href="{{ route('belajar.index') }}" class="action-button learn-button">
                                    <i class="fas fa-book-open"></i>
                                    Mulai Belajar
                                </a>
                                <a href="{{ route('permainan.index') }}" class="action-button play-button">
                                    <i class="fas fa-gamepad"></i>
                                    Main Games
                                </a>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
