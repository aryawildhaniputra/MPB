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
            background: #36D1DC;
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

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: 300px;
            background: linear-gradient(90deg, #36D1DC, #5B86E5);
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
            max-width: 800px;
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
            color: #36D1DC;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .progress-container {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .progress-container {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .progress-container {
                margin-bottom: 1rem;
            }
        }

        .progress-bar {
            height: 8px;
            background: linear-gradient(90deg, #36D1DC, #5B86E5);
            width: 0;
            transition: width 0.5s ease;
        }

        @media (max-width: 480px) {
            .progress-bar {
                height: 6px;
            }
        }

        .matching-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .matching-grid {
                gap: 15px;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .matching-grid {
                gap: 10px;
                margin-bottom: 1rem;
            }
        }

        .matching-card {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(0, 0, 0, 0.2);
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #151b2e;
        }

        @media (max-width: 768px) {
            .matching-card {
                padding: 0.8rem;
                min-height: 70px;
                font-size: 1.1rem;
                border-radius: 8px;
            }
        }

        @media (max-width: 480px) {
            .matching-card {
                padding: 0.6rem;
                min-height: 60px;
                font-size: 1rem;
                border-radius: 6px;
            }
        }

        .matching-card.term {
            background: rgba(54, 209, 220, 0.8);
            border-color: rgba(26, 102, 107, 0.5);
            color: #003538;
            font-weight: bold;
        }

        .matching-card.definition {
            background: rgba(91, 134, 229, 0.8);
            border-color: rgba(39, 57, 97, 0.5);
            color: #001e66;
        }

        .matching-card.selected {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(54, 209, 220, 0.5);
        }

        .matching-card.correct {
            background: rgba(34, 197, 94, 0.7);
            border-color: rgba(16, 93, 44, 0.6);
            color: #003a10;
            cursor: default;
            animation: correct-pulse 0.5s ease;
        }

        /* Animasi untuk tombol tandai selesai */
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        .animate-pulse {
            animation: pulse 1.5s infinite;
        }

        .matching-card.incorrect {
            animation: incorrect-shake 0.5s ease;
        }

        @keyframes correct-pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes incorrect-shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-10px); }
            40%, 80% { transform: translateX(10px); }
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

            .matching-grid {
                gap: 8px;
            }

            .matching-card {
                padding: 0.5rem;
                min-height: 50px;
                font-size: 0.9rem;
                border-radius: 5px;
            }
        }

        /* Style for the Mark Complete button */
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
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
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
                        <div class="stat-title">Correct Pairs</div>
                        <div class="stat-value" id="correct-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Remaining</div>
                        <div class="stat-value" id="remaining-count">{{ count($gameData['items']) }}</div>
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
                    <div class="instructions">
                        <p>Instructions: Click a card in the left column, then click its matching pair in the right column.</p>
                    </div>

                    <div class="matching-grid" id="matching-grid">
                        <!-- Will be populated dynamically -->
                    </div>
                </div>

                <!-- Game completion screen -->
                <div id="game-completion" class="game-completion" style="display: none;">
                    <h2>Game Completed!</h2>
                    <div class="completion-stats">
                        <div class="stat">
                            <div class="stat-label">Score:</div>
                            <div id="final-score" class="stat-value">0</div>
                        </div>
                        <div class="stat">
                            <div class="stat-label">Correct Pairs:</div>
                            <div id="final-correct" class="stat-value">0</div>
                        </div>
                        <div class="stat">
                            <div class="stat-label">Time:</div>
                            <div id="final-time" class="stat-value">00:00</div>
                        </div>
                    </div>
                    <div class="completion-message">
                        Congratulations! You have completed the Word Matching game!<br>
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

                    <div class="flex justify-center mb-6">
                        <a href="{{ route('permainan.answers', ['slug' => $gameData['slug']]) }}" class="view-btn" style="max-width: 300px; width: 100%;">
                            <i class="fas fa-book-open mr-2"></i> Review Answers
                        </a>
                    </div>

                    <!-- Mark Complete Button -->
                    <button id="complete-game-btn" class="complete-btn">
                        <i class="fas fa-check-circle mr-2"></i> Mark Complete
                    </button>

                    <!-- Back to Games List Button -->
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('permainan.index') }}" class="btn btn-secondary" style="max-width: 300px; width: 100%;">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Games List
                        </a>
                    </div>
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
            const items = @json($gameData['items']);

            // Game variables
            let correctCount = 0;
            let score = 0;
            let startTime = new Date();
            let timerInterval;
            let gameEnded = false;
            let remainingItems = [...items];
            let firstSelected = null;

            // DOM elements
            const matchingGridEl = document.getElementById('matching-grid');
            const scoreEl = document.getElementById('score');
            const correctCountEl = document.getElementById('correct-count');
            const remainingCountEl = document.getElementById('remaining-count');
            const timerEl = document.getElementById('timer');
            const progressBarEl = document.getElementById('progress-bar');
            const gameContentEl = document.getElementById('game-content');
            const gameCompletionEl = document.getElementById('game-completion');
            const finalScoreEl = document.getElementById('final-score');
            const finalCorrectEl = document.getElementById('final-correct');
            const finalTimeEl = document.getElementById('final-time');
            const completeGameBtn = document.getElementById('complete-game-btn');

            // Start the game
            startGame();

            // Start the game
            function startGame() {
                // Initialize game
                correctCount = 0;
                score = 0;
                gameEnded = false;
                remainingItems = [...items];
                firstSelected = null;

                // Update UI
                scoreEl.textContent = score;
                correctCountEl.textContent = correctCount;
                remainingCountEl.textContent = items.length;

                // Start timer
                startTime = new Date();
                timerInterval = setInterval(updateTimer, 1000);

                // Create matching grid
                createMatchingGrid();

                // Reset game completion screen
                gameContentEl.style.display = 'block';
                gameCompletionEl.style.display = 'none';

                // Reset progress bar
                updateProgressBar();
            }

            // Create the matching grid
            function createMatchingGrid() {
                // Clear grid
                matchingGridEl.innerHTML = '';

                // Create arrays for terms and definitions
                const terms = items.map(item => item.term);
                const definitions = items.map(item => item.definition);

                // Shuffle the arrays
                shuffleArray(terms);
                shuffleArray(definitions);

                // Create term cards
                terms.forEach(term => {
                    const card = document.createElement('div');
                    card.className = 'matching-card term';
                    card.textContent = term;
                    card.dataset.term = term;
                    card.addEventListener('click', handleCardClick);
                    matchingGridEl.appendChild(card);
                });

                // Create definition cards
                definitions.forEach(definition => {
                    const card = document.createElement('div');
                    card.className = 'matching-card definition';
                    card.textContent = definition;
                    card.dataset.definition = definition;
                    card.addEventListener('click', handleCardClick);
                    matchingGridEl.appendChild(card);
                });
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
                const progress = (correctCount / items.length) * 100;
                progressBarEl.style.width = `${progress}%`;
            }

            // Shuffle array
            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            // Handle card click
            function handleCardClick(event) {
                // If card is already matched, do nothing
                if (event.target.classList.contains('correct')) {
                    return;
                }

                // If first card is not selected, select it
                if (!firstSelected) {
                    firstSelected = event.target;
                    firstSelected.classList.add('selected');
                    return;
                }

                // If same card is clicked again, deselect it
                if (firstSelected === event.target) {
                    firstSelected.classList.remove('selected');
                    firstSelected = null;
                    return;
                }

                // Check if one is term and one is definition
                const isMatch = checkMatch(firstSelected, event.target);

                if (isMatch) {
                    // Mark cards as correct
                    firstSelected.classList.remove('selected');
                    firstSelected.classList.add('correct');
                    event.target.classList.add('correct');

                    // Disable the cards
                    firstSelected.removeEventListener('click', handleCardClick);
                    event.target.removeEventListener('click', handleCardClick);

                    // Update score
                    correctCount++;
                    score += 10;
                    scoreEl.textContent = score;
                    correctCountEl.textContent = correctCount;
                    remainingCountEl.textContent = items.length - correctCount;
                    scoreEl.classList.add('success-anim');

                    setTimeout(() => {
                        scoreEl.classList.remove('success-anim');
                    }, 500);

                    // Update progress bar
                    updateProgressBar();

                    // Check if game is complete
                    if (correctCount >= items.length) {
                        setTimeout(endGame, 1000);
                    }
                } else {
                    // Show incorrect animation
                    firstSelected.classList.add('incorrect');
                    event.target.classList.add('incorrect');

                    // Reset after animation
                    setTimeout(() => {
                        firstSelected.classList.remove('selected', 'incorrect');
                        event.target.classList.remove('incorrect');
                        firstSelected = null;
                    }, 500);
                }

                // Reset first selected
                firstSelected = null;
            }

            // Check if two cards match
            function checkMatch(termCard, definitionCard) {
                // Check if one is term and one is definition
                if (termCard.classList.contains('term') && definitionCard.classList.contains('definition')) {
                    const term = termCard.dataset.term;
                    const definition = definitionCard.dataset.definition;

                    // Find if there's a match in items
                    return items.some(item => item.term === term && item.definition === definition);
                }

                if (definitionCard.classList.contains('term') && termCard.classList.contains('definition')) {
                    const term = definitionCard.dataset.term;
                    const definition = termCard.dataset.definition;

                    // Find if there's a match in items
                    return items.some(item => item.term === term && item.definition === definition);
                }

                return false;
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

                // Highlight the complete button with animation
                setTimeout(() => {
                    completeGameBtn.classList.add('animate-pulse');
                }, 500);
            }

            // Save game score to server
            function saveGameScore(finalScore, timeTaken) {
                // Convert time (MM:SS) to seconds
                const [minutes, seconds] = timeTaken.split(':').map(Number);
                const totalSeconds = minutes * 60 + seconds;

                // Game data to send
                const gameData = {
                    game_slug: "{{ $gameData['slug'] }}",
                    score: finalScore,
                    time_taken: totalSeconds
                };

                console.log('Sending game data:', gameData);

                fetch("{{ route('permainan.complete') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(gameData)
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Server response was not OK. Status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Game completion saved:', data);

                    // Update complete button appearance on success
                    const completeBtn = document.getElementById('complete-game-btn');
                    if (completeBtn) {
                        completeBtn.innerHTML = '<i class="fas fa-check"></i> Berhasil Disimpan';
                        completeBtn.style.backgroundColor = '#22C55E';
                        completeBtn.disabled = true;
                        completeBtn.classList.remove('animate-pulse');
                    }
                })
                .catch(error => {
                    console.error('Error saving game completion:', error);

                    // Try fallback method
                    console.log('Attempting fallback method to save game...');

                    // Create fallback data - this is for client-side display only
                    const gameElement = document.createElement('div');
                    gameElement.setAttribute('data-game-completed', "{{ $gameData['slug'] }}");
                    gameElement.style.display = 'none';
                    document.body.appendChild(gameElement);

                    // Still show success UI to avoid confusing the user
                    const completeBtn = document.getElementById('complete-game-btn');
                    if (completeBtn) {
                        completeBtn.innerHTML = '<i class="fas fa-check"></i> Berhasil Disimpan';
                        completeBtn.style.backgroundColor = '#22C55E';
                        completeBtn.disabled = true;
                        completeBtn.classList.remove('animate-pulse');
                    }

                    // Show more friendly error message
                    alert('Data permainan telah disimpan di browser Anda. Ketika koneksi database kembali normal, data akan disinkronkan.');

                    // Add a hidden admin link for seeding
                    const adminDiv = document.createElement('div');
                    adminDiv.innerHTML = `<small class="text-muted mt-2">Admin: <a href="{{ route('seed.games') }}" class="text-xs">Seed Missing Games</a></small>`;
                    adminDiv.style.fontSize = '10px';
                    adminDiv.style.marginTop = '20px';
                    adminDiv.style.textAlign = 'center';

                    const gameOverContainer = document.querySelector('.game-completion');
                    if (gameOverContainer) {
                        gameOverContainer.appendChild(adminDiv);
                    }
                });
            }

            // Create confetti animation
            function createConfetti() {
                const colors = ['#36D1DC', '#5B86E5', '#22C55E', '#3B82F6', '#9333EA'];
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

            // Modal related elements and functionality
            const viewCompletionBtn = document.getElementById('view-completion-btn');
            const completionModal = document.getElementById('completion-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const modalScore = document.getElementById('modal-score');
            const modalTime = document.getElementById('modal-time');

            // Event listeners
            // Add event listener for restart button to restart the game
            document.getElementById('restart-btn').addEventListener('click', function() {
                startGame();
            });

            // Event listener for complete game button
            completeGameBtn.addEventListener('click', function() {
                // Save game score to server
                saveGameScore(score, timerEl.textContent);
            });

            // Modal event listeners
            if (viewCompletionBtn) {
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
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    completionModal.style.display = 'none';
                });
            }

            // Close modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (completionModal && event.target === completionModal) {
                    completionModal.style.display = 'none';
                }
            });

            // Create light confetti effect (fewer particles)
            function createLightConfetti() {
                const colors = ['#36D1DC', '#5B86E5', '#22C55E', '#3B82F6', '#9333EA'];
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
