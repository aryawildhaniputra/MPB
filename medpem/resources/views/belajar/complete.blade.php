<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelajaran Selesai | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #111827;
            color: white;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .celebration {
            text-align: center;
            margin-bottom: 2rem;
        }

        .lesson-complete {
            background-color: #111827;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .badge {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
            animation: pulse 2s infinite;
        }

        .badge img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .congrats {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #FFC107, #FF5722);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stats-container {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background-color: #1F2937;
            border-radius: 12px;
            flex: 1;
            min-width: 100px;
            max-width: 150px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #58CC02;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #9CA3AF;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            justify-content: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            font-weight: 700;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            white-space: nowrap;
            width: auto;
        }

        .btn-primary {
            background-color: #58CC02;
            color: white;
        }

        .btn-primary:hover {
            background-color: #46a501;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #334155;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #475569;
            transform: translateY(-2px);
        }

        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: -1;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .lesson-complete {
                padding: 1.5rem;
            }

            .congrats {
                font-size: 2rem;
            }

            .badge {
                width: 100px;
                height: 100px;
            }

            .stats-container {
                flex-direction: row;
                gap: 0.75rem;
                justify-content: center;
            }

            .stat-item {
                min-width: 28%;
                padding: 0.75rem 0.5rem;
                flex: 0 0 auto;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .action-buttons {
                flex-direction: column-reverse;
                width: 100%;
                gap: 0.75rem;
            }

            .btn {
                width: 100%;
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .stats-container {
                margin: 1.5rem 0;
            }

            .congrats {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lesson-complete">
            <div class="badge">
                <img src="https://cdn-icons-png.flaticon.com/512/2583/2583344.png" alt="Achievement Badge">
            </div>

            <h1 class="congrats">Selamat!</h1>
            <p class="text-xl mb-4">Kamu telah menyelesaikan pelajaran <strong>{{ $lesson->title }}</strong>!</p>

            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-value">{{ $pointsAwarded }}</div>
                    <div class="stat-label">Poin</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $userLesson->pivot->current_streak ?? 0 }}</div>
                    <div class="stat-label">Streak</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ 2 - ($userLesson->pivot->mistakes_count ?? 0) }}</div>
                    <div class="stat-label">Kesalahan</div>
                </div>
            </div>

            <p class="text-gray-400 mb-6">Teruslah belajar untuk mendapatkan lebih banyak lencana!</p>

            <div class="action-buttons">
                <a href="{{ route('belajar.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="{{ route('belajar.index') }}" class="btn btn-primary">
                    Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="confetti" id="confetti-container"></div>
</body>
</html>
