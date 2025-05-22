<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background-color: #151b2e;
            color: #ffffff;
            /* background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f308.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4da.svg'); */
            background-size: 80px, 120px, 70px;
            background-position: top left, top right, bottom right;
            background-repeat: repeat, no-repeat, no-repeat;
            background-blend-mode: soft-light;
            background-opacity: 0.05;
            overflow-x: hidden;
        }

        /* Fix untuk header dropdown pada halaman materi */
        .header-dropdown-container, .duolingo-header, .user-avatar, #userAvatarControl, #avatarClickOverlay {
            z-index: 1000 !important;
            position: relative !important;
        }

        /* Pastikan user dropdown muncul di atas konten */
        #userDropdownDiv {
            z-index: 1001 !important;
        }

        /* Fix untuk main content yang mungkin menutupi header */
        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
            z-index: 1; /* Pastikan main content ada di bawah header */
        }

        .card {
            transition: all 0.3s ease;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3), 0 6px 6px rgba(0, 0, 0, 0.23);
            position: relative;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(5px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-15px) rotate(2deg);
            box-shadow: 0 25px 30px rgba(0, 0, 0, 0.4), 0 15px 12px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .card-header {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 0 10px;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        .card-header-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 3rem;
            z-index: 1;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.4));
        }

        .card-body {
            padding: 1.5rem;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            margin-top: -20px;
            position: relative;
            background-color: white;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .progress-bar {
            height: 14px;
            border-radius: 10px;
            transition: width 0.5s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            min-width: 0%;
        }

        .action-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin: 0 6px;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .action-button:hover {
            transform: scale(1.2) rotate(10deg);
        }

        .search-container {
            position: relative;
            max-width: none;
            margin: 0;
            width: 100%;
        }

        .search-input {
            border-radius: 30px;
            padding: 15px 25px;
            font-size: 1.1rem;
            width: 100%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: 3px solid #58CC02;
            padding-left: 60px;
            padding-right: 20px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            color: #1e293b;
        }

        .search-input:focus {
            border-color: #9F7AEA;
            box-shadow: 0 4px 20px rgba(159, 122, 234, 0.4);
            transform: scale(1.03);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #58CC02;
            font-size: 1.5rem;
        }

        .view-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background-color: #3B82F6;
            color: white;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
        }

        .view-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
            z-index: -1;
        }

        .view-button:hover {
            background-color: #2563EB;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.5);
        }

        .view-button:hover::before {
            left: 100%;
        }

        /* Bouncing animation for icons */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-8px) rotate(3deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(-4px) rotate(-3deg); }
        }

        .bounce {
            animation: bounce 3s infinite;
        }

        .float {
            animation: floating 6s infinite;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #F25252;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            padding: 0.5rem 2rem;
            border-radius: 8px;
        }

        .subtitle {
            text-align: center;
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 0.5rem;
            border-radius: 8px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            font-weight: 600;
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: none;
            background: #7028E4;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        /* Success notification */
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 15px 30px;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            transition: all 0.5s ease;
            transform: translateX(100px);
        }

        .success-notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .success-notification .icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .success-notification .message {
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Mobile styling */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 120px;
            }

            .content-title {
                font-size: 2.5rem;
            }
        }

        /* Card animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        .animate-wiggle {
            animation: wiggle 1s ease-in-out infinite;
            animation-delay: 1s;
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.6;
        }

        .decoration-1 {
            top: 100px;
            left: 10%;
            font-size: 3rem;
            animation: floating 10s infinite;
        }

        .decoration-2 {
            top: 30%;
            right: 5%;
            font-size: 4rem;
            animation: floating 13s infinite reverse;
        }

        .decoration-3 {
            bottom: 15%;
            left: 7%;
            font-size: 3.5rem;
            animation: floating 8s infinite;
        }

        .title-container {
            position: relative;
            text-align: center;
            margin-bottom: 2rem;
        }

        .card-description {
            height: 80px;
            overflow: hidden;
            position: relative;
        }

        .card-description::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        /* Tambahkan style untuk memastikan modal achievement muncul di atas semua konten */
        #achievementModalOverlay {
            z-index: 9999 !important;
        }

        #achievementModal {
            z-index: 10000 !important;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content px-6">
            <!-- Decorative elements -->
            <div class="decoration decoration-1">📝</div>
            <div class="decoration decoration-2">📚</div>
            <div class="decoration decoration-3">🔍</div>

            <!-- Page Header -->
            <div class="container mx-auto">
                <div class="text-center mb-8 px-6">
                    <h1 class="content-title">
                        MATERI <i class="fas fa-graduation-cap ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Mari belajar hal-hal seru dan menarik bersama!</p>
                </div>
                <div class="gradient-border"></div>
            </div>

            <!-- Search bar -->
            <div class="flex justify-between items-center mb-10">
                <form action="{{ route('user.materi.index') }}" method="GET" class="w-full md:w-auto">
                    <div class="search-container" style="width: auto; min-width: 320px;">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" value="{{ $search ?? '' }}" class="search-input" placeholder="Mau belajar apa hari ini? 🔎">

                        @if(isset($search) && $search)
                        <a href="{{ route('user.materi.index') }}" class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times-circle text-xl"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Search Results Notification -->
            @if(isset($search) && $search)
            <div class="mb-8 bg-indigo-900 text-white p-6 rounded-2xl border-2 border-indigo-700 animate-fadeInUp">
                <div class="flex items-center">
                    <span class="text-4xl mr-4 bounce">🔍</span>
                    <span class="font-bold text-xl">{{ count($materis) }} materi tentang "{{ $search }}"</span>
                </div>
            </div>
            @endif

            <!-- Success message -->
            @if(session('success'))
            <div class="success-notification show">
                <span class="icon">✅</span>
                <span class="message">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Error message -->
            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-md" role="alert">
                <p class="font-bold">Perhatian</p>
                <p>{{ session('error') }}</p>
            </div>
            @endif

            <!-- Material Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @if(count($materis) > 0)
                    @foreach($materis as $index => $materi)
                        @php
                            // Card color variations - Enhanced with brighter colors and gradients
                            $cardThemes = [
                                [
                                    'bg' => 'from-pink-500 to-purple-600',
                                    'text' => 'text-pink-800',
                                    'progress_bg' => 'bg-pink-100',
                                    'progress' => 'bg-pink-500',
                                    'action' => 'bg-gradient-to-br from-pink-500 to-pink-600 hover:from-pink-400 hover:to-pink-600',
                                    'icon' => '📚'
                                ],
                                [
                                    'bg' => 'from-blue-400 to-indigo-600',
                                    'text' => 'text-blue-800',
                                    'progress_bg' => 'bg-blue-100',
                                    'progress' => 'bg-blue-500',
                                    'action' => 'bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-400 hover:to-blue-600',
                                    'icon' => '🧩'
                                ],
                                [
                                    'bg' => 'from-green-400 to-teal-600',
                                    'text' => 'text-green-800',
                                    'progress_bg' => 'bg-green-100',
                                    'progress' => 'bg-green-500',
                                    'action' => 'bg-gradient-to-br from-green-500 to-green-600 hover:from-green-400 hover:to-green-600',
                                    'icon' => '🌟'
                                ],
                                [
                                    'bg' => 'from-yellow-400 to-orange-600',
                                    'text' => 'text-yellow-800',
                                    'progress_bg' => 'bg-yellow-100',
                                    'progress' => 'bg-yellow-500',
                                    'action' => 'bg-gradient-to-br from-yellow-500 to-yellow-600 hover:from-yellow-400 hover:to-yellow-600',
                                    'icon' => '🚀'
                                ],
                                [
                                    'bg' => 'from-purple-400 to-indigo-600',
                                    'text' => 'text-purple-800',
                                    'progress_bg' => 'bg-purple-100',
                                    'progress' => 'bg-purple-500',
                                    'action' => 'bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-400 hover:to-purple-600',
                                    'icon' => '🔮'
                                ],
                            ];

                            // Enhanced icons with better variety
                            $icons = ['📚', '🧩', '🌟', '🚀', '🔮', '🎨', '🎯', '🎮', '📝', '🔍', '🎓', '🧠', '📘', '🎪', '🌈'];

                            $themeIndex = $index % count($cardThemes);
                            $theme = $cardThemes[$themeIndex];
                            $icon = $icons[$index % count($icons)];

                            // User progress
                            $userProgress = 0;
                            $progressColor = $theme['progress'];

                            if(Auth::check()) {
                                $userProgress = $materi->getProgressForUser(Auth::id());
                                if($userProgress >= 100) {
                                    $progressColor = 'bg-gradient-to-r from-green-400 to-green-600';
                                }
                            }

                            // Animation delay for staggered entry
                            $animationDelay = ($index * 0.1) . 's';
                        @endphp

                        <div class="card animate-fadeInUp relative" style="animation-delay: {{ $animationDelay }}">
                            <!-- Card header with gradient background -->
                            <div class="card-header bg-gradient-to-r {{ $theme['bg'] }}">
                                <span class="card-header-icon float" style="animation-delay: {{ $animationDelay }}">{{ $icon }}</span>
                                <h2 class="text-2xl font-bold text-white text-center px-12">{{ $materi->title }}</h2>
                            </div>

                            <div class="card-body">
                                <div class="card-description">
                                    <p class="text-gray-700">{{ Str::limit($materi->description, 150) }}</p>
                                </div>

                                @auth
                                <div class="my-6">
                                    <div class="flex justify-between mb-2">
                                        <span class="font-bold {{ $theme['text'] }}">Progres Belajar:</span>
                                        <span class="font-bold {{ $theme['text'] }}">{{ $userProgress }}%</span>
                                    </div>
                                    <div class="{{ $theme['progress_bg'] }} rounded-full overflow-hidden">
                                        <div class="{{ $progressColor }} progress-bar" style="width: {{ $userProgress }}%"></div>
                                    </div>

                                    @if($userProgress >= 100)
                                    <div class="mt-2 bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center justify-center">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                    </div>
                                    @endif
                                </div>
                                @endauth

                                <div class="flex justify-center mt-6">
                                    <a href="{{ route('user.materi.show', $materi->id) }}" class="view-button">
                                        <i class="fas fa-book-open mr-2"></i> Baca Materi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 md:col-span-3 bg-white dark:bg-gray-800 rounded-xl p-10 text-center shadow-xl animate-fadeInUp relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                        <div class="flex flex-col items-center">
                            <div class="text-8xl mb-6 bounce">{{ isset($search) && $search ? '🔍' : '📚' }}</div>
                            <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-purple-600 to-indigo-600 text-transparent bg-clip-text">
                                @if(isset($search) && $search)
                                    Materi Tidak Ditemukan
                                @else
                                    Belum Ada Materi
                                @endif
                            </h2>

                            @if(isset($search) && $search)
                                <p class="text-gray-700 dark:text-gray-300 mb-8 text-xl">Tidak ada materi tentang "{{ $search }}"</p>
                                <a href="{{ route('user.materi.index') }}" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-full hover:from-purple-700 hover:to-indigo-700 inline-block font-bold transition shadow-lg transform hover:scale-105">
                                    <i class="fas fa-home mr-2"></i> Lihat Semua Materi
                                </a>
                            @else
                                <p class="text-gray-700 dark:text-gray-300 mb-8 text-xl">Belum ada materi pembelajaran yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add success notification element -->
    <div id="successNotification" class="success-notification">
        <span class="icon">✅</span>
        <span class="message">Operasi berhasil dilakukan!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle notifications
            const notifications = document.querySelectorAll('.success-notification');
            notifications.forEach(notification => {
                if (notification.classList.contains('show')) {
                    // Auto-hide notifications after 5 seconds
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateX(100px)';
                        setTimeout(() => {
                            notification.style.display = 'none';
                        }, 500);
                    }, 5000);
                }
            });

            // Add fade-in animation when page loads
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('opacity-100');
                }, index * 100);
            });

            // Dropdown functionality is now handled in the header.blade.php file
        });
    </script>

    @include('components.achievement-notification')
</body>
</html>
