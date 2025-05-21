<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $gameData['title'] }} - Permainan Edukatif</title>
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

        .game-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: #FF9500;
            color: #ffffff;
            margin-bottom: 0.5rem;
            text-align: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
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

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: 300px;
            background: linear-gradient(90deg, #FF9500, #FF5252);
            margin: 0 auto 2rem auto;
            border-radius: 2px;
        }

        .game-container {
            background: #ffffff;
            border-radius: 20px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .word-container {
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .scrambled-word {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: 5px;
            margin-bottom: 1rem;
            color: #FF9500;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 0.5rem;
            border-radius: 8px;
        }

        .hint {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px dashed #FF9500;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            color: #151b2e;
            text-align: center;
            max-width: 500px;
            font-weight: 600;
        }

        .user-input {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(0, 0, 0, 0.2);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 1.25rem;
            color: #151b2e;
            margin: 0 10px 10px 0;
            width: 300px;
            text-align: center;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .input-field:focus {
            border-color: #FF9500;
            outline: none;
            box-shadow: 0 0 10px rgba(255, 149, 0, 0.5);
            background: #ffffff;
        }

        .input-field::placeholder {
            color: #6b7280;
        }

        .submit-btn {
            background: #FF9500;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: #FF5252;
        }

        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .game-status {
            margin-top: 1.5rem;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            display: none;
        }

        .success {
            background-color: rgba(34, 197, 94, 0.8);
            color: #003a10;
            border: 1px solid rgba(16, 93, 44, 0.6);
        }

        .error {
            background-color: rgba(239, 68, 68, 0.8);
            color: #5a0000;
            border: 1px solid rgba(143, 41, 41, 0.6);
        }

        .game-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .control-btn {
            background: #4a5568;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .control-btn:hover {
            background: #2d3748;
        }

        .control-btn i {
            margin-right: 0.5rem;
        }

        .game-stats {
            background: #2d3748;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 0 1rem;
        }

        .stat-title {
            color: #003a10;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #151b2e;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        .stat-value.score {
            color: #FF9500;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .progress-container {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 8px;
            background: linear-gradient(90deg, #FF9500, #FF5252);
            width: 0;
            transition: width 0.5s ease;
        }

        .definition-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 1rem;
            margin-top: 1.5rem;
            text-align: center;
            color: #151b2e;
            display: none;
            font-weight: 500;
        }

        .back-button {
            background: #4a5568;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            margin-top: 2rem;
        }

        .back-button:hover {
            background: #2d3748;
        }

        .back-button i {
            margin-right: 0.5rem;
        }

        .game-completion {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            max-width: 600px;
            margin: 0 auto;
            color: white;
        }

        .game-completion h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: white;
            font-weight: bold;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .completion-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem;
            width: 120px;
            margin: 0.5rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0.25rem;
            color: #22C55E;
        }

        .stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .completion-message {
            margin-bottom: 2rem;
            font-size: 1.125rem;
            line-height: 1.6;
        }

        .completion-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .restart-btn, .view-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
        }

        .restart-btn {
            background: #4B5563;
            color: white;
        }

        .restart-btn:hover {
            background: #374151;
            transform: translateY(-2px);
        }

        .view-btn {
            background: #8B5CF6;
            color: white;
        }

        .view-btn:hover {
            background: #7C3AED;
            transform: translateY(-2px);
        }

        .text-green-400 {
            color: #22C55E;
        }

        /* Success animation */
        @keyframes success-pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .success-anim {
            animation: success-pulse 0.5s ease;
        }

        /* Confetti animation for completion */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            border-radius: 0;
            opacity: 0;
        }

        /* Completion Details Button */
        .completion-details-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background: #6366F1;
            color: white;
            border-radius: 30px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }

        .completion-details-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
            background: #4F46E5;
        }

        /* Modal styles */
        .completion-modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .completion-modal-content {
            background-color: #1F2937;
            border-radius: 10px;
            border: 1px solid #3B82F6;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            animation: modalFadeIn 0.4s;
        }

        @keyframes modalFadeIn {
            from {opacity: 0; transform: translateY(-30px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .completion-modal-header {
            padding: 15px;
            border-bottom: 1px solid #374151;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #111827;
            border-radius: 10px 10px 0 0;
        }

        .completion-modal-header h3 {
            color: white;
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .completion-modal-close {
            color: #9CA3AF;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .completion-modal-close:hover {
            color: white;
        }

        .completion-modal-body {
            padding: 20px;
            color: white;
        }

        .completion-detail-item {
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(55, 65, 81, 0.5);
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .completion-detail-label {
            font-weight: 600;
            color: #9CA3AF;
        }

        .completion-detail-value {
            font-weight: 700;
            color: white;
        }

        .completion-status {
            color: #10B981;
        }

        .completion-score {
            color: #3B82F6;
        }

        .completion-achievement {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 8px;
        }

        @media (max-width: 640px) {
            .game-title {
                font-size: 2rem;
            }

            .scrambled-word {
                font-size: 2rem;
                letter-spacing: 2px;
            }

            .input-field {
                width: 100%;
                margin: 0 0 10px 0;
            }

            .completion-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Style untuk tombol Tandai Selesai */
        .complete-btn {
            display: block;
            margin: 20px auto;
            padding: 12px 24px;
            background: #4A90E2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .complete-btn:hover {
            background: #3A7BD5;
            transform: translateY(-2px);
        }

        .complete-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
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
                        <div class="stat-title">Score</div>
                        <div class="stat-value score" id="score">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Correct Words</div>
                        <div class="stat-value" id="correct-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Remaining</div>
                        <div class="stat-value" id="remaining-count">{{ count($gameData['words']) }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Time</div>
                        <div class="stat-value" id="timer">00:00</div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>

                <div class="game-container" id="game-content">
                    <div class="word-container">
                        <div class="scrambled-word" id="scrambled-word"></div>
                        <div class="hint" id="hint"></div>
                    </div>

                    <div class="user-input">
                        <input type="text" id="user-answer" class="input-field" placeholder="Type your answer here" autocomplete="off">
                        <button id="submit-btn" class="submit-btn">Check Answer</button>
                    </div>

                    <div class="game-status" id="game-status"></div>
                    <div class="definition-container" id="definition-container"></div>

                    <div class="game-controls">
                        <button id="hint-btn" class="control-btn">
                            <i class="fas fa-lightbulb"></i> Show Hint
                        </button>
                        <button id="next-btn" class="control-btn">
                            <i class="fas fa-forward"></i> Next Word
                        </button>
                    </div>

                    <!-- Back to Games List button -->
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('permainan') }}" class="btn btn-secondary" style="max-width: 300px; width: 100%;">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Games List
                        </a>
                    </div>
                </div>

                <!-- Completion screen -->
                <div id="game-completion" class="game-completion" style="display: none;">
                    <h2>Game Completed!</h2>
                    <div class="completion-stats">
                        <div class="stat">
                            <div class="stat-label">Score:</div>
                            <div id="final-score" class="stat-value">0</div>
                        </div>
                        <div class="stat">
                            <div class="stat-label">Correct:</div>
                            <div id="final-correct" class="stat-value">0</div>
                        </div>
                        <div class="stat">
                            <div class="stat-label">Time:</div>
                            <div id="final-time" class="stat-value">00:00</div>
                        </div>
                    </div>
                    <div class="completion-message">
                        Congratulations! You have completed the Word Scramble game!<br>
                        <strong class="text-green-400">Press the "Mark Complete" button to save your progress</strong>
                    </div>
                    <div class="completion-buttons">
                        <button id="restart-btn" class="restart-btn">
                            <i class="fas fa-redo mr-2"></i> Play Again
                        </button>
                        <button id="view-completion-btn" class="view-btn">
                            <i class="fas fa-eye mr-2"></i> View Details
                        </button>
                    </div>

                    <!-- Mark Complete Button -->
                    <button id="complete-game-btn" class="complete-btn">
                        <i class="fas fa-check-circle mr-2"></i> Mark Complete
                    </button>
                </div>

                <!-- Completion Details Modal -->
                <div id="completion-modal" class="completion-modal">
                    <div class="completion-modal-content">
                        <div class="completion-modal-header">
                            <h3><i class="fas fa-trophy text-yellow-400 mr-2"></i> Game Completion Details</h3>
                            <span id="close-modal" class="completion-modal-close">&times;</span>
                        </div>
                        <div class="completion-modal-body">
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Status:</span>
                                <span class="completion-detail-value completion-status">Completed Perfectly</span>
                            </div>
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Final Score:</span>
                                <span class="completion-detail-value completion-score" id="modal-score">0</span>
                            </div>
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Completion Time:</span>
                                <span class="completion-detail-value" id="modal-time">00:00</span>
                            </div>
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Completed on:</span>
                                <span class="completion-detail-value" id="modal-date">{{ date('d M Y, H:i') }}</span>
                            </div>
                            <div class="completion-achievement">
                                <i class="fas fa-medal text-yellow-500 text-4xl"></i>
                                <p>Congratulations! You have completed this game!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Game data from PHP
            const words = @json($gameData['words']);

            // Game variables
            let currentWordIndex = 0;
            let correctCount = 0;
            let score = 0;
            let startTime = new Date();
            let timerInterval;
            let gameEnded = false;

            // DOM elements
            const scrambledWordEl = document.getElementById('scrambled-word');
            const hintEl = document.getElementById('hint');
            const userAnswerEl = document.getElementById('user-answer');
            const submitBtn = document.getElementById('submit-btn');
            const gameStatusEl = document.getElementById('game-status');
            const definitionEl = document.getElementById('definition-container');
            const scoreEl = document.getElementById('score');
            const correctCountEl = document.getElementById('correct-count');
            const remainingCountEl = document.getElementById('remaining-count');
            const timerEl = document.getElementById('timer');
            const progressBarEl = document.getElementById('progress-bar');
            const hintBtn = document.getElementById('hint-btn');
            const nextBtn = document.getElementById('next-btn');
            const gameContentEl = document.getElementById('game-content');
            const gameCompletionEl = document.getElementById('game-completion');
            const finalScoreEl = document.getElementById('final-score');
            const finalCorrectEl = document.getElementById('final-correct');
            const finalTimeEl = document.getElementById('final-time');
            const restartBtn = document.getElementById('restart-btn');

            // Start the game
            startGame();

            // Start the game
            function startGame() {
                // Initialize game
                currentWordIndex = 0;
                correctCount = 0;
                score = 0;
                gameEnded = false;

                // Update UI
                scoreEl.textContent = score;
                correctCountEl.textContent = correctCount;
                remainingCountEl.textContent = words.length;

                // Start timer
                startTime = new Date();
                timerInterval = setInterval(updateTimer, 1000);

                // Show first word
                showCurrentWord();

                // Reset game completion screen
                gameContentEl.style.display = 'block';
                gameCompletionEl.style.display = 'none';

                // Reset progress bar
                updateProgressBar();
            }

            // Shuffle a word
            function scrambleWord(word) {
                const wordArr = word.split('');
                let scrambled = '';

                // Keep shuffling until we get a different arrangement
                do {
                    for (let i = wordArr.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [wordArr[i], wordArr[j]] = [wordArr[j], wordArr[i]];
                    }
                    scrambled = wordArr.join('');
                } while (scrambled === word);

                return scrambled;
            }

            // Show current word
            function showCurrentWord() {
                if (currentWordIndex >= words.length) {
                    endGame();
                    return;
                }

                const currentWord = words[currentWordIndex];
                const scrambled = scrambleWord(currentWord.word);

                scrambledWordEl.textContent = scrambled;
                hintEl.textContent = currentWord.hint;
                userAnswerEl.value = '';
                userAnswerEl.focus();

                // Hide status, definition, and hint
                gameStatusEl.style.display = 'none';
                definitionEl.style.display = 'none';
                hintEl.style.display = 'none';

                // Update remaining count
                remainingCountEl.textContent = words.length - currentWordIndex;

                // Update progress bar
                updateProgressBar();
            }

            // Update timer display
            function updateTimer() {
                const currentTime = new Date();
                const elapsedTime = Math.floor((currentTime - startTime) / 1000);
                const minutes = Math.floor(elapsedTime / 60).toString().padStart(2, '0');
                const seconds = (elapsedTime % 60).toString().padStart(2, '0');

                timerEl.textContent = `${minutes}:${seconds}`;

                return `${minutes}:${seconds}`;
            }

            // Update progress bar
            function updateProgressBar() {
                const progress = (currentWordIndex / words.length) * 100;
                progressBarEl.style.width = `${progress}%`;
            }

            // Check user answer
            function checkAnswer() {
                const userAnswer = userAnswerEl.value.trim().toUpperCase();
                const correctAnswer = words[currentWordIndex].word;

                if (userAnswer === correctAnswer) {
                    // Correct answer
                    gameStatusEl.textContent = 'Correct! Your answer is correct.';
                    gameStatusEl.className = 'game-status success';
                    gameStatusEl.style.display = 'block';

                    // Show definition
                    definitionEl.textContent = words[currentWordIndex].definition;
                    definitionEl.style.display = 'block';

                    // Update score and counts
                    correctCount++;
                    score += 10;
                    scoreEl.textContent = score;
                    correctCountEl.textContent = correctCount;
                    scoreEl.classList.add('success-anim');

                    setTimeout(() => {
                        scoreEl.classList.remove('success-anim');
                    }, 500);

                    // Go to next word
                    currentWordIndex++;

                    // Disable input and submit button
                    userAnswerEl.disabled = true;
                    submitBtn.disabled = true;

                    // Show next button
                    nextBtn.style.display = 'block';

                    // If all words completed, end game
                    if (currentWordIndex >= words.length) {
                        setTimeout(endGame, 1500);
                    }
                } else {
                    // Wrong answer
                    gameStatusEl.textContent = 'Wrong! Try again.';
                    gameStatusEl.className = 'game-status error';
                    gameStatusEl.style.display = 'block';
                }
            }

            // End the game
            function endGame() {
                // Stop timer
                clearInterval(timerInterval);

                // Update final stats
                finalScoreEl.textContent = score;
                finalCorrectEl.textContent = correctCount;
                finalTimeEl.textContent = timerEl.textContent;

                // Show completion screen
                gameContentEl.style.display = 'none';
                gameCompletionEl.style.display = 'block';

                // Create confetti effect
                createConfetti();

                // Set game as ended
                gameEnded = true;
            }

            // Save game score to server
            function saveGameScore(finalScore, timeTaken) {
                // Convert time (MM:SS) to seconds
                const [minutes, seconds] = timeTaken.split(':').map(Number);
                const totalSeconds = minutes * 60 + seconds;

                fetch("{{ route('permainan.complete') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        game_slug: "{{ $gameData['slug'] }}",
                        score: finalScore,
                        time_taken: totalSeconds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Game completion saved:', data);

                    // Tambahkan notifikasi sukses dan redirect
                    alert('Permainan selesai! Data berhasil disimpan.');

                    // Redirect ke halaman permainan setelah delay singkat
                    setTimeout(() => {
                        window.location.href = "{{ route('permainan') }}";
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error saving game completion:', error);
                    alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
                });
            }

            // Create confetti animation
            function createConfetti() {
                const colors = ['#FF9500', '#FF5252', '#22C55E', '#3B82F6', '#9333EA'];
                const totalConfetti = 100;

                for (let i = 0; i < totalConfetti; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.top = -20 + 'px';
                    confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';

                    document.body.appendChild(confetti);

                    // Animate confetti
                    const animation = confetti.animate(
                        [
                            { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
                            { transform: 'translateY(' + (Math.random() * 500 + 500) + 'px) rotate(' + Math.random() * 360 + 'deg)', opacity: 0 }
                        ],
                        {
                            duration: Math.random() * 3000 + 2000,
                            easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                            fill: 'forwards'
                        }
                    );

                    animation.onfinish = () => {
                        confetti.remove();
                    };
                }
            }

            // Event listeners
            submitBtn.addEventListener('click', checkAnswer);

            userAnswerEl.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    checkAnswer();
                }
            });

            nextBtn.addEventListener('click', function() {
                showCurrentWord();
                userAnswerEl.disabled = false;
                submitBtn.disabled = false;
            });

            hintBtn.addEventListener('click', function() {
                hintEl.style.display = 'block';
            });

            restartBtn.addEventListener('click', startGame);

            // Event listener untuk tombol complete-game-btn
            document.getElementById('complete-game-btn').addEventListener('click', function() {
                // Simpan skor ke server
                saveGameScore(score, timerEl.textContent);

                // Update tampilan tombol
                this.innerHTML = '<i class="fas fa-check"></i> Berhasil Disimpan';
                this.style.backgroundColor = '#22C55E';
                this.disabled = true;
            });

            // Modal related elements and functionality
            const viewCompletionBtn = document.getElementById('view-completion-btn');
            const completionModal = document.getElementById('completion-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const modalScore = document.getElementById('modal-score');
            const modalTime = document.getElementById('modal-time');

            // Modal event listeners
            viewCompletionBtn.addEventListener('click', function() {
                // Populate modal with latest data
                modalScore.textContent = finalScoreEl.textContent;
                modalTime.textContent = finalTimeEl.textContent;

                // Show modal with flex display to center content
                completionModal.style.display = 'flex';

                // Add a light confetti effect when showing details
                setTimeout(() => {
                    createLightConfetti();
                }, 300);
            });

            closeModalBtn.addEventListener('click', function() {
                completionModal.style.display = 'none';
            });

            // Close modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target === completionModal) {
                    completionModal.style.display = 'none';
                }
            });

            // Create light confetti effect (fewer particles)
            function createLightConfetti() {
                const colors = ['#FF9500', '#FF5252', '#22C55E', '#3B82F6', '#9333EA'];
                const totalConfetti = 30; // Fewer particles for the modal

                for (let i = 0; i < totalConfetti; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.top = -20 + 'px';
                    confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';

                    document.body.appendChild(confetti);

                    // Animate confetti with shorter duration
                    const animation = confetti.animate(
                        [
                            { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
                            { transform: 'translateY(' + (Math.random() * 300 + 300) + 'px) rotate(' + Math.random() * 360 + 'deg)', opacity: 0 }
                        ],
                        {
                            duration: Math.random() * 2000 + 1000, // Shorter duration
                            easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                            fill: 'forwards'
                        }
                    );

                    animation.onfinish = () => {
                        confetti.remove();
                    };
                }
            }
        });
    </script>
</body>
</html>

