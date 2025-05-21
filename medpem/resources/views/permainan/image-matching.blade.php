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
                padding-top: 160px;
            }
        }

        .game-title {
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
            color: #ffffff;
            background: linear-gradient(90deg, #0ED2F7, #5B86E5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-description {
            text-align: center;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #ffffff;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: 300px;
            background: linear-gradient(90deg, #0ED2F7, #5B86E5);
            margin: 0 auto 2rem auto;
            border-radius: 2px;
        }

        .game-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            color: #151b2e;
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
            color: #0ED2F7;
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
            background: linear-gradient(90deg, #0ED2F7, #5B86E5);
            width: 0%;
            transition: width 0.5s ease;
            border-radius: 10px;
        }

        .matching-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }

        .card-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .card {
            background: white;
            border-radius: 10px;
            border: 2px solid #151b2e;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: #151b2e;
            position: relative;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .card.selected {
            border-color: #0ED2F7;
            box-shadow: 0 0 0 3px rgba(14, 210, 247, 0.3);
        }

        .card.matched {
            border-color: #58CC02;
            background-color: rgba(88, 204, 2, 0.1);
            pointer-events: none;
        }

        .image-card {
            padding: 0.5rem;
        }

        .image-card img {
            max-width: 100%;
            max-height: 120px;
            object-fit: contain;
            border-radius: 8px;
            transition: transform 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .image-card:hover img {
            transform: scale(1.05);
        }

        .instructions {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #0ED2F7;
            font-weight: 600;
        }

        .hint-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #FFC107;
            color: #151b2e;
            padding: 0.2rem 0.5rem;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .hint-visible {
            opacity: 1;
            transform: scale(1);
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
            background: linear-gradient(90deg, #0ED2F7, #5B86E5);
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

        .hint-container {
            text-align: center;
            margin-top: 1.5rem;
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

        @media (max-width: 640px) {
            .matching-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
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
                        <div class="stat-title">Pasangan Benar</div>
                        <div class="stat-value" id="matched-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Pasangan Tersisa</div>
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
                    <div id="game-container">
                        <div class="instructions">
                            <p>Petunjuk: Klik gambar di kolom kiri, lalu klik kata yang sesuai di kolom kanan.</p>
                        </div>

                        <div class="matching-grid" id="matching-grid">
                            <!-- Images column -->
                            <div class="card-container" id="images-container">
                                <!-- Will be populated with images -->
                            </div>

                            <!-- Words column -->
                            <div class="card-container" id="words-container">
                                <!-- Will be populated with words -->
                            </div>
                        </div>

                        <div class="hint-container">
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

                    <!-- Game over container -->
                    <div id="game-over-container" class="game-over-container">
                        <h2>Permainan Selesai!</h2>
                        <p>Kamu telah menyelesaikan semua pasangan kata dengan gambar.</p>

                        <div class="game-over-stats">
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-score">0</div>
                                <div class="game-over-stat-label">Skor Akhir</div>
                            </div>
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-matched">0</div>
                                <div class="game-over-stat-label">Pasangan Benar</div>
                            </div>
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-time">00:00</div>
                                <div class="game-over-stat-label">Waktu</div>
                            </div>
                        </div>

                        <div class="flex justify-center mb-6">
                            <a href="{{ route('permainan.answers', ['slug' => 'image-matching-house']) }}" class="btn btn-primary" style="max-width: 300px; width: 100%;">
                                <i class="fas fa-book-open mr-2"></i> Review Jawaban
                            </a>
                        </div>

                        <div class="flex justify-center">
                            <a href="{{ route('permainan') }}" class="btn btn-secondary">
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
            let score = 0;
            let matchedCount = 0;
            let timer;
            let seconds = 0;
            let selectedImageCard = null;
            let selectedWordCard = null;
            let hintsShown = 0;

            // DOM elements
            const scoreElement = document.getElementById('score');
            const matchedCountElement = document.getElementById('matched-count');
            const remainingCountElement = document.getElementById('remaining-count');
            const timerElement = document.getElementById('timer');
            const progressBar = document.getElementById('progress-bar');
            const gameContainer = document.getElementById('game-container');
            const gameOverContainer = document.getElementById('game-over-container');
            const imagesContainer = document.getElementById('images-container');
            const wordsContainer = document.getElementById('words-container');
            const hintButton = document.getElementById('hint-btn');

            // Final stats
            const finalScore = document.getElementById('final-score');
            const finalMatched = document.getElementById('final-matched');
            const finalTime = document.getElementById('final-time');

            // Start the game
            initGame();

            function initGame() {
                // Shuffle the game data
                const shuffledData = [...gameData];
                shuffleArray(shuffledData);

                // Create image cards
                shuffledData.forEach((item, index) => {
                    // TODO: The gameData should include image paths for each matching item
                    // The 'image' property in each item should point to an actual image file
                    // Images should be stored in public/images/games/image-matching/ directory
                    // and referenced as "/images/games/image-matching/[filename]"
                    // Each image should clearly represent the word it's associated with
                    // Recommended image format: square, 200x200px PNG or JPG
                    const imageCard = createCard('image', item.image, item.word, index);
                    imagesContainer.appendChild(imageCard);
                });

                // Create word cards (shuffled)
                const shuffledWords = [...shuffledData];
                shuffleArray(shuffledWords);
                shuffledWords.forEach((item, index) => {
                    const wordCard = createCard('word', null, item.word, index);
                    wordsContainer.appendChild(wordCard);
                });

                // Start timer
                startTimer();

                // Set up hint button
                hintButton.addEventListener('click', showHints);
            }

            function createCard(type, imageSrc, word, index) {
                const card = document.createElement('div');
                card.className = `card ${type}-card`;
                card.dataset.word = word;
                card.dataset.index = index;

                if (type === 'image') {
                    // Temporarily replace images with a placeholder notice
                    const placeholderDiv = document.createElement('div');
                    placeholderDiv.className = 'p-4 text-center';

                    const icon = document.createElement('i');
                    icon.className = 'fas fa-image text-blue-500 text-2xl mb-2';
                    placeholderDiv.appendChild(icon);

                    const text = document.createElement('p');
                    text.className = 'text-gray-800 text-sm';
                    text.textContent = 'Gambar belum tersedia';
                    placeholderDiv.appendChild(text);

                    card.appendChild(placeholderDiv);

                    // Comment out the original image code
                    /*
                    const img = document.createElement('img');
                    img.src = imageSrc;
                    img.alt = word;
                    card.appendChild(img);
                    */
                } else {
                    card.textContent = word;
                }

                // Add hint badge (hidden by default)
                const hintBadge = document.createElement('div');
                hintBadge.className = 'hint-badge';
                hintBadge.textContent = gameData.find(item => item.word === word).hint;
                card.appendChild(hintBadge);

                // Add click event
                card.addEventListener('click', () => selectCard(card, type));

                return card;
            }

            function selectCard(card, type) {
                // If card is already matched, do nothing
                if (card.classList.contains('matched')) {
                    return;
                }

                // Handle image card selection
                if (type === 'image') {
                    // Deselect previous image card if any
                    if (selectedImageCard) {
                        selectedImageCard.classList.remove('selected');
                    }

                    // Select new image card
                    selectedImageCard = card;
                    card.classList.add('selected');
                }
                // Handle word card selection
                else {
                    // If no image card is selected, do nothing
                    if (!selectedImageCard) {
                        return;
                    }

                    // Deselect previous word card if any
                    if (selectedWordCard) {
                        selectedWordCard.classList.remove('selected');
                    }

                    // Select new word card
                    selectedWordCard = card;
                    card.classList.add('selected');

                    // Check for match
                    checkForMatch();
                }
            }

            function checkForMatch() {
                const imageWord = selectedImageCard.dataset.word;
                const selectedWord = selectedWordCard.dataset.word;

                // Wait a bit before checking
                setTimeout(() => {
                    if (imageWord === selectedWord) {
                        // Match found
                        selectedImageCard.classList.remove('selected');
                        selectedWordCard.classList.remove('selected');

                        selectedImageCard.classList.add('matched');
                        selectedWordCard.classList.add('matched');

                        // Increase score
                        score += 10;
                        matchedCount++;

                        // Update UI
                        scoreElement.textContent = score;
                        matchedCountElement.textContent = matchedCount;
                        remainingCountElement.textContent = gameData.length - matchedCount;

                        // Update progress bar
                        updateProgressBar();

                        // Check if game is over
                        if (matchedCount === gameData.length) {
                            endGame();
                        }
                    } else {
                        // No match
                        selectedImageCard.classList.remove('selected');
                        selectedWordCard.classList.remove('selected');
                    }

                    // Reset selections
                    selectedImageCard = null;
                    selectedWordCard = null;
                }, 500);
            }

            function showHints() {
                if (hintsShown < 3) { // Limit hints to 3 times
                    hintsShown++;

                    // Show all hint badges briefly
                    const hintBadges = document.querySelectorAll('.hint-badge');
                    hintBadges.forEach(badge => {
                        badge.classList.add('hint-visible');
                    });

                    // Hide hints after 3 seconds
                    setTimeout(() => {
                        hintBadges.forEach(badge => {
                            badge.classList.remove('hint-visible');
                        });
                    }, 3000);

                    // Update hint button
                    if (hintsShown === 3) {
                        hintButton.textContent = 'Petunjuk Habis';
                        hintButton.disabled = true;
                        hintButton.style.opacity = 0.5;
                    } else {
                        hintButton.textContent = `Tampilkan Petunjuk (${3-hintsShown} tersisa)`;
                    }

                    // Reduce score for using hint
                    score -= 2;
                    if (score < 0) score = 0;
                    scoreElement.textContent = score;
                }
            }

            function endGame() {
                clearInterval(timer);

                // Save game data to server
                saveGameResult();

                // Update final stats
                finalScore.textContent = score;
                finalMatched.textContent = matchedCount;
                finalTime.textContent = formatTime(seconds);

                // Show game over container
                setTimeout(() => {
                    gameContainer.style.display = 'none';
                    gameOverContainer.style.display = 'block';
                    createConfetti();
                }, 1000);
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
                const progress = (matchedCount / gameData.length) * 100;
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
