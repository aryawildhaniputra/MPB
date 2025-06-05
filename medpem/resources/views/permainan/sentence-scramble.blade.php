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
            background: #58CC02;
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
            background: linear-gradient(90deg, #58CC02, #16A34A);
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

        .word-container {
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .scrambled-sentence {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #FF9500;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 1rem;
            border-radius: 8px;
            line-height: 1.6;
        }

        .scrambled-word {
            display: inline-block;
            margin: 0.3rem;
            background-color: #2d3748;
            color: white;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .scrambled-word:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background-color: #3b4c69;
        }

        .hint {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px dashed #FF9500;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            color: #151b2e;
            text-align: center;
            max-width: 600px;
            font-weight: 600;
        }

        .user-input {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .sentence-area {
            min-height: 100px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            border: 2px dashed #FF9500;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .word-bank {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .word-bank-item {
            margin: 0.3rem;
            background-color: #2d3748;
            color: white;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .word-bank-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background-color: #3b4c69;
        }

        .sentence-word {
            display: inline-block;
            margin: 0.3rem;
            background-color: #FF9500;
            color: white;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(0, 0, 0, 0.2);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 1.25rem;
            color: #151b2e;
            margin: 0 10px 10px 0;
            width: 80%;
            text-align: center;
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
            margin-top: 15px;
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

        @media (max-width: 768px) {
            .game-stats {
                padding: 0.8rem;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .game-stats {
                padding: 0.6rem;
                margin-bottom: 1rem;
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        .stat-item {
            text-align: center;
            padding: 0 1rem;
        }

        @media (max-width: 768px) {
            .stat-item {
                padding: 0 0.5rem;
                flex: 1;
            }
        }

        @media (max-width: 480px) {
            .stat-item {
                padding: 0.2rem 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: left;
            }
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

        @media (max-width: 480px) {
            .stat-title {
                font-size: 0.8rem;
                margin-bottom: 0;
                margin-right: 0.5rem;
                flex: 1;
            }
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #151b2e;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .stat-value {
                font-size: 1.1rem;
                flex-shrink: 0;
            }
        }

        .stat-value.score {
            color: #58CC02;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .definition-box {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1.5rem;
            color: #151b2e;
            display: none;
        }

        .reset-btn {
            background: #4a5568;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .reset-btn:hover {
            background: #2d3748;
        }

        .timer-container {
            margin-bottom: 1rem;
            text-align: center;
        }

        .timer {
            font-size: 1.5rem;
            font-weight: bold;
            color: #FF9500;
        }

        /* Progress bar styles */
        .progress-container {
            background-color: rgba(255, 255, 255, 0.1);
            height: 8px;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, #FF9500, #FF5252);
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 4px;
        }

        /* Mobile responsiveness */
        @media (max-width: 640px) {
            .game-title {
                font-size: 1.5rem;
                padding: 0.25rem 0.5rem;
            }

            .game-description {
                font-size: 0.85rem;
            }

            .game-stats {
                padding: 0.5rem;
                margin-bottom: 0.75rem;
            }

            .stat-item {
                padding: 0.1rem 0;
            }

            .stat-title {
                font-size: 0.75rem;
                padding: 0.1rem 0.3rem;
            }

            .stat-value {
                font-size: 1rem;
                padding: 0.1rem 0.3rem;
            }

            .game-container {
                padding: 0.75rem;
                border-radius: 10px;
            }

            .scrambled-sentence {
                font-size: 1.2rem;
            }

            .input-field {
                width: 100%;
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }
        }

        /* Custom checkbox */
        .custom-checkbox {
            display: flex;
            align-items: center;
            margin-top: 1rem;
            cursor: pointer;
        }

        .custom-checkbox input {
            height: 0;
            width: 0;
            opacity: 0;
            position: absolute;
        }

        .checkmark {
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 5px;
            margin-right: 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .custom-checkbox:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .custom-checkbox input:checked ~ .checkmark {
            background-color: #FF9500;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked ~ .checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 9px;
            top: 5px;
            width: 7px;
            height: 12px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
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
                        <div class="stat-title">Correct</div>
                        <div class="stat-value" id="correct">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Remaining</div>
                        <div class="stat-value" id="remaining">{{ count($gameData['sentences']) }}</div>
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
                        <div class="hint" id="hint"></div>
                        <div class="scrambled-sentence" id="scrambled-sentence"></div>

                        <div class="user-input">
                            <div class="sentence-area" id="sentence-area"></div>
                            <div class="word-bank" id="word-bank"></div>
                            <button id="submit-btn" class="submit-btn" disabled>Check Answer</button>
                            <button id="reset-btn" class="reset-btn">Reset Sentence</button>
                        </div>

                        <div id="game-status" class="game-status"></div>
                        <div id="definition-box" class="definition-box"></div>
                    </div>

                    <div class="game-controls">
                        <button id="prev-btn" class="control-btn" disabled>
                            <i class="fas fa-chevron-left"></i> Previous
                        </button>
                        <button id="next-btn" class="control-btn" disabled>
                            Next <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Game data from Laravel
            const gameData = @json($gameData);

            // Game variables
            let currentSentenceIndex = 0;
            let score = 0;
            let correctAnswers = 0;
            let sentences = gameData.sentences;
            let startTime = new Date();
            let timerInterval;
            let selectedWords = [];

            // DOM elements
            const scoreEl = document.getElementById('score');
            const correctEl = document.getElementById('correct');
            const remainingEl = document.getElementById('remaining');
            const hintEl = document.getElementById('hint');
            const scrambledSentenceEl = document.getElementById('scrambled-sentence');
            const sentenceAreaEl = document.getElementById('sentence-area');
            const wordBankEl = document.getElementById('word-bank');
            const submitBtn = document.getElementById('submit-btn');
            const resetBtn = document.getElementById('reset-btn');
            const gameStatusEl = document.getElementById('game-status');
            const definitionBoxEl = document.getElementById('definition-box');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const timerEl = document.getElementById('timer');

            // Start the game
            initGame();

            // Initialize game
            function initGame() {
                updateStats();
                loadCurrentSentence();
                startTimer();

                // Event listeners
                submitBtn.addEventListener('click', checkAnswer);
                resetBtn.addEventListener('click', resetSentence);
                prevBtn.addEventListener('click', () => navigateSentence(-1));
                nextBtn.addEventListener('click', () => navigateSentence(1));
            }

            // Load current sentence
            function loadCurrentSentence() {
                if (currentSentenceIndex >= sentences.length) {
                    // Game completed
                    completeGame();
                    return;
                }

                const currentSentence = sentences[currentSentenceIndex];

                // Set hint
                hintEl.textContent = currentSentence.hint;

                // Reset UI elements
                gameStatusEl.style.display = 'none';
                definitionBoxEl.style.display = 'none';
                sentenceAreaEl.innerHTML = '';
                selectedWords = [];

                // Scramble the sentence
                const words = currentSentence.original.split(' ');
                const scrambledWords = [...words].sort(() => Math.random() - 0.5);

                // Display scrambled words in word bank
                wordBankEl.innerHTML = '';
                scrambledWords.forEach((word, index) => {
                    const wordEl = document.createElement('div');
                    wordEl.classList.add('word-bank-item');
                    wordEl.textContent = word;
                    wordEl.dataset.word = word;
                    wordEl.dataset.index = index;
                    wordEl.addEventListener('click', () => selectWord(wordEl));
                    wordBankEl.appendChild(wordEl);
                });

                // Update navigation buttons
                prevBtn.disabled = currentSentenceIndex === 0;
                nextBtn.disabled = true;
                submitBtn.disabled = selectedWords.length === 0;

                // Update remaining count
                remainingEl.textContent = sentences.length - currentSentenceIndex;
            }

            // Select a word from the word bank
            function selectWord(wordEl) {
                // Add to selected words
                const word = wordEl.dataset.word;
                selectedWords.push(word);

                // Create word element in sentence area
                const sentenceWordEl = document.createElement('div');
                sentenceWordEl.classList.add('sentence-word');
                sentenceWordEl.textContent = word;
                sentenceWordEl.dataset.word = word;
                sentenceWordEl.dataset.originalIndex = wordEl.dataset.index;
                sentenceWordEl.addEventListener('click', () => deselectWord(sentenceWordEl));
                sentenceAreaEl.appendChild(sentenceWordEl);

                // Remove from word bank
                wordEl.remove();

                // Enable submit if there are words
                submitBtn.disabled = false;
            }

            // Deselect a word and return to word bank
            function deselectWord(wordEl) {
                // Remove from selected words
                const word = wordEl.dataset.word;
                const index = selectedWords.indexOf(word);
                if (index > -1) {
                    selectedWords.splice(index, 1);
                }

                // Create word element in word bank
                const wordBankItemEl = document.createElement('div');
                wordBankItemEl.classList.add('word-bank-item');
                wordBankItemEl.textContent = word;
                wordBankItemEl.dataset.word = word;
                wordBankItemEl.dataset.index = wordEl.dataset.originalIndex;
                wordBankItemEl.addEventListener('click', () => selectWord(wordBankItemEl));
                wordBankEl.appendChild(wordBankItemEl);

                // Remove from sentence area
                wordEl.remove();

                // Disable submit if no words
                submitBtn.disabled = selectedWords.length === 0;
            }

            // Reset sentence
            function resetSentence() {
                loadCurrentSentence();
            }

            // Check answer
            function checkAnswer() {
                const currentSentence = sentences[currentSentenceIndex];
                const userAnswer = selectedWords.join(' ');
                const correctAnswer = currentSentence.original;

                if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
                    // Correct answer
                    gameStatusEl.textContent = 'Correct! 🎉';
                    gameStatusEl.className = 'game-status success';
                    definitionBoxEl.textContent = currentSentence.definition;

                    score += 10;
                    correctAnswers++;

                    // Enable next button
                    nextBtn.disabled = false;
                } else {
                    // Wrong answer
                    gameStatusEl.textContent = 'Wrong! Try again. ❌';
                    gameStatusEl.className = 'game-status error';
                }

                // Display status and definition
                gameStatusEl.style.display = 'block';
                definitionBoxEl.style.display = 'block';

                // Update stats
                updateStats();

                // Disable submit button
                submitBtn.disabled = true;
            }

            // Navigate to previous or next sentence
            function navigateSentence(direction) {
                currentSentenceIndex += direction;
                loadCurrentSentence();
            }

            // Update game stats
            function updateStats() {
                scoreEl.textContent = score;
                correctEl.textContent = correctAnswers;

                // Update progress bar
                const progressBar = document.getElementById('progress-bar');
                const progress = (currentSentenceIndex / sentences.length) * 100;
                progressBar.style.width = `${progress}%`;
            }

            // Start the timer
            function startTimer() {
                timerInterval = setInterval(updateTimer, 1000);
            }

            // Update the timer
            function updateTimer() {
                const now = new Date();
                const diff = Math.floor((now - startTime) / 1000);
                const minutes = Math.floor(diff / 60).toString().padStart(2, '0');
                const seconds = (diff % 60).toString().padStart(2, '0');
                timerEl.textContent = `${minutes}:${seconds}`;
            }

            // Complete the game and send score to server
            function completeGame() {
                clearInterval(timerInterval);

                // Calculate time spent
                const endTime = new Date();
                const timeSpent = Math.floor((endTime - startTime) / 1000);

                // Hide game content
                document.getElementById('game-content').innerHTML = `
                    <div class="success game-status" style="display: block; margin-bottom: 2rem;">
                        <h2 class="text-xl font-bold mb-2">Game Completed! 🎉</h2>
                        <p>You have completed all sentences!</p>
                        <p class="mt-2">Final Score: <span class="font-bold">${score}</span></p>
                        <p>Correct: <span class="font-bold">${correctAnswers}</span></p>
                        <p>Time: <span class="font-bold">${formatTime(timeSpent)}</span></p>
                    </div>
                    <div class="flex justify-center">
                        <a href="/permainan" class="control-btn">
                            <i class="fas fa-home"></i> Back to Game Menu
                        </a>
                        <a href="/permainan/answers/${gameData.slug}" class="control-btn ml-4">
                            <i class="fas fa-book"></i> View Answers
                        </a>
                    </div>
                `;

                // Hide navigation buttons
                document.querySelector('.game-controls').style.display = 'none';

                // Send score to server
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/permainan/complete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        game_slug: gameData.slug,
                        score: score,
                        time_spent: timeSpent,
                        correct_answers: correctAnswers
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Score saved:', data);
                })
                .catch(error => {
                    console.error('Error saving score:', error);
                });
            }

            // Format seconds to MM:SS
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60).toString().padStart(2, '0');
                const secs = (seconds % 60).toString().padStart(2, '0');
                return `${minutes}:${secs}`;
            }
        });
    </script>
</body>
</html>
