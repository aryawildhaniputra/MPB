<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permainan Edukatif - Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #151b2e;
            color: #ffffff;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 160px !important;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 100px !important;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #F7A813;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            padding: 0.5rem 2rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .content-title {
                font-size: 2.2rem;
                padding: 0.4rem 1.5rem;
                letter-spacing: 0.5px;
            }
        }

        @media (max-width: 480px) {
            .content-title {
                font-size: 1.8rem;
                padding: 0.3rem 1rem;
            }
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
        }

        @media (max-width: 768px) {
            .subtitle {
                font-size: 1.1rem;
                margin-bottom: 1.5rem;
                padding: 0.4rem 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .subtitle {
                font-size: 0.95rem;
                margin-bottom: 1rem;
                padding: 0.3rem 0.6rem;
            }
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: none;
            background: #4a5af0;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .gradient-border {
                margin-bottom: 1.5rem;
                height: 3px;
            }
        }

        .game-card {
            background: #ffffff;
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .game-card {
                padding: 1.2rem;
                border-radius: 12px;
                margin-bottom: 1rem;
            }

            .game-card:hover {
                transform: translateY(-5px);
            }
        }

        @media (max-width: 480px) {
            .game-card {
                padding: 1rem;
                border-radius: 10px;
            }
        }

        .game-card:hover {
            transform: translateY(-10px);
            border-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
            z-index: -1;
        }

        .game-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #FF9500;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin: 0 auto 1.5rem auto;
            font-size: 2.5rem;
            color: white;
        }

        @media (max-width: 768px) {
            .game-icon {
                width: 70px;
                height: 70px;
                font-size: 2.2rem;
                margin-bottom: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .game-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
                margin-bottom: 1rem;
            }
        }

        .blue-theme {
            background: #36D1DC;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .purple-theme {
            background: #9D50BB;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .green-theme {
            background: #58CC02;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .orange-theme {
            background: #FF9500;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .teal-theme {
            background: #0ED2F7;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .game-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            text-align: center;
            color: #151b2e;
        }

        @media (max-width: 768px) {
            .game-card h3 {
                font-size: 1.3rem;
                margin-bottom: 0.6rem;
            }
        }

        @media (max-width: 480px) {
            .game-card h3 {
                font-size: 1.2rem;
                margin-bottom: 0.5rem;
            }
        }

        .game-card p {
            color: #4b5563;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            line-height: 1.5;
            text-align: center;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .game-card p {
                font-size: 0.9rem;
                margin-bottom: 1.2rem;
                line-height: 1.4;
            }
        }

        @media (max-width: 480px) {
            .game-card p {
                font-size: 0.85rem;
                margin-bottom: 1rem;
                line-height: 1.3;
            }
        }

        .play-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background: #FF9500;
            color: white;
            border-radius: 30px;
            font-weight: 700;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .play-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: #FF5252;
        }

        .play-button.blue {
            background: #36D1DC;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .play-button.blue:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: #5B86E5;
        }

        .play-button.purple {
            background: #9D50BB;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .play-button.purple:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: #6E48AA;
        }

        .play-button.green {
            background: #58CC02;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .play-button.green:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: #16A34A;
        }

        .play-button.teal {
            background: #0ED2F7;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .play-button.teal:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: #09C6F9;
        }

        .game-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            color: #4b5563;
            font-size: 0.9rem;
            font-weight: 600;
            background-color: rgba(0, 0, 0, 0.05);
            padding: 0.5rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .game-stats {
                font-size: 0.8rem;
                margin-bottom: 1.2rem;
                padding: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .game-stats {
                font-size: 0.75rem;
                margin-bottom: 1rem;
                padding: 0.3rem;
                justify-content: center;
            }
        }

        .coming-soon-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #38BDF8, #2563EB);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
            transform: rotate(15deg);
        }

        @media (max-width: 768px) {
            .coming-soon-badge {
                top: -6px;
                right: -6px;
                padding: 0.4rem 0.8rem;
                font-size: 0.7rem;
            }
        }

        .badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .badge {
                padding: 0.3rem 0.6rem;
                font-size: 0.7rem;
                margin-right: 0.3rem;
            }
        }

        @media (max-width: 480px) {
            .badge {
                padding: 0.25rem 0.5rem;
                font-size: 0.65rem;
                margin-right: 0.2rem;
            }
        }

        /* Removing these badge classes for difficulty levels */
        .badge-beginner {
            display: none;
        }

        .badge-intermediate {
            display: none;
        }

        .badge-advanced {
            display: none;
        }

        /* Keep only the theme badge */
        .badge-theme {
            background-color: #dec9ff;
            color: #2e004d;
            border: 1px solid #9333EA;
            font-weight: 700;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-8px) rotate(-3deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(-4px) rotate(3deg); }
        }

        .float-element {
            animation: float 6s infinite ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.6;
            font-size: 3rem;
        }

        @media (max-width: 768px) {
            .decoration {
                display: none; /* Hide decorative elements on mobile for cleaner look */
            }
        }

        .decoration-1 {
            top: 15%;
            left: 10%;
            animation: float 13s infinite;
        }

        .decoration-2 {
            top: 25%;
            right: 8%;
            animation: float 8s infinite;
        }

        .decoration-3 {
            bottom: 15%;
            left: 15%;
            animation: float 10s infinite;
        }

        .decoration-4 {
            bottom: 25%;
            right: 12%;
            animation: float 15s infinite;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
            background: #3f51b5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .category-title {
                font-size: 1.3rem;
                margin-bottom: 1.2rem;
                padding: 0.4rem 0.8rem;
                text-align: center;
                display: block;
                width: fit-content;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 480px) {
            .category-title {
                font-size: 1.1rem;
                margin-bottom: 1rem;
                padding: 0.3rem 0.6rem;
            }
        }

        .category-title::before {
            content: none;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .content-title {
                font-size: 2.5rem;
            }

            .category-title {
                font-size: 1.25rem;
            }
        }

        /* Additional mobile optimizations */
        @media (max-width: 640px) {
            .main-content {
                padding-top: 90px !important;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .content-title {
                font-size: 1.6rem;
                padding: 0.25rem 0.75rem;
            }

            .subtitle {
                font-size: 0.9rem;
                padding: 0.25rem 0.5rem;
            }

            .game-card {
                padding: 0.8rem;
                min-height: 280px; /* Ensure consistent card heights on mobile */
            }

            .game-card h3 {
                font-size: 1.1rem;
            }

            .game-card p {
                font-size: 0.8rem;
                line-height: 1.25;
            }

            .game-icon {
                width: 50px;
                height: 50px;
                font-size: 1.8rem;
                margin-bottom: 0.8rem;
            }

            .category-title {
                font-size: 1rem;
                padding: 0.25rem 0.5rem;
            }
        }

        /* Add styles for the "Lihat Jawaban" button */
        .answers-button {
            display: block;
            margin-top: 12px;
            padding: 10px 16px;
            background: #4A90E2;
            color: white;
            border-radius: 30px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(74, 144, 226, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 10;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .answers-button {
                margin-top: 10px;
                padding: 8px 14px;
                font-size: 0.9rem;
                border-radius: 25px;
            }
        }

        @media (max-width: 480px) {
            .answers-button {
                margin-top: 8px;
                padding: 7px 12px;
                font-size: 0.85rem;
                border-radius: 20px;
            }
        }

        .answers-button:hover {
            background: #3A7BD5;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(74, 144, 226, 0.4);
        }

        @media (max-width: 768px) {
            .answers-button:hover {
                transform: translateY(-2px);
            }
        }

        .answers-button:active {
            transform: translateY(-1px);
            box-shadow: 0 3px 6px rgba(74, 144, 226, 0.3);
        }

        .answers-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
            z-index: -1;
        }

        .answers-button:hover::before {
            left: 100%;
        }

        .completed-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(5, 150, 105, 0.3);
            z-index: 5;
        }

        @media (max-width: 768px) {
            .completed-badge {
                top: -6px;
                right: -6px;
                padding: 0.4rem 0.8rem;
                font-size: 0.7rem;
                border-radius: 15px;
            }
        }

        @media (max-width: 480px) {
            .completed-badge {
                top: -4px;
                right: -4px;
                padding: 0.3rem 0.6rem;
                font-size: 0.65rem;
                border-radius: 12px;
            }
        }

        /* Style untuk tab container - simplified for single tab */
        .tab-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: 2px solid #d0d0d0;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Style untuk tombol tab - single tab */
        .tab-button {
            padding: 14px 28px;
            border: none;
            background: #4a5af0;
            color: white;
            font-weight: 700;
            font-size: 17px;
            cursor: default;
            transition: all 0.3s ease;
            position: relative;
            flex: 1;
            text-align: center;
            box-shadow: 0 0 15px rgba(74, 90, 240, 0.4);
        }

        .tab-button:hover {
            background: #3949cc;
        }

        /* Style untuk konten tab */
        .tab-content {
            display: block; /* Always show since there's only one tab */
        }

        /* Style untuk konten tab yang aktif */
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Style untuk badge penyelesaian */
        .completed-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #22C55E;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 20px;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
    @include('sidebar')

        <div class="main-content p-6 relative" style="padding-top: 160px !important;">
            <!-- Decorative elements -->
            <div class="decoration decoration-1">🎮</div>
            <div class="decoration decoration-2">🏆</div>
            <div class="decoration decoration-3">🧩</div>
            <div class="decoration decoration-4">🎯</div>

            <div class="container mx-auto px-4">
                <div class="text-center mb-6 md:mb-8 px-2 md:px-6">
                    <h1 class="content-title">
                        PERMAINAN <i class="fas fa-gamepad ml-2 md:ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Asah kemampuanmu dengan permainan yang menyenangkan!</p>
                </div>
                <div class="gradient-border"></div>

                <!-- Game categories tabs -->
                <div class="w-full max-w-4xl mb-8 md:mb-12">
                    {{-- <div class="tab-container"> --}}
                        {{-- <button class="tab-button active" data-tab="partsbody">Parts of Body</button> --}}
                        <!-- Hide Parts of House and Illness tabs -->
                        <!-- <button class="tab-button" data-tab="partshouse">Parts of House</button> -->
                        <!-- <button class="tab-button" data-tab="illness">Illness</button> -->
                    {{-- </div> --}}

                    @php
                    // Function to check if game is completed with perfect score
                    function isGameCompleted($slug) {
                        if (Auth::check()) {
                            $userGame = \App\Models\UserGame::where('user_id', Auth::id())
                                ->whereHas('game', function($query) use ($slug) {
                                    $query->where('slug', $slug);
                                })
                                ->first();

                            return $userGame && $userGame->completed;
                        }
                        return false;
                    }
                    @endphp

                    <!-- Parts of Body Games -->
                    <div class="tab-content active" id="partsbody">
                        <h2 class="category-title mt-8 md:mt-12 mb-6 md:mb-8 text-white">Tema: Bagian Tubuh (Parts of Body)</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8 px-2 md:px-0">
                            <!-- Word Scramble -->
                            <div class="animate-fadeInUp" style="animation-delay: 0.1s">
                                <div class="game-card" onclick="window.location.href='{{ route('permainan.word-scramble') }}'">
                                    <div class="game-icon orange-theme">
                                        <i class="fas fa-sort-alpha-down"></i>
                                    </div>

                                    @php
                                    // Menggunakan fungsi helper untuk cek status penyelesaian
                                    $perfectScore = isGameCompleted('word-scramble-body');
                                    @endphp

                                    @if($perfectScore)
                                        <div class="completed-badge">
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        </div>
                                    @endif

                                    <h3 class="text-white">Word Scramble</h3>
                                    <div class="flex justify-center gap-2 mb-4">
                                        <span class="badge badge-theme">Parts of Body</span>
                                    </div>
                                    <p>Susun huruf-huruf acak menjadi kata yang benar. Tantang kemampuan spelling dan kosakatamu tentang bagian tubuh manusia! Cocok untuk anak SD kelas 5.</p>
                                    <div class="game-stats">
                                        {{-- <div><i class="fas fa-star text-yellow-400 mr-1"></i> +10 poin</div> --}}
                                        <div><i class="fas fa-clock text-blue-400 mr-1"></i> 5 menit</div>
                                    </div>

                                    @if($perfectScore)
                                        <a href="{{ route('permainan.answers', 'word-scramble-body') }}" class="answers-button" onclick="event.stopPropagation();">
                                            <i class="fas fa-book-open mr-2"></i> Review Jawaban
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Word Matching -->
                            <div class="animate-fadeInUp" style="animation-delay: 0.2s">
                                <div class="game-card" onclick="window.location.href='{{ route('permainan.word-matching') }}'">
                                    <div class="game-icon blue-theme">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>

                                    @php
                                    // Menggunakan fungsi helper untuk cek status penyelesaian
                                    $perfectScore = isGameCompleted('word-matching-body');
                                    @endphp

                                    @if($perfectScore)
                                        <div class="completed-badge">
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        </div>
                                    @endif

                                    <h3 class="text-white">Word Matching</h3>
                                    <div class="flex justify-center gap-2 mb-4">
                                        <span class="badge badge-theme">Parts of Body</span>
                                    </div>
                                    <p>Cocokkan bagian tubuh dengan fungsinya. Permainan seru untuk menguji pengetahuanmu tentang fungsi bagian tubuh! Cocok untuk anak SD kelas 5.</p>
                                    <div class="game-stats">
                                        {{-- <div><i class="fas fa-star text-yellow-400 mr-1"></i> +10 poin</div> --}}
                                        <div><i class="fas fa-clock text-blue-400 mr-1"></i> 5 menit</div>
                                    </div>

                                    @if($perfectScore)
                                        <a href="{{ route('permainan.answers', 'word-matching-body') }}" class="answers-button" onclick="event.stopPropagation();">
                                            <i class="fas fa-book-open mr-2"></i> Review Jawaban
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Word Search -->
                            <div class="animate-fadeInUp" style="animation-delay: 0.3s">
                                <div class="game-card" onclick="window.location.href='{{ route('permainan.word-search') }}'">
                                    <div class="game-icon purple-theme">
                                        <i class="fas fa-search"></i>
                                    </div>

                                    @php
                                    // Menggunakan fungsi helper untuk cek status penyelesaian
                                    $perfectScore = isGameCompleted('word-search-body');
                                    @endphp

                                    @if($perfectScore)
                                        <div class="completed-badge">
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        </div>
                                    @endif

                                    <h3 class="text-white">Word Search</h3>
                                    <div class="flex justify-center gap-2 mb-4">
                                        <span class="badge badge-theme">Parts of Body</span>
                                    </div>
                                    <p>Temukan kata-kata tersembunyi tentang bagian tubuh dalam kotak huruf. Latih ketelitianmu dalam mencari nama-nama bagian tubuh! Cocok untuk anak SD kelas 5.</p>
                                    <div class="game-stats">
                                        {{-- <div><i class="fas fa-star text-yellow-400 mr-1"></i> +15 poin</div> --}}
                                        <div><i class="fas fa-clock text-blue-400 mr-1"></i> 8 menit</div>
                                    </div>

                                    @if($perfectScore)
                                        <a href="{{ route('permainan.answers', 'word-search-body') }}" class="answers-button" onclick="event.stopPropagation();">
                                            <i class="fas fa-book-open mr-2"></i> Review Jawaban
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Word Hangman - NEW -->
                            <div class="animate-fadeInUp" style="animation-delay: 0.4s">
                                <div class="game-card" onclick="window.location.href='{{ route('permainan.word-hangman-body') }}'">
                                    <div class="game-icon purple-theme">
                                        <i class="fas fa-user-slash"></i>
                                    </div>

                                    @php
                                    // Menggunakan fungsi helper untuk cek status penyelesaian
                                    $perfectScore = isGameCompleted('word-hangman-body');
                                    @endphp

                                    @if($perfectScore)
                                        <div class="completed-badge">
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        </div>
                                    @endif

                                    <h3 class="text-white">Word Hangman</h3>
                                    <div class="flex justify-center gap-2 mb-4">
                                        <span class="badge badge-theme">Parts of Body</span>
                                    </div>
                                    <p>Tebak kata yang tersembunyi dengan memilih huruf yang tepat. Permainan seru untuk menguji vocabulary tentang bagian tubuh! Cocok untuk anak SD kelas 5.</p>
                                    <div class="game-stats">
                                        {{-- <div><i class="fas fa-star text-yellow-400 mr-1"></i> +15 poin</div> --}}
                                        <div><i class="fas fa-clock text-blue-400 mr-1"></i> 6 menit</div>
                                    </div>

                                    @if($perfectScore)
                                        <a href="{{ route('permainan.answers', 'word-hangman-body') }}" class="answers-button" onclick="event.stopPropagation();">
                                            <i class="fas fa-book-open mr-2"></i> Review Jawaban
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Sentence Scramble -->
                            <div class="animate-fadeInUp" style="animation-delay: 0.5s">
                                <div class="game-card" onclick="window.location.href='{{ route('permainan.sentence-scramble') }}'">
                                    <div class="game-icon green-theme">
                                        <i class="fas fa-align-left"></i>
                                    </div>

                                    @php
                                    // Menggunakan fungsi helper untuk cek status penyelesaian
                                    $perfectScore = isGameCompleted('sentence-scramble');
                                    @endphp

                                    @if($perfectScore)
                                        <div class="completed-badge">
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        </div>
                                    @endif

                                    <h3 class="text-white">Sentence Scramble</h3>
                                    <div class="flex justify-center gap-2 mb-4">
                                        <span class="badge badge-theme">Parts of Body</span>
                                    </div>
                                    <p>Susun kata-kata acak menjadi kalimat yang benar tentang penggunaan bagian tubuh. Tingkatkan kemampuan grammar dan pemahaman kalimat bahasa Inggris! Cocok untuk anak SD kelas 5.</p>
                                    <div class="game-stats">
                                        {{-- <div><i class="fas fa-star text-yellow-400 mr-1"></i> +15 poin</div> --}}
                                        <div><i class="fas fa-clock text-blue-400 mr-1"></i> 10 menit</div>
                                    </div>

                                    @if($perfectScore)
                                        <a href="{{ route('permainan.answers', 'sentence-scramble') }}" class="answers-button" onclick="event.stopPropagation();">
                                            <i class="fas fa-book-open mr-2"></i> Review Jawaban
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>

                <div class="mt-12 md:mt-16 bg-white bg-opacity-5 rounded-2xl p-6 md:p-8 animate-fadeInUp mx-2 md:mx-0" style="animation-delay: 1.0s">
                    <div class="flex flex-col md:flex-row items-center justify-between text-center md:text-left">
                        <div class="mb-6 md:mb-0">
                            <h2 class="text-xl md:text-2xl font-bold text-white mb-2">Dapatkan Poin & Naik Peringkat</h2>
                            <p class="text-gray-400 max-w-xl text-sm md:text-base">Mainkan game edukatif untuk mendapatkan poin dan naik peringkat di papan skor. Tantang teman-temanmu dan jadilah yang terbaik!</p>
                        </div>
                        <a href="{{ route('leaderboard') }}" class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold py-2 md:py-3 px-4 md:px-6 rounded-full inline-flex items-center transition-all transform hover:scale-105 text-sm md:text-base w-full md:w-auto justify-center md:justify-start">
                            <i class="fas fa-trophy mr-2"></i> Lihat Papan Peringkat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for tab functionality is no longer needed since there's only one tab
        // The Parts of Body tab is always active and visible
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Permainan page loaded - Parts of Body games only');
        });
    </script>
</body>
</html>
