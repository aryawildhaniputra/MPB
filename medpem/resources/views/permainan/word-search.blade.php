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
            background: #9D50BB;
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
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            margin: 0 auto 2rem auto;
            border-radius: 2px;
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
            color: #ffffff;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        .stat-value.score {
            color: #ffffff;
            background-color: rgba(157, 80, 187, 0.5);
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
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            width: 0;
            transition: width 0.5s ease;
        }

        .game-area {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            width: 100%;
        }

        @media (min-width: 768px) {
            .game-area {
                flex-direction: row;
                align-items: flex-start;
            }
        }

        .word-grid {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            padding: 1rem;
            display: grid;
            gap: 2px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .word-cell {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            aspect-ratio: 1 / 1;
            cursor: pointer;
            user-select: none;
            transition: all 0.1s ease;
            color: #151b2e;
        }

        .word-cell:hover {
            background: #f0f0f0;
            transform: scale(1.05);
            z-index: 1;
        }

        .word-cell.selected {
            background: rgba(157, 80, 187, 0.8);
            color: #ffffff;
            font-weight: bold;
            border-color: rgba(157, 80, 187, 1);
        }

        .word-cell.correct {
            background: rgba(34, 197, 94, 0.8);
            color: #ffffff;
            border-color: rgba(34, 197, 94, 1);
        }

        .word-cell.hint-active {
            background: rgba(245, 158, 11, 0.8);
            color: #ffffff;
            border-color: rgba(245, 158, 11, 1);
            animation: pulse 1.5s infinite;
        }

        .word-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            min-width: 200px;
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .word-list {
                max-height: 500px;
                overflow-y: auto;
            }
        }

        .word-item {
            background: #ffffff;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            color: #151b2e;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .word-text {
            flex-grow: 1;
            text-align: center;
        }

        .word-status {
            margin-left: 8px;
        }

        .word-status.hidden {
            display: none;
        }

        .word-item.found {
            background: rgba(34, 197, 94, 0.2);
            color: #151b2e;
            border-color: rgba(34, 197, 94, 0.6);
            position: relative;
        }

        .word-item.found .word-text {
            text-decoration: line-through;
            color: rgba(21, 27, 46, 0.6);
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
            background: rgba(34, 197, 94, 0.1);
            border: 2px solid rgba(34, 197, 94, 0.3);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            margin-top: 2rem;
            display: none;
        }

        .completion-title {
            font-size: 2rem;
            font-weight: bold;
            color: #22C55E;
            margin-bottom: 1rem;
        }

        .completion-message {
            font-size: 1.1rem;
            color: #003a10;
            margin-bottom: 1.5rem;
        }

        .completion-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .completion-stat {
            text-align: center;
        }

        .completion-stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #000000;
            margin-bottom: 0.5rem;
        }

        .completion-stat-label {
            color: #003a10;
            font-size: 0.9rem;
            font-weight: 500;
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

        .next-button {
            background: linear-gradient(135deg, #22C55E, #16A34A);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(34, 197, 94, 0.3);
        }

        .next-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(34, 197, 94, 0.4);
        }

        .instructions {
            background: #2d3748;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem;
            margin-bottom: 2rem;
            color: #ffffff;
            text-align: center;
            font-weight: 500;
        }

        .hint-button {
            background: #f59e0b;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            display: block;
            width: 100%;
            text-align: center;
        }

        .hint-button:hover {
            background: #d97706;
        }

        .hint-active {
            background: #22c55e;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Success animation */
        @keyframes success-pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .success-anim {
            animation: scorePopup 0.5s ease;
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

        @keyframes scorePopup {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
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

        /* Style untuk tombol Tandai Selesai */
        .complete-btn {
            display: block;
            margin: 20px auto;
            padding: 12px 24px;
            background: #9D50BB;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .complete-btn:hover {
            background: #6E48AA;
            transform: translateY(-2px);
        }

        .complete-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Buttons in completion screen */
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

        @media (max-width: 640px) {
            .game-title {
                font-size: 2rem;
            }

            .completion-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .word-cell {
                font-size: 1rem;
            }
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
                        <div class="stat-title">Kata Ditemukan</div>
                        <div class="stat-value" id="found-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Kata Tersisa</div>
                        <div class="stat-value" id="remaining-count">{{ count($gameData['words']) }}</div>
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
                    <div class="instructions mb-6 p-4 bg-gray-800 text-white rounded-lg">
                        <p class="text-center font-semibold"><i class="fas fa-info-circle mr-2"></i> Petunjuk: Temukan semua kata dengan meng-klik dan men-drag huruf dari awal hingga akhir kata. Kata hanya terdapat secara horizontal (kiri ke kanan) dan vertikal (atas ke bawah). Gunakan tombol Bantuan jika kamu kesulitan.</p>
                    </div>

                    <div class="game-area">
                        <div class="word-grid" id="word-grid">
                            <!-- Will be populated dynamically -->
                        </div>
                        <div class="word-list" id="word-list">
                            <h3 class="font-bold text-xl mb-4 text-center text-gray-800">Kata yang Dicari:</h3>
                            <!-- Will be populated dynamically -->
                            <button id="hint-button" class="hint-button mt-4">
                                <i class="fas fa-lightbulb"></i> Bantuan
                            </button>
                        </div>
                    </div>

                    <div class="control-buttons">
                        <button id="hint-btn" class="btn btn-secondary">
                            <i class="fas fa-lightbulb mr-2"></i> Tampilkan Petunjuk
                        </button>
                    </div>

                    <!-- Tombol Kembali ke Daftar Permainan -->
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('permainan') }}" class="btn btn-secondary" style="max-width: 300px; width: 100%;">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Permainan
                        </a>
                    </div>
                </div>

                <div class="game-completion" id="game-completion">
                    <h2 class="completion-title">Selamat! Permainan Selesai!</h2>
                    <p class="completion-message">Kamu berhasil menemukan semua kata tersembunyi.</p>

                    <div class="completion-stats">
                        <div class="completion-stat">
                            <div class="completion-stat-value" id="final-score">0</div>
                            <div class="completion-stat-label">Skor Total</div>
                        </div>
                        <div class="completion-stat">
                            <div class="completion-stat-value" id="final-found">0</div>
                            <div class="completion-stat-label">Kata Ditemukan</div>
                        </div>
                        <div class="completion-stat">
                            <div class="completion-stat-value" id="final-time">00:00</div>
                            <div class="completion-stat-label">Waktu</div>
                        </div>
                    </div>

                    <div class="completion-buttons">
                        <button id="restart-btn" class="restart-btn">
                            <i class="fas fa-redo mr-2"></i> Main Lagi
                        </button>
                        <button id="view-completion-btn" class="view-btn">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </button>
                    </div>

                    <div class="flex justify-center mb-6">
                        <a href="{{ route('permainan.answers', ['slug' => $gameData['slug']]) }}" class="next-button" style="background: linear-gradient(135deg, #3B82F6, #1D4ED8); max-width: 300px; width: 100%;">
                            <i class="fas fa-book-open mr-2"></i> Review Jawaban
                        </a>
                    </div>

                    <div class="flex justify-center">
                        <a href="{{ route('permainan') }}" class="back-button">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Permainan
                        </a>
                    </div>

                    <!-- Tombol Tandai Selesai -->
                    <button id="complete-game-btn" class="complete-btn">
                        <i class="fas fa-check-circle mr-2"></i> Tandai Selesai
                    </button>
                </div>

                <!-- Completion Details Modal -->
                <div id="completion-modal" class="completion-modal">
                    <div class="completion-modal-content">
                        <div class="completion-modal-header">
                            <h3><i class="fas fa-trophy text-yellow-400 mr-2"></i> Detail Penyelesaian Permainan</h3>
                            <span id="close-modal" class="completion-modal-close">&times;</span>
                        </div>
                        <div class="completion-modal-body">
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Status:</span>
                                <span class="completion-detail-value completion-status">Selesai dengan Sempurna</span>
                            </div>
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Skor Akhir:</span>
                                <span class="completion-detail-value completion-score" id="modal-score">0</span>
                            </div>
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Waktu Penyelesaian:</span>
                                <span class="completion-detail-value" id="modal-time">00:00</span>
                            </div>
                            <div class="completion-detail-item">
                                <span class="completion-detail-label">Diselesaikan pada:</span>
                                <span class="completion-detail-value" id="modal-date">{{ date('d M Y, H:i') }}</span>
                            </div>
                            <div class="completion-achievement">
                                <i class="fas fa-medal text-yellow-500 text-4xl"></i>
                                <p>Selamat! Anda telah menyelesaikan permainan ini!</p>
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
            const gridSize = {{ $gameData['grid_size'] }};

            // Game variables
            let foundWords = [];
            let score = 0;
            let startTime = new Date();
            let timerInterval;
            let gameEnded = false;
            let selectedCells = [];
            let dragActive = false;
            let hintActive = false;
            let hintCells = [];

            // DOM elements
            const wordGridEl = document.getElementById('word-grid');
            const wordListEl = document.getElementById('word-list');
            const scoreEl = document.getElementById('score');
            const foundCountEl = document.getElementById('found-count');
            const remainingCountEl = document.getElementById('remaining-count');
            const timerEl = document.getElementById('timer');
            const progressBarEl = document.getElementById('progress-bar');
            const gameContentEl = document.getElementById('game-content');
            const gameCompletionEl = document.getElementById('game-completion');
            const finalScoreEl = document.getElementById('final-score');
            const finalFoundEl = document.getElementById('final-found');
            const finalTimeEl = document.getElementById('final-time');
            const hintBtn = document.getElementById('hint-button');
            const restartBtn = document.getElementById('restart-btn');

            // Direction vectors
            const directions = [
                [0, 1],   // right
                [1, 0]    // down
            ];

            // Start the game
            startGame();

            // Start the game
            function startGame() {
                // Initialize game
                foundWords = [];
                score = 0;
                gameEnded = false;
                selectedCells = [];
                hintActive = false;
                hintCells = [];

                // Update UI
                scoreEl.textContent = score;
                foundCountEl.textContent = foundWords.length;
                remainingCountEl.textContent = words.length;
                hintBtn.classList.remove('hint-active');

                // Start timer
                startTime = new Date();
                timerInterval = setInterval(updateTimer, 1000);

                // Create word grid and list
                createWordGrid();
                createWordList();

                // Reset game completion screen
                gameContentEl.style.display = 'block';
                gameCompletionEl.style.display = 'none';

                // Reset progress bar
                updateProgressBar();
            }

            // Create word grid
            function createWordGrid() {
                // Create grid with random letters
                const grid = Array(gridSize).fill(0).map(() => Array(gridSize).fill(''));
                const wordPositions = {};

                // Place words in random directions
                for (const word of words) {
                    let placed = false;
                    let attempts = 0;

                    while (!placed && attempts < 100) {
                        attempts++;

                        // Choose random direction
                        const dirIndex = Math.floor(Math.random() * directions.length);
                        const [dx, dy] = directions[dirIndex];

                        // Choose random starting position
                        const startRow = Math.floor(Math.random() * gridSize);
                        const startCol = Math.floor(Math.random() * gridSize);

                        // Check if word fits
                        const wordLength = word.length;
                        const endRow = startRow + dx * (wordLength - 1);
                        const endCol = startCol + dy * (wordLength - 1);

                        if (endRow >= 0 && endRow < gridSize && endCol >= 0 && endCol < gridSize) {
                            // Check if cells are empty or match letters
                            let canPlace = true;
                            for (let i = 0; i < wordLength; i++) {
                                const row = startRow + dx * i;
                                const col = startCol + dy * i;

                                if (grid[row][col] !== '' && grid[row][col] !== word[i]) {
                                    canPlace = false;
                                    break;
                                }
                            }

                            if (canPlace) {
                                // Place word in grid and store positions
                                const positions = [];
                                for (let i = 0; i < wordLength; i++) {
                                    const row = startRow + dx * i;
                                    const col = startCol + dy * i;
                                    grid[row][col] = word[i];
                                    positions.push({row, col});
                                }
                                wordPositions[word] = positions;
                                placed = true;
                            }
                        }
                    }

                    // If couldn't place after 100 attempts, just proceed to next word
                    if (!placed) {
                        console.warn(`Couldn't place word: ${word}`);
                    }
                }

                // Fill remaining cells with random letters
                const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                for (let row = 0; row < gridSize; row++) {
                    for (let col = 0; col < gridSize; col++) {
                        if (grid[row][col] === '') {
                            grid[row][col] = letters.charAt(Math.floor(Math.random() * letters.length));
                        }
                    }
                }

                // Clear grid element
                wordGridEl.innerHTML = '';

                // Set grid columns
                wordGridEl.style.gridTemplateColumns = `repeat(${gridSize}, 1fr)`;

                // Create cells
                for (let row = 0; row < gridSize; row++) {
                    for (let col = 0; col < gridSize; col++) {
                        const cell = document.createElement('div');
                        cell.className = 'word-cell';
                        cell.textContent = grid[row][col];
                        cell.dataset.row = row;
                        cell.dataset.col = col;

                        // Add mouse events
                        cell.addEventListener('mousedown', startSelection);
                        cell.addEventListener('mouseover', continueSelection);

                        // Add touch events for mobile
                        cell.addEventListener('touchstart', handleTouchStart, { passive: false });
                        cell.addEventListener('touchmove', handleTouchMove, { passive: false });
                        cell.addEventListener('touchend', handleTouchEnd);

                        wordGridEl.appendChild(cell);
                    }
                }

                // Add mouseup event to document
                document.addEventListener('mouseup', endSelection);
                document.addEventListener('touchend', handleTouchEnd);
            }

            // Create word list
            function createWordList() {
                // Clear list element
                wordListEl.innerHTML = '';

                // Add title for the word list
                const listTitle = document.createElement('h3');
                listTitle.className = 'font-bold text-xl mb-4 text-center text-gray-800';
                listTitle.textContent = 'Kata yang Dicari:';
                wordListEl.appendChild(listTitle);

                // Add words to list
                for (const word of words) {
                    const item = document.createElement('div');
                    item.className = 'word-item';
                    item.dataset.word = word;

                    // Create a span for better styling control
                    const wordSpan = document.createElement('span');
                    wordSpan.textContent = word;
                    wordSpan.className = 'word-text';

                    // Add icon container
                    const iconContainer = document.createElement('span');
                    iconContainer.className = 'word-status hidden';
                    iconContainer.innerHTML = '<i class="fas fa-check-circle text-green-500"></i>';

                    // Append elements
                    item.appendChild(wordSpan);
                    item.appendChild(iconContainer);

                    wordListEl.appendChild(item);
                }
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
                const progress = (foundWords.length / words.length) * 100;
                progressBarEl.style.width = `${progress}%`;
            }

            // Start selection
            function startSelection(event) {
                if (gameEnded) return;

                dragActive = true;
                selectedCells = [event.target];
                event.target.classList.add('selected');
            }

            // Continue selection
            function continueSelection(event) {
                if (!dragActive || gameEnded) return;

                const cell = event.target;
                const lastCell = selectedCells[selectedCells.length - 1];

                // Check if cell is already selected
                if (selectedCells.includes(cell)) {
                    // If we went back to the second-to-last cell, remove the last cell
                    if (selectedCells.length > 1 && cell === selectedCells[selectedCells.length - 2]) {
                        const removedCell = selectedCells.pop();
                        removedCell.classList.remove('selected');
                    }
                    return;
                }

                // Check if cells are adjacent
                const row = parseInt(cell.dataset.row);
                const col = parseInt(cell.dataset.col);
                const lastRow = parseInt(lastCell.dataset.row);
                const lastCol = parseInt(lastCell.dataset.col);

                const rowDiff = Math.abs(row - lastRow);
                const colDiff = Math.abs(col - lastCol);

                if (rowDiff <= 1 && colDiff <= 1) {
                    // Cells are adjacent, add to selection
                    selectedCells.push(cell);
                    cell.classList.add('selected');
                }
            }

            // End selection
            function endSelection() {
                if (!dragActive || gameEnded) return;

                dragActive = false;

                // Get word from selected cells
                const word = selectedCells.map(cell => cell.textContent).join('');

                // Check if word is in the list and not already found
                if (words.includes(word) && !foundWords.includes(word)) {
                    // Word found!
                    foundWords.push(word);

                    // Update UI
                    selectedCells.forEach(cell => {
                        cell.classList.remove('selected');
                        cell.classList.add('correct');
                    });

                    // Mark word as found in the list
                    const wordItem = wordListEl.querySelector(`[data-word="${word}"]`);
                    if (wordItem) {
                        wordItem.classList.add('found');
                        const statusIcon = wordItem.querySelector('.word-status');
                        if (statusIcon) {
                            statusIcon.classList.remove('hidden');
                        }
                    }

                    // Update score
                    score += 15;
                    scoreEl.textContent = score;
                    foundCountEl.textContent = foundWords.length;
                    remainingCountEl.textContent = words.length - foundWords.length;
                    scoreEl.classList.add('success-anim');

                    setTimeout(() => {
                        scoreEl.classList.remove('success-anim');
                    }, 500);

                    // Update progress
                    updateProgressBar();

                    // Check if game is complete
                    if (foundWords.length === words.length) {
                        setTimeout(endGame, 1000);
                    }
                } else {
                    // Word not found, clear selection
                    selectedCells.forEach(cell => {
                        cell.classList.remove('selected');
                    });
                }

                selectedCells = [];
            }

            // End the game
            function endGame() {
                // Stop timer
                clearInterval(timerInterval);

                // Update final stats
                finalScoreEl.textContent = score;
                finalFoundEl.textContent = foundWords.length;
                finalTimeEl.textContent = timerEl.textContent;

                // Show completion screen
                gameContentEl.style.display = 'none';
                gameCompletionEl.style.display = 'block';

                // Create confetti effect
                createConfetti();

                // Set game as ended
                gameEnded = true;

                // Tampilkan pesan untuk menekan tombol Tandai Selesai
                const completionMessage = document.querySelector('.completion-message');
                completionMessage.innerHTML = 'Kamu berhasil menemukan semua kata tersembunyi!<br><strong class="text-green-400">Tekan tombol "Tandai Selesai" untuk menyimpan progresmu</strong>';

                // Highlight the complete button
                setTimeout(() => {
                    const completeBtn = document.getElementById('complete-game-btn');
                    completeBtn.classList.add('animate-pulse');
                }, 500);
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
                })
                .catch(error => {
                    console.error('Error saving game completion:', error);
                });
            }

            // Create confetti animation
            function createConfetti() {
                const colors = ['#9D50BB', '#6E48AA', '#22C55E', '#3B82F6', '#9333EA'];
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

            // Touch event handling
            let touchStartedCell = null;
            let lastTouchCell = null;

            function handleTouchStart(event) {
                event.preventDefault();
                if (gameEnded) return;

                touchStartedCell = event.target;
                startSelection({ target: touchStartedCell });
            }

            function handleTouchMove(event) {
                event.preventDefault();
                if (!dragActive || gameEnded) return;

                // Get the element at the touch position
                const touch = event.touches[0];
                const element = document.elementFromPoint(touch.clientX, touch.clientY);

                // Check if element is a cell and different from last touched cell
                if (element && element.classList.contains('word-cell') && element !== lastTouchCell) {
                    lastTouchCell = element;
                    continueSelection({ target: element });
                }
            }

            function handleTouchEnd() {
                if (!dragActive || gameEnded) return;

                endSelection();
                touchStartedCell = null;
                lastTouchCell = null;
            }

            // Restart button handler
            if (restartBtn) {
                restartBtn.addEventListener('click', startGame);
            }

            // Complete game button functionality
            const completeGameBtn = document.getElementById('complete-game-btn');
            if (completeGameBtn) {
                completeGameBtn.addEventListener('click', function() {
                    // Save game score and mark as completed
                    saveGameScore(score, timerEl.textContent);

                    // Show success notification
                    const btn = this;
                    btn.innerHTML = '<i class="fas fa-check"></i> Berhasil Disimpan';
                    btn.style.background = '#22C55E';
                    btn.disabled = true;

                    // Redirect to game list after short delay
                    setTimeout(() => {
                        window.location.href = "{{ route('permainan') }}";
                    }, 1500);
                });
            }

            // Modal related elements and functionality
            const viewCompletionBtn = document.getElementById('view-completion-btn');
            const completionModal = document.getElementById('completion-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const modalScore = document.getElementById('modal-score');
            const modalTime = document.getElementById('modal-time');

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
                const colors = ['#9D50BB', '#6E48AA', '#22C55E', '#3B82F6', '#9333EA'];
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

            // Hint button handler
            if (hintBtn) {
                hintBtn.addEventListener('click', function() {
                    if (gameEnded || words.length === foundWords.length) return;

                    // Clear previous hints
                    if (hintActive) {
                        hintCells.forEach(cell => {
                            if (!cell.classList.contains('correct')) {
                                cell.classList.remove('hint-active');
                            }
                        });
                        hintCells = [];
                        hintActive = false;
                        hintBtn.classList.remove('hint-active');
                        return;
                    }

                    // Find a word that hasn't been found yet
                    const remainingWords = words.filter(word => !foundWords.includes(word));
                    if (remainingWords.length === 0) return;

                    // Choose a random word from remaining words
                    const randomIndex = Math.floor(Math.random() * remainingWords.length);
                    const wordToHint = remainingWords[randomIndex];

                    // Get all cells with the first letter of the word
                    const firstLetter = wordToHint[0];
                    const allCells = Array.from(document.querySelectorAll('.word-cell'));

                    // Filter cells with the first letter that are not part of already found words
                    const firstLetterCells = allCells.filter(cell => {
                        return cell.textContent === firstLetter && !cell.classList.contains('correct');
                    });

                    // Highlight the cells
                    firstLetterCells.forEach(cell => {
                        cell.classList.add('hint-active');
                        hintCells.push(cell);
                    });

                    // Show hint message
                    hintBtn.classList.add('hint-active');
                    hintActive = true;

                    // Reduce score for using hint
                    score = Math.max(0, score - 5);
                    scoreEl.textContent = score;
                });
            }
        });
    </script>
</body>
</html>
