<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar | Media Pembelajaran</title>
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

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
        }

        .exit-button {
            color: white;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .exit-button:hover {
            opacity: 0.8;
        }

        .progress-bar {
            flex-grow: 1;
            height: 12px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            margin: 0 1.5rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: #58CC02;
            border-radius: 999px;
            transition: width 0.3s;
        }

        .attempts-counter {
            display: flex;
            align-items: center;
            color: #1CB0F6;
            font-weight: bold;
        }

        .attempts-counter i {
            margin-right: 0.5rem;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 7rem 1rem 2rem;
        }

        .question-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .question-type {
            display: inline-block;
            background-color: #9333ea;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .question-prompt {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .prompt-image {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
            margin: 0 auto 2rem;
            border-radius: 1rem;
            border: 3px solid #374151;
        }

        .options-container {
            display: grid;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .option-item {
            position: relative;
            border: 2px solid #374151;
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .option-item:hover {
            border-color: #4b5563;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .option-item.selected {
            border-color: #1CB0F6;
            background-color: rgba(28, 176, 246, 0.1);
        }

        .option-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #374151;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .option-item.selected .option-number {
            background-color: #1CB0F6;
        }

        .option-text {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .option-image {
            width: 60px;
            height: 60px;
            margin-right: 1rem;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        /* Larger images for select_image type */
        .select-image {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .select-image .option-image {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            object-fit: contain;
            border: none;
            border-radius: 0;
            padding: 0;
        }

        .select-image .option-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            height: 220px;
            border-radius: 12px;
            background-color: rgba(30, 41, 59, 0.7);
            transition: all 0.2s ease;
        }

        .select-image .option-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4);
        }

        .select-image .option-item.selected {
            background-color: rgba(28, 176, 246, 0.2);
            border-color: #1CB0F6;
            box-shadow: 0 0 0 2px #1CB0F6;
        }

        .select-image .option-item.selected .option-image {
            border-color: #1CB0F6;
        }

        .select-image .option-number {
            margin-right: 0;
            margin-bottom: 1rem;
            background-color: #1e293b;
            z-index: 2;
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
        }

        .answer-button {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: #58CC02;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 2rem;
        }

        .answer-button:disabled {
            background-color: #4b5563;
            cursor: not-allowed;
        }

        .answer-button:not(:disabled):hover {
            background-color: #46a501;
            transform: translateY(-2px);
        }

        /* Sentence arrangement specific styles */
        .word-bank {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            min-height: 60px;
            padding: 0.5rem;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sentence-builder {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            min-height: 60px;
            padding: 1rem;
            border-radius: 8px;
            border: 2px dashed #4b5563;
            background-color: rgba(28, 176, 246, 0.1);
        }

        .word-item {
            padding: 0.5rem 1rem;
            background-color: #374151;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .word-item:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
        }

        .word-item.selected {
            background-color: #1CB0F6;
        }

        .notification {
            animation: fadeIn 0.3s ease-in-out;
            position: relative;
        }

        .notification i {
            font-size: 1.5rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom styles for the footer notification */
        .footer-notification {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem 2rem;
            z-index: 1001;
            color: white;
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
            display: none; /* Hidden initially, shown via JavaScript */
        }

        .footer-notification.show {
            display: block;
            animation: slideUp 0.5s forwards;
        }

        .footer-notification.hide {
            transform: translateY(100%);
            opacity: 0;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .footer-correct {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .footer-wrong {
            background: linear-gradient(135deg, #dc2626, #991b1b);
        }

        .notification-content {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .notification-content i {
            font-size: 1.75rem;
            margin-right: 1rem;
        }

        .notification-content p.font-bold {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 1rem;
            }

            .container {
                padding: 6rem 1rem 2rem;
            }

            .question-prompt {
                font-size: 1.5rem;
            }

            /* Menyesuaikan ukuran gambar pada layar kecil */
            .select-image .option-image {
                width: 120px;
                height: 120px;
            }

            .select-image .option-item {
                padding: 1rem;
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <div class="top-bar">
        <a href="{{ route('belajar.index') }}" class="exit-button">
            <i class="fas fa-times"></i>
        </a>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ ($questionIndex / count($questionIds)) * 100 }}%;"></div>
        </div>
        <div class="attempts-counter">
            <i class="fas fa-redo-alt"></i>
            <span>
                @if(($remainingAttempts ?? 3) > 1)
                    {{ $remainingAttempts ?? 3 }} kesempatan
                @else
                    Kesempatan terakhir
                @endif
            </span>
        </div>
    </div>

    <div class="container">
        <div class="question-header">
            <div class="question-type">{{ strtoupper(str_replace('_', ' ', $question->type)) }}</div>

            @if($question->type == 'image_choice')
                <!-- Display the image as the question prompt -->
                @if($question->prompt_type == 'image')
                    @if(!empty($question->image_url))
                        <img src="{{ asset('images/' . $question->image_url) }}" alt="Question Image" class="prompt-image">
                    @else
                        <img src="{{ asset('images/' . $question->prompt) }}" alt="Question Image" class="prompt-image">
                    @endif
                @endif
                <h1 class="question-prompt">Pilih jawaban yang benar:</h1>
            @else
                <h1 class="question-prompt">{{ $question->prompt }}</h1>
            @endif
        </div>

        <form id="answerForm" action="{{ route('belajar.answer') }}" method="POST">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id }}">

            @if(in_array($question->type, ['multiple_choice', 'select_image', 'image_choice']))
                <div class="options-container {{ $question->type == 'select_image' ? 'select-image' : '' }}">
                    @php
                        $options = json_decode($question->options);
                    @endphp
                    @foreach($options as $index => $option)
                        <div class="option-item" onclick="selectOption(this, '{{ $option }}')">
                            <div class="option-number">{{ $index + 1 }}</div>
                            @if($question->type == 'select_image')
                                <img src="{{ asset('images/' . $option) }}" alt="Option {{ $index + 1 }}" class="option-image">
                            @else
                                <div class="option-text">{{ $option }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="answer" id="selectedAnswer">

            @elseif($question->type == 'sentence_arrange')
                <!-- Sentence arrangement UI -->
                <div class="mb-4">
                    <p class="text-gray-300 mb-2">Susun kata-kata berikut menjadi kalimat yang benar:</p>

                    <!-- Area to display the sentence being built -->
                    <div class="sentence-builder" id="sentenceBuilder"></div>

                    <!-- Word bank with available words -->
                    <div class="word-bank" id="wordBank">
                        @php
                            $words = json_decode($question->options);
                            shuffle($words); // Randomize word order
                        @endphp

                        @foreach($words as $word)
                            <div class="word-item" onclick="moveWord(this)">{{ $word }}</div>
                        @endforeach
                    </div>

                    <!-- Hidden input to submit the arranged sentence -->
                    <input type="hidden" name="answer" id="arrangedSentence">
                </div>

            @else
                <div class="mb-4">
                    <input type="text" name="answer" class="w-full bg-gray-800 text-white border-2 border-gray-700 rounded-lg p-4 text-lg" placeholder="Ketik jawaban Anda di sini..." required>
                </div>
            @endif

            <button type="submit" id="checkButton" class="answer-button" disabled>PERIKSA</button>
        </form>
    </div>

    @if(session('status'))
    <!-- Footer Notification -->
    <div id="footerNotification" class="footer-notification {{ session('status') == 'correct' ? 'footer-correct' : 'footer-wrong' }}">
        <div class="notification-content">
            <i class="fas {{ session('status') == 'correct' ? 'fa-check-circle' : 'fa-times-circle' }} mr-3"></i>
            <div>
                @if(session('status') == 'correct')
                    <p class="font-bold">{{ session('message') }}</p>
                @else
                    <p class="font-bold">{{ session('message') }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    <script>
        // For option selection (multiple choice)
        function selectOption(element, answer) {
            // Remove selected class from all options
            document.querySelectorAll('.option-item').forEach(item => {
                item.classList.remove('selected');
            });

            // Add selected class to clicked option
            element.classList.add('selected');

            // Update hidden input with selected answer
            document.getElementById('selectedAnswer').value = answer;

            // Enable the check button
            document.getElementById('checkButton').disabled = false;
        }

        // For sentence arrangement
        function moveWord(element) {
            const sentenceBuilder = document.getElementById('sentenceBuilder');
            const wordBank = document.getElementById('wordBank');

            // Check if word is in the bank or in the sentence builder
            if (element.parentNode === wordBank) {
                // Move from word bank to sentence builder
                sentenceBuilder.appendChild(element);
            } else {
                // Move from sentence builder back to word bank
                wordBank.appendChild(element);
            }

            // Update the hidden input with the current sentence
            updateArrangedSentence();
        }

        function updateArrangedSentence() {
            const sentenceBuilder = document.getElementById('sentenceBuilder');
            const words = Array.from(sentenceBuilder.children).map(word => word.textContent);

            // Join words with comma for easier processing in PHP
            const sentence = words.join(',');

            // Update hidden input
            document.getElementById('arrangedSentence').value = sentence;

            // Enable submit button if at least one word has been used
            document.getElementById('checkButton').disabled = words.length === 0;
        }

        // For text input questions
        const textInput = document.querySelector('input[type="text"]');
        if (textInput) {
            textInput.addEventListener('input', function() {
                document.getElementById('checkButton').disabled = this.value.trim() === '';
            });
        }

        // Auto-hide footer notification after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('footerNotification');
            if (notification) {
                // Show the notification with animation
                setTimeout(() => {
                    notification.classList.add('show');
                }, 100);

                // Set a timeout to hide it after 4 seconds
                setTimeout(function() {
                    notification.classList.add('hide');

                    // Remove from DOM after animation completes
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 500); // Match this with the CSS transition duration
                }, 4000);
            }
        });
    </script>
</body>
</html>
