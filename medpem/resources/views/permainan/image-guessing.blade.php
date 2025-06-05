<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gameData['title'] }} - Media Pembelajaran</title>
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
            padding-top: 100px;
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

        @media (max-width: 480px) {
            .main-content {
                padding-top: 90px !important;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        .game-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: #0ED2F7;
            color: #ffffff;
            margin-bottom: 0.5rem;
            text-align: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .game-title {
                font-size: 2rem;
                padding: 0.4rem 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .game-title {
                font-size: 1.6rem;
                padding: 0.3rem 0.6rem;
            }
        }

        @media (max-width: 640px) {
            .game-title {
                font-size: 1.5rem;
                padding: 0.25rem 0.5rem;
            }
        }

        .game-description {
            text-align: center;
            color: #ffffff;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 0.5rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .game-description {
                font-size: 1rem;
                margin-bottom: 1.5rem;
                padding: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .game-description {
                font-size: 0.9rem;
                margin-bottom: 1rem;
                padding: 0.3rem;
            }
        }

        @media (max-width: 640px) {
            .game-description {
                font-size: 0.85rem;
            }
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: 300px;
            background: linear-gradient(90deg, #0ED2F7, #09C6F9);
            margin: 0 auto 2rem auto;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .gradient-border {
                max-width: 250px;
                margin-bottom: 1.5rem;
                height: 3px;
            }
        }

        @media (max-width: 480px) {
            .gradient-border {
                max-width: 200px;
                margin-bottom: 1rem;
            }
        }

        .game-container {
            background: #ffffff;
            border-radius: 20px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .game-container {
                padding: 1.5rem;
                border-radius: 16px;
                margin: 0 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .game-container {
                padding: 1rem;
                border-radius: 12px;
                margin: 0;
            }
        }

        @media (max-width: 640px) {
            .game-container {
                padding: 0.75rem;
                border-radius: 10px;
            }
        }

        .game-stats {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .stat-item {
            text-align: center;
            padding: 0 1rem;
        }

        .stat-title {
            color: #151b2e;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #151b2e;
        }

        .stat-value.score {
            color: #FF9500;
        }

        .progress-container {
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            margin-bottom: 2rem;
            overflow: hidden;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .progress-bar {
            height: 10px;
            background: linear-gradient(90deg, #FF9500, #FF5252);
            width: 0%;
            transition: width 0.5s ease;
            border-radius: 10px;
        }

        .option-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 15px;
            margin: 0.5rem;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
            background-color: white;
            color: #151b2e;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .option-btn::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 0;
            background-color: rgba(255, 149, 0, 0.1);
            transition: height 0.3s ease;
            z-index: -1;
        }

        .option-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-color: #FF9500;
        }

        .option-btn:hover::before {
            height: 100%;
        }

        .option-btn.selected {
            background-color: #FF9500;
            color: white;
            border-color: #FF9500;
            box-shadow: 0 4px 12px rgba(255, 149, 0, 0.4);
        }

        .option-btn.correct {
            background-color: #58CC02;
            color: white;
            border-color: #58CC02;
            box-shadow: 0 4px 12px rgba(88, 204, 2, 0.4);
        }

        .option-btn.correct::after {
            content: '✓';
            margin-left: 8px;
            font-weight: bold;
        }

        .option-btn.incorrect {
            background-color: #FF5252;
            color: white;
            border-color: #FF5252;
            box-shadow: 0 4px 12px rgba(255, 82, 82, 0.4);
        }

        .option-btn.incorrect::after {
            content: '✗';
            margin-left: 8px;
            font-weight: bold;
        }

        .image-container {
            text-align: center;
            margin-bottom: 2rem;
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #FF9500, #FF5252);
            border-radius: 15px 15px 0 0;
        }

        .image-container img {
            max-width: 250px;
            height: auto;
            margin: 0 auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            object-fit: contain;
            max-height: 200px;
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        .image-caption {
            margin-top: 1rem;
            font-weight: 600;
            color: #555;
            font-size: 1.1rem;
        }

        .hint-container {
            background-color: #FFF9E6;
            border-left: 4px solid #FF9500;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 0 10px 10px 0;
            color: #151b2e;
        }

        .control-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(90deg, #FF9500, #FF5252);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #151b2e;
            border: 2px solid #151b2e;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background: #e0e0e0;
        }

        .explanation {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            display: none;
            color: #151b2e;
            border-left: 4px solid #58CC02;
        }

        .explanation h3 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .game-over-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            display: none;
            color: #151b2e;
        }

        .game-over-container h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #151b2e;
        }

        .game-over-stats {
            display: flex;
            justify-content: space-around;
            margin: 2rem 0;
        }

        .game-over-stat {
            text-align: center;
        }

        .game-over-stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #000000;
        }

        .game-over-stat-label {
            font-size: 1rem;
            color: #151b2e;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f2d74e;
            border-radius: 50%;
            animation: confetti 5s ease-in-out infinite;
        }

        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <div class="container mx-auto">
                <h1 class="game-title">{{ $gameData['title'] }}</h1>
                <p class="game-description">{{ $gameData['description'] }}</p>
                <div class="gradient-border"></div>

                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-title">Skor</div>
                        <div class="stat-value score" id="score">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Benar</div>
                        <div class="stat-value" id="correct-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Tersisa</div>
                        <div class="stat-value" id="remaining-count">{{ count($gameData['items']) }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Waktu</div>
                        <div class="stat-value" id="timer">00:00</div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>

                <div class="game-container" id="game-content">
                    <!-- Current question container -->
                    <div id="question-container">
                        <!-- Image guessing area -->
                        <div class="image-container">
                            <!-- TODO: Replace with appropriate images for the guessing game.
                                 These images should be clear representations of the objects to guess.
                                 Recommended size: 400x300px minimum with consistent aspect ratio.
                                 Current src attribute will be populated dynamically with placeholder images. -->
                            <!-- <img id="current-image" src="" alt="Gambar untuk ditebak" class="mx-auto"> -->
                            <div class="p-8 bg-yellow-100 rounded-lg border-2 border-yellow-300">
                                <i class="fas fa-exclamation-triangle text-4xl text-yellow-500 mb-4 block"></i>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Gambar Belum Tersedia</h3>
                                <p class="text-gray-700">Gambar sedang dalam proses persiapan untuk peningkatan kualitas permainan.</p>
                            </div>
                            <div class="image-caption">Apa gambar ini?</div>
                        </div>

                        <div class="hint-container">
                            <div class="font-semibold">Petunjuk:</div>
                            <div id="current-hint"></div>
                        </div>

                        <!-- Options -->
                        <div id="options-container" class="grid grid-cols-2 gap-4 mb-6">
                            <!-- Options will be added here dynamically -->
                        </div>

                        <div class="explanation" id="explanation">
                            <h3>Jawaban Benar: <span id="correct-answer"></span></h3>
                            <p id="explanation-text"></p>
                        </div>

                        <div class="control-buttons">
                            <button id="hint-btn" class="btn btn-secondary">
                                <i class="fas fa-lightbulb mr-2"></i> Tampilkan Petunjuk
                            </button>
                            <button id="next-btn" class="btn btn-primary" style="display: none;">
                                Lanjut <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>

                        <!-- Tombol Kembali ke Daftar Permainan -->
                        <div class="flex justify-center mt-6">
                            <a href="{{ route('permainan.index') }}" class="btn btn-secondary" style="max-width: 300px; width: 100%;">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Permainan
                            </a>
                        </div>
                    </div>

                    <!-- Game over container -->
                    <div id="game-over-container" class="game-over-container">
                        <h2>Permainan Selesai!</h2>
                        <p>Kamu telah menyelesaikan permainan image guessing.</p>

                        <div class="game-over-stats">
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-score">0</div>
                                <div class="game-over-stat-label">Skor Akhir</div>
                            </div>
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-correct">0</div>
                                <div class="game-over-stat-label">Jawaban Benar</div>
                            </div>
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-time">00:00</div>
                                <div class="game-over-stat-label">Waktu</div>
                            </div>
                        </div>

                        <div class="flex justify-center mb-6">
                            <a href="{{ route('permainan.answers', ['slug' => 'image-guessing-body']) }}" class="btn btn-primary" style="max-width: 300px; width: 100%;">
                                <i class="fas fa-book-open mr-2"></i> Review Jawaban
                            </a>
                        </div>

                        <div class="flex justify-center">
                            <a href="{{ route('permainan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Permainan
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Game variables
            const gameData = @json($gameData['items']);
            let currentQuestionIndex = 0;
            let score = 0;
            let correctAnswers = 0;
            let selectedOption = null;
            let timer;
            let seconds = 0;
            let isGameOver = false;
            let hintShown = false;

            // DOM elements
            const scoreElement = document.getElementById('score');
            const correctCountElement = document.getElementById('correct-count');
            const remainingCountElement = document.getElementById('remaining-count');
            const timerElement = document.getElementById('timer');
            const progressBar = document.getElementById('progress-bar');
            const questionContainer = document.getElementById('question-container');
            const gameOverContainer = document.getElementById('game-over-container');
            const currentImage = document.getElementById('current-image');
            const currentHint = document.getElementById('current-hint');
            const optionsContainer = document.getElementById('options-container');
            const explanationDiv = document.getElementById('explanation');
            const correctAnswerSpan = document.getElementById('correct-answer');
            const nextButton = document.getElementById('next-btn');
            const hintButton = document.getElementById('hint-btn');

            // Final stats
            const finalScore = document.getElementById('final-score');
            const finalCorrect = document.getElementById('final-correct');
            const finalTime = document.getElementById('final-time');

            // Start the game
            initGame();

            function initGame() {
                // Shuffle the questions
                shuffleArray(gameData);

                // Start timer
                startTimer();

                // Show first question
                showQuestion(currentQuestionIndex);

                // Update progress bar
                updateProgressBar();
            }

            function showQuestion(index) {
                const question = gameData[index];

                // Reset for new question
                selectedOption = null;
                hintShown = false;

                // Set image and hint
                // TODO: Replace all images in the gameData with appropriate images.
                // Each image should clearly represent the object to be guessed
                // Images should be stored in the public/images/games/image-guessing/ directory
                // and referenced as "/images/games/image-guessing/[filename]"
                // currentImage.src = question.image; // Temporarily disabled until proper images are available
                currentHint.textContent = question.hint;
                currentHint.parentElement.style.display = 'none'; // Hide hint initially

                // Clear options container
                optionsContainer.innerHTML = '';

                // Shuffle options
                const options = [...question.options];
                shuffleArray(options);

                // Create option buttons
                options.forEach(option => {
                    const optionBtn = document.createElement('button');
                    optionBtn.className = 'option-btn';
                    optionBtn.textContent = option;
                    optionBtn.dataset.option = option;
                    optionBtn.addEventListener('click', () => selectOption(option, optionBtn));
                    optionsContainer.appendChild(optionBtn);
                });

                // Hide explanation and next button
                explanationDiv.style.display = 'none';
                nextButton.style.display = 'none';

                // Reset hint button
                hintButton.style.display = 'block';
                hintButton.textContent = 'Tampilkan Petunjuk';
                hintButton.disabled = false;
                hintButton.onclick = showHint;
            }

            function selectOption(option, buttonElement) {
                // If already selected an option or game is over, do nothing
                if (selectedOption !== null || isGameOver) return;

                selectedOption = option;
                const question = gameData[currentQuestionIndex];

                // Remove existing selection classes
                const optionButtons = optionsContainer.querySelectorAll('.option-btn');
                optionButtons.forEach(btn => {
                    btn.classList.remove('selected', 'correct', 'incorrect');
                });

                // Add selected class
                buttonElement.classList.add('selected');

                // Check if answer is correct
                const isCorrect = option === question.answer;

                setTimeout(() => {
                    // Update UI based on answer
                    if (isCorrect) {
                        buttonElement.classList.remove('selected');
                        buttonElement.classList.add('correct');
                        score += 10;
                        if (hintShown) score -= 2; // Reduce score if hint was shown
                        correctAnswers++;
                    } else {
                        buttonElement.classList.remove('selected');
                        buttonElement.classList.add('incorrect');

                        // Highlight correct answer
                        optionButtons.forEach(btn => {
                            if (btn.textContent === question.answer) {
                                btn.classList.add('correct');
                            }
                        });
                    }

                    // Update score and counts
                    scoreElement.textContent = score;
                    correctCountElement.textContent = correctAnswers;
                    remainingCountElement.textContent = gameData.length - (currentQuestionIndex + 1);

                    // Show explanation
                    correctAnswerSpan.textContent = question.answer;
                    explanationDiv.style.display = 'block';

                    // Show next button or end game
                    if (currentQuestionIndex < gameData.length - 1) {
                        nextButton.style.display = 'block';
                        nextButton.onclick = goToNextQuestion;
                    } else {
                        endGame();
                    }

                    // Hide hint button
                    hintButton.style.display = 'none';

                    // Update progress bar
                    updateProgressBar();
                }, 500);
            }

            function goToNextQuestion() {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            }

            function showHint() {
                hintShown = true;
                currentHint.parentElement.style.display = 'block';
                hintButton.style.display = 'none';
            }

            function endGame() {
                isGameOver = true;
                clearInterval(timer);

                // Save game data to server
                saveGameResult();

                // Update final stats
                finalScore.textContent = score;
                finalCorrect.textContent = correctAnswers;
                finalTime.textContent = formatTime(seconds);

                // Show game over container
                setTimeout(() => {
                    questionContainer.style.display = 'none';
                    gameOverContainer.style.display = 'block';
                    createConfetti();
                }, 1500);
            }

            function saveGameResult() {
                // Send score to server
                fetch('{{ route("permainan.complete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        game_slug: '{{ $gameData['slug'] }}',
                        score: score,
                        time_taken: seconds
                    })
                });
            }

            function startTimer() {
                timer = setInterval(() => {
                    seconds++;
                    timerElement.textContent = formatTime(seconds);
                }, 1000);
            }

            function formatTime(totalSeconds) {
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            function updateProgressBar() {
                const progress = ((currentQuestionIndex + 1) / gameData.length) * 100;
                progressBar.style.width = `${progress}%`;
            }

            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            function createConfetti() {
                const container = document.querySelector('.main-content');
                for (let i = 0; i < 50; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = `${Math.random() * 100}%`;
                    confetti.style.animationDuration = `${Math.random() * 3 + 2}s`;
                    confetti.style.animationDelay = `${Math.random() * 5}s`;
                    confetti.style.backgroundColor = getRandomColor();
                    container.appendChild(confetti);

                    // Remove confetti after animation
                    setTimeout(() => {
                        confetti.remove();
                    }, 8000);
                }
            }

            function getRandomColor() {
                const colors = ['#f2d74e', '#95d94c', '#f25252', '#5283f2', '#ce52f2', '#f2a852'];
                return colors[Math.floor(Math.random() * colors.length)];
            }
        });
    </script>
</body>
</html>
