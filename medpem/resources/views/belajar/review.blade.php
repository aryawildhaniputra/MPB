<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Pelajaran | {{ $lesson->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap');

        body {
            font-family: 'Comic Neue', 'Nunito', sans-serif;
            background-color: #0a0e17;
            color: #ffffff;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            transition: all 0.3s;
            width: calc(100% - 250px);
            min-height: calc(100vh - 70px);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 120px;
            }
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(90deg, #10B981, #3B82F6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #94A3B8;
            font-size: 1.1rem;
        }

        .question-list {
            margin-bottom: 2rem;
        }

        .question-card {
            background-color: #1F2937;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid #374151;
            transition: all 0.3s ease;
        }

        .question-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            border-color: #4B5563;
        }

        .question-number {
            font-size: 0.9rem;
            color: #9CA3AF;
            margin-bottom: 0.5rem;
        }

        .question-text {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .question-type {
            display: inline-block;
            background-color: #374151;
            color: #D1D5DB;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .answer-section {
            background-color: #111827;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .answer-label {
            font-size: 0.9rem;
            color: #9CA3AF;
            margin-bottom: 0.5rem;
        }

        .answer-text {
            font-size: 1.1rem;
            color: #10B981;
            font-weight: 700;
            padding: 0.5rem;
            background-color: rgba(16, 185, 129, 0.1);
            border-radius: 4px;
            border-left: 3px solid #10B981;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-primary {
            background-color: #3B82F6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563EB;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #4B5563;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #374151;
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: #6B7280;
            color: white;
        }

        .btn-back:hover {
            background-color: #4B5563;
            transform: translateY(-2px);
        }

        .part-navigation {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        .part-button {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            background-color: #374151;
            color: #D1D5DB;
            transition: all 0.3s ease;
        }

        .part-button:hover {
            background-color: #4B5563;
            transform: translateY(-2px);
        }

        .part-button.active {
            background-color: #3B82F6;
            color: white;
        }

        .image-option {
            max-width: 100%;
            max-height: 150px;
            margin-top: 0.5rem;
            border-radius: 8px;
            border: 2px solid #374151;
        }

        /* Success notification */
        .notification {
            position: fixed;
            top: 90px;
            right: 20px;
            background-color: #3B82F6;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 400px;
            opacity: 0;
            transition: all 0.5s ease;
            transform: translateX(100px);
            display: flex;
            align-items: center;
        }

        .notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .notification i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
    @include('header')
    <div class="flex">
        @include('sidebar')

        <div class="main-content">
            <!-- Notification Message for Info -->
            @if(session('info'))
            <div class="notification" id="infoNotification">
                <i class="fas fa-info-circle"></i>
                <span>{{ session('info') }}</span>
            </div>
            @endif

            <div class="container">
                <div class="header">
                    <h1 class="title">Review Pelajaran: {{ $lesson->title }}</h1>
                    <p class="subtitle">Bagian {{ $part }} dari 6 - Lihat soal dan jawaban yang sudah kamu selesaikan</p>
                </div>

                <div class="part-navigation">
                    @for ($i = 1; $i <= 6; $i++)
                        @php
                            $partFieldName = 'part' . $i . '_completed';
                            $partCompleted = $status[$partFieldName] ?? false;
                        @endphp

                        @if($partCompleted)
                            <a href="{{ route('belajar.review', ['id' => $lesson->id, 'part' => $i]) }}"
                               class="part-button {{ $part == $i ? 'active' : '' }}">
                                Bagian {{ $i }}
                            </a>
                        @else
                            <span class="part-button opacity-50 cursor-not-allowed">Bagian {{ $i }}</span>
                        @endif
                    @endfor
                </div>

                <div class="question-list">
                    @forelse ($partQuestions as $index => $question)
                        <div class="question-card">
                            <div class="question-number">Soal {{ $index + 1 }}</div>

                            <div class="question-type">
                                @switch($question->type)
                                    @case('multiple_choice')
                                        <i class="fas fa-list-ul mr-1"></i> Pilihan Ganda
                                        @break
                                    @case('text_input')
                                        <i class="fas fa-keyboard mr-1"></i> Isian Teks
                                        @break
                                    @case('translation')
                                        <i class="fas fa-language mr-1"></i> Terjemahan
                                        @break
                                    @case('select_image')
                                        <i class="fas fa-image mr-1"></i> Pilih Gambar
                                        @break
                                    @case('image_choice')
                                        <i class="fas fa-images mr-1"></i> Pilihan Gambar
                                        @break
                                    @default
                                        <i class="fas fa-question-circle mr-1"></i> Lainnya
                                @endswitch
                            </div>

                            <div class="question-text">{{ $question->question_text }}</div>

                            @if($question->type == 'multiple_choice')
                                <div class="options-list">
                                    @php
                                        $options = is_string($question->options) ? json_decode($question->options, true) : $question->options;
                                    @endphp

                                    @if(is_array($options))
                                        @foreach($options as $option)
                                            <div class="option mb-2 flex items-center">
                                                <div class="w-6 h-6 rounded-full flex items-center justify-center mr-2
                                                    {{ $option == $question->correct_answer_display ? 'bg-green-500' : 'bg-gray-600' }}">
                                                    @if($option == $question->correct_answer_display)
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    @endif
                                                </div>
                                                <span class="{{ $option == $question->correct_answer_display ? 'text-green-400 font-bold' : 'text-gray-300' }}">
                                                    {{ $option }}
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @elseif($question->type == 'select_image' || $question->type == 'image_choice')
                                <div class="options-list grid grid-cols-2 gap-4 mt-4">
                                    @php
                                        $options = is_string($question->options) ? json_decode($question->options, true) : $question->options;
                                    @endphp

                                    @if(is_array($options))
                                        @foreach($options as $option)
                                            <div class="option relative">
                                                <img src="{{ asset('images/' . $option) }}" alt="Option" class="image-option">
                                                @if($option == $question->correct_answer_display)
                                                    <div class="absolute top-2 right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endif

                            <div class="answer-section">
                                <div class="answer-label">Jawaban Benar:</div>
                                <div class="answer-text">{{ $question->correct_answer_display }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-400">
                            <i class="fas fa-info-circle text-3xl mb-4"></i>
                            <p>Tidak ada pertanyaan untuk bagian ini.</p>
                        </div>
                    @endforelse
                </div>

                <div class="nav-buttons">
                    <a href="{{ route('belajar.index') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pelajaran
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle notifications
            const notification = document.getElementById('infoNotification');
            if (notification) {
                // Show the notification with animation
                setTimeout(() => {
                    notification.classList.add('show');
                }, 100);

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
    </script>
</body>
</html>
