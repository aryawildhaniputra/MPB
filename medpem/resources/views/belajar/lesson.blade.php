<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson->title }} | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s;
            z-index: 1;
        }

        .header-dropdown-container, .duolingo-header, .user-avatar, #userAvatarControl, #avatarClickOverlay {
            z-index: 1000 !important;
            position: relative !important;
        }

        #userDropdownDiv {
            z-index: 1001 !important;
        }

        .attempt-counter {
            position: fixed;
            top: 85px;
            right: 2rem;
            background-color: white;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            z-index: 100;
        }

        .attempt-icon {
            color: #1CB0F6;
            margin-right: 0.5rem;
        }

        .attempt-count {
            font-weight: 800;
            color: #4b4b4b;
        }

        .lesson-card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            max-width: 700px;
            margin: 0 auto;
        }

        .lesson-header {
            background-color: {{ $lesson->icon_color }};
            padding: 2rem;
            color: white;
            text-align: center;
        }

        .lesson-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .lesson-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .lesson-body {
            padding: 2rem;
        }

        .lesson-description {
            color: #4b4b4b;
            line-height: 1.7;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .lesson-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            color: #717171;
            font-size: 1rem;
        }

        .info-icon {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }

        .lesson-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .start-button {
            width: 100%;
            padding: 1rem;
            background-color: #58CC02;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .start-button:hover {
            background-color: #46a501;
            transform: translateY(-2px);
        }

        .back-button {
            width: 100%;
            padding: 1rem;
            background-color: #f8f9fa;
            color: #4b4b4b;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background-color: #e9ecef;
        }

        #achievementModalOverlay {
            z-index: 9999 !important;
        }

        #achievementModal {
            z-index: 10000 !important;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 130px;
            }

            .attempt-counter {
                top: 70px;
            }

            .lesson-card {
                margin: 0 1rem;
            }

            .lesson-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('header')
    <div class="flex">
        @include('sidebar')

        <div class="main-content">
            <!-- Attempt Counter -->
            <div class="attempt-counter">
                <div class="attempt-icon">
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
                <div class="attempt-count">2 kesempatan</div>
            </div>

            <div class="container mx-auto px-4">
                <div class="lesson-card">
                    <div class="lesson-header">
                        <div class="lesson-icon">
                            <i class="fas fa-{{ $lesson->icon ?? 'star' }}"></i>
                        </div>
                        <h1 class="lesson-title">{{ $lesson->title }}</h1>
                        <p class="text-white opacity-90">Pelajaran {{ $lesson->level }}</p>
                    </div>

                    <div class="lesson-body">
                        <p class="lesson-description">{{ $lesson->description }}</p>

                        <div class="lesson-info">
                            <div class="info-item">
                                <div class="info-icon text-yellow-500">
                                    <i class="fas fa-award"></i>
                                </div>
                                <span>Level {{ $lesson->level }}</span>
                            </div>

                            <div class="info-item">
                                <div class="info-icon text-green-500">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <span>{{ $lesson->questions->count() }} Pertanyaan</span>
                            </div>
                        </div>

                        <div class="lesson-actions">
                            <form action="{{ route('belajar.start', $lesson->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="start-button">
                                    MULAI PELAJARAN <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </form>

                            <a href="{{ route('belajar') }}" class="back-button">
                                <i class="fas fa-arrow-left mr-2"></i> KEMBALI
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.achievement-notification')
</body>
</html>
