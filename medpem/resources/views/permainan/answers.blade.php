<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $answersData['title'] }} - Jawaban & Penjelasan</title>
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
                padding-top: 180px;
            }
        }

        .answers-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #4A90E2, #5b6af0);
            color: #ffffff;
            margin-bottom: 1rem;
            text-align: center;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .answers-description {
            text-align: center;
            color: #ffffff;
            margin-bottom: 2rem;
            font-size: 1.2rem;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: 300px;
            background: linear-gradient(90deg, #4A90E2, #6366F1);
            margin: 0 auto 2rem auto;
            border-radius: 2px;
            box-shadow: 0 2px 6px rgba(99, 102, 241, 0.3);
        }

        .answers-container {
            background: #ffffff;
            border-radius: 20px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .answer-item {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 12px;
            background-color: #f8fafc;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-left: 5px solid #4A90E2;
        }

        .answer-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .answer-item:last-child {
            margin-bottom: 0;
        }

        .answer-term {
            font-size: 1.5rem;
            font-weight: 800;
            color: #151b2e;
            margin-bottom: 1rem;
            padding: 0.5rem 0;
            border-bottom: 2px solid rgba(74, 144, 226, 0.2);
            display: flex;
            align-items: center;
        }

        .answer-term::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #4A90E2;
            border-radius: 50%;
            margin-right: 10px;
        }

        .answer-definition {
            font-size: 1.1rem;
            color: #374151;
            margin-bottom: 1rem;
            line-height: 1.6;
            padding: 0.75rem 1rem;
            border-left: 4px solid #4A90E2;
            background-color: rgba(74, 144, 226, 0.05);
            border-radius: 0 8px 8px 0;
        }

        .answer-translation {
            font-size: 1rem;
            color: #4b5563;
            background-color: #f3f4f6;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-top: 0.75rem;
            font-style: italic;
            border-left: 4px solid #6366F1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4A90E2, #3673B5);
            color: white;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            text-align: center;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .back-button:hover {
            background: linear-gradient(135deg, #3673B5, #2A5C94);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(74, 144, 226, 0.4);
        }

        .back-button i {
            margin-right: 0.5rem;
        }

        .game-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4A90E2, #6366F1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            font-size: 2.5rem;
            color: white;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .game-icon:hover {
            transform: translateY(-5px) rotate(10deg);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.25);
        }

        .perfect-badge {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(5, 150, 105, 0.3);
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        .perfect-badge i {
            margin-right: 0.75rem;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .answer-hint {
            background-color: #FFF9E6;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-top: 0.75rem;
            font-size: 1rem;
            color: #92400e;
            border-left: 4px solid #F59E0B;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .answer-hint::before {
            content: '\f0eb';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            margin-right: 0.75rem;
            color: #F59E0B;
        }

        .answer-image {
            margin-top: 1rem;
            text-align: center;
            background-color: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Different colors for different game types */
        .game-icon.orange-theme {
            background: linear-gradient(135deg, #FF9500, #FF5252);
        }

        .game-icon.blue-theme {
            background: linear-gradient(135deg, #36D1DC, #5B86E5);
        }

        .game-icon.purple-theme {
            background: linear-gradient(135deg, #9D50BB, #6E48AA);
        }

        .game-icon.green-theme {
            background: linear-gradient(135deg, #11998e, #38ef7d);
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
                    <div class="game-icon">
                        @if(str_contains($answersData['title'], 'Word Scramble'))
                            <i class="fas fa-sort-alpha-down"></i>
                        @elseif(str_contains($answersData['title'], 'Word Matching'))
                            <i class="fas fa-exchange-alt"></i>
                        @elseif(str_contains($answersData['title'], 'Word Search'))
                            <i class="fas fa-search"></i>
                        @elseif(str_contains($answersData['title'], 'Image Guessing'))
                            <i class="fas fa-image"></i>
                        @elseif(str_contains($answersData['title'], 'Image Matching'))
                            <i class="fas fa-th"></i>
                        @else
                            <i class="fas fa-book-open"></i>
                        @endif
                    </div>
                    <div class="perfect-badge">
                        <i class="fas fa-check-circle"></i> Nilai Sempurna 100%
                    </div>
                    <h1 class="answers-title">{{ $answersData['title'] }}</h1>
                    <p class="answers-description">{{ $answersData['description'] }}</p>
                    <div class="gradient-border"></div>
                </div>

                <div class="answers-container">
                    @if(count($answersData['items']) > 0)
                        @foreach($answersData['items'] as $item)
                            <div class="answer-item">
                                @if(isset($item['term']))
                                    <h3 class="answer-term">{{ $item['term'] }}</h3>
                                @elseif(isset($item['word']))
                                    <h3 class="answer-term">{{ $item['word'] }}</h3>
                                @elseif(isset($item['answer']))
                                    <h3 class="answer-term">{{ $item['answer'] }}</h3>
                                @endif

                                @if(isset($item['definition']))
                                    <p class="answer-definition">{{ $item['definition'] }}</p>
                                @elseif(isset($item['explanation']))
                                    <p class="answer-definition">{{ $item['explanation'] }}</p>
                                @endif

                                @if(isset($item['translation']))
                                    <p class="answer-translation">{{ $item['translation'] }}</p>
                                @endif

                                @if(isset($item['hint']))
                                    <p class="answer-hint"><strong>Petunjuk:</strong> {{ $item['hint'] }}</p>
                                @endif

                                @if(isset($item['image']))
                                    <div class="answer-image">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['term'] ?? $item['word'] ?? $item['answer'] ?? 'Gambar' }}" class="max-h-48 mx-auto mt-3 mb-3 rounded-lg">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-600">Maaf, jawaban untuk permainan ini masih dalam proses pembuatan.</p>
                    @endif
                </div>

                <!-- Tombol Kembali ke Daftar Permainan -->
                <div class="flex justify-center mt-8">
                    <a href="{{ route('permainan.index') }}" class="back-button">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Permainan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation for answer items
            const answerItems = document.querySelectorAll('.answer-item');
            answerItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    item.style.transition = 'all 0.5s ease';

                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 150);
            });
        });
    </script>
</body>
</html>
