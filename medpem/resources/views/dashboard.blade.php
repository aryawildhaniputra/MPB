<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .main-content {
            min-height: calc(100vh - 70px);
            margin-left: 250px;
            padding-top: 80px; /* Reduced from 90px */
            padding-bottom: 1rem; /* Reduced from 2rem */
            transition: all 0.3s;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #4a5af0;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            padding: 0.5rem 2rem;
            border-radius: 8px;
        }

        .subtitle {
            text-align: center;
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: #333;
            background-color: rgba(0, 0, 0, 0.05);
            padding: 0.5rem;
            border-radius: 8px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: none;
            background: #4a5af0;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        .dashboard-content {
            padding: 1.5rem; /* Reduced from 2rem */
            border-radius: 1rem;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .dashboard-title {
            font-size: 2.2rem; /* Reduced from 2.5rem */
            font-weight: 800;
            color: #1CB0F6;
            margin-bottom: 1rem; /* Reduced from 1.5rem */
            display: inline-block;
            background: linear-gradient(90deg, #58CC02, #1CB0F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-message {
            font-size: 1.1rem; /* Reduced from 1.2rem */
            color: #4a5568;
            margin-bottom: 1.5rem; /* Reduced from 2rem */
            line-height: 1.4; /* Reduced from 1.6 */
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem; /* Reduced from 1.5rem */
            margin-top: 1rem; /* Reduced from 2rem */
        }

        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.2rem; /* Reduced from 1.5rem */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 5px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card.blue {
            border-color: #1CB0F6;
        }

        .stat-card.green {
            border-color: #58CC02;
        }

        .stat-card.orange {
            border-color: #ff9500;
        }

        .stat-card.purple {
            border-color: #a560ff;
        }

        .stat-icon {
            font-size: 1.8rem; /* Reduced from 2rem */
            margin-bottom: 0.7rem; /* Reduced from 1rem */
        }

        .stat-value {
            font-size: 1.8rem; /* Reduced from 2rem */
            font-weight: 800;
            margin-bottom: 0.3rem; /* Reduced from 0.5rem */
        }

        .stat-label {
            color: #718096;
            font-size: 0.9rem; /* Reduced from 0.95rem */
        }

        /* New sections */
        .dashboard-section {
            margin-top: 1.2rem;
            padding: 1.2rem;
            border-radius: 1rem;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.5rem;
            color: #1CB0F6;
        }

        .progress-card {
            display: flex;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            border-radius: 0.8rem;
            background-color: #f8fafc;
            border-left: 4px solid #1CB0F6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .progress-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .progress-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            color: #1CB0F6;
        }

        .progress-info {
            flex: 1;
        }

        .progress-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: #2d3748;
        }

        .progress-bar-container {
            height: 0.6rem;
            background-color: #e2e8f0;
            border-radius: 0.3rem;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #58CC02, #1CB0F6);
            border-radius: 0.3rem;
        }

        .achievement-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #a560ff, #6B46C1);
            color: white;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .achievement-info {
            flex: 1;
        }

        .achievement-title {
            font-weight: 600;
            color: #2d3748;
        }

        .achievement-desc {
            font-size: 0.85rem;
            color: #718096;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.8rem;
        }

        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border-radius: 0.8rem;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            text-align: center;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-color: #cbd5e0;
        }

        .action-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .action-text {
            font-weight: 600;
            font-size: 0.85rem;
            color: #4a5568;
        }

        .suggestion-card {
            display: flex;
            align-items: center;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            border-radius: 0.8rem;
            background-color: #f8fafc;
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 4px solid #ff9500;
        }

        .suggestion-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .suggestion-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            color: #ff9500;
        }

        .suggestion-info {
            flex: 1;
        }

        .suggestion-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.3rem;
        }

        .suggestion-desc {
            font-size: 0.85rem;
            color: #718096;
        }

        .btn-play {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: #58CC02;
            color: white;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-play:hover {
            background-color: #46a801;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding-top: 120px; /* Account for both mobile sidebar and header */
            }

            .dashboard-title {
                font-size: 1.6rem;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    @include('header')
    @include('components.duplicate-login-modal')
    <div class="flex">
        @include('sidebar')

        <div class="main-content">
            <div class="container mx-auto px-3">
                <div class="text-center mb-8 px-6">
                    <h1 class="content-title">
                        DASHBOARD <i class="fas fa-home ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Selamat datang di panel utama pembelajaran Bahasa Inggris!</p>
                </div>
                <div class="gradient-border"></div>

                <div class="dashboard-content">
                    <div class="stats-grid">
                        <div class="stat-card blue">
                            <div class="stat-icon text-blue-500">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="stat-value">7</div>
                            <div class="stat-label">Materi Dipelajari</div>
                        </div>

                        <div class="stat-card green">
                            <div class="stat-icon text-green-500">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stat-value">3</div>
                            <div class="stat-label">Permainan Diselesaikan</div>
                        </div>

                        <div class="stat-card orange">
                            <div class="stat-icon text-orange-500">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-value">250</div>
                            <div class="stat-label">Total Poin</div>
                        </div>

                        <div class="stat-card purple">
                            <div class="stat-icon text-purple-500">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="stat-value">5</div>
                            <div class="stat-label">Pencapaian</div>
                        </div>

                        <!-- New Completion Card for top-right red area -->
                        <div class="stat-card" style="background: linear-gradient(135deg, #F97316, #EA580C); color: white; border-color: #EA580C;">
                            <div class="stat-icon text-white">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div class="stat-value text-white">98%</div>
                            <div class="stat-label text-white">Skor Tertinggi - Word Scramble</div>
                        </div>
                    </div>

                    <!-- Lanjutkan Belajar Section -->
                    <div class="dashboard-section">
                        <h2 class="section-title"><i class="fas fa-graduation-cap"></i> Lanjutkan Belajar</h2>
                        <div class="progress-card">
                            <div class="progress-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="progress-info">
                                <div class="progress-title">Bagian Tubuh - Pelajaran 2</div>
                                <div class="text-sm text-gray-500">Melanjutkan pelajaran tentang kosakata bagian tubuh</div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 65%"></div>
                                </div>
                                <div class="text-xs text-right text-gray-500 mt-1">65% selesai</div>
                            </div>
                        </div>
                        <div class="progress-card">
                            <div class="progress-icon">
                                <i class="fas fa-head-side-cough"></i>
                            </div>
                            <div class="progress-info">
                                <div class="progress-title">Jenis Penyakit - Pelajaran 1</div>
                                <div class="text-sm text-gray-500">Belajar kosakata tentang berbagai jenis penyakit</div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 30%"></div>
                                </div>
                                <div class="text-xs text-right text-gray-500 mt-1">30% selesai</div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Game Suggestions -->
                    <div class="dashboard-section">
                        <h2 class="section-title"><i class="fas fa-gamepad"></i> Game yang Disarankan</h2>
                        <div class="suggestion-card">
                            <div class="suggestion-icon">
                                <i class="fas fa-puzzle-piece"></i>
                            </div>
                            <div class="suggestion-info">
                                <div class="suggestion-title">Word Scramble - Jenis Penyakit</div>
                                <div class="suggestion-desc">Susun kata-kata acak tentang penyakit dalam bahasa Inggris</div>
                            </div>
                            <a href="#" class="btn-play ml-3">
                                <i class="fas fa-play mr-2"></i> Main
                            </a>
                        </div>
                        <div class="suggestion-card">
                            <div class="suggestion-icon">
                                <i class="fas fa-th"></i>
                            </div>
                            <div class="suggestion-info">
                                <div class="suggestion-title">Word Search - Bagian Tubuh</div>
                                <div class="suggestion-desc">Temukan kata-kata tentang bagian tubuh dalam kotak huruf</div>
                            </div>
                            <a href="#" class="btn-play ml-3">
                                <i class="fas fa-play mr-2"></i> Main
                            </a>
                        </div>
                    </div>

                    <!-- Recent Achievements -->
                    <div class="dashboard-section">
                        <h2 class="section-title"><i class="fas fa-award"></i> Pencapaian Terbaru</h2>
                        <div class="progress-card">
                            <div class="achievement-badge">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div class="achievement-info">
                                <div class="achievement-title">Semangat Berapi-api</div>
                                <div class="achievement-desc">Belajar 3 hari berturut-turut</div>
                            </div>
                        </div>
                        <div class="progress-card">
                            <div class="achievement-badge">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <div class="achievement-info">
                                <div class="achievement-title">Pembaca Handal</div>
                                <div class="achievement-desc">Menyelesaikan 5 materi pembelajaran</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    {{-- <div class="dashboard-section">
                        <h2 class="section-title"><i class="fas fa-bolt"></i> Aksi Cepat</h2>
                        <div class="quick-actions">
                            <a href="#" class="action-btn">
                                <i class="fas fa-book action-icon"></i>
                                <span class="action-text">Buka Materi</span>
                            </a>
                            <a href="#" class="action-btn">
                                <i class="fas fa-gamepad action-icon"></i>
                                <span class="action-text">Main Game</span>
                            </a>
                            <a href="#" class="action-btn">
                                <i class="fas fa-trophy action-icon"></i>
                                <span class="action-text">Lihat Skor</span>
                            </a>
                            <a href="#" class="action-btn">
                                <i class="fas fa-user-circle action-icon"></i>
                                <span class="action-text">Profil</span>
                            </a>
                        </div>
                    </div> --}}

                    <!-- New Game Completion section for bottom-right red area -->
                    <div class="dashboard-section">
                        <h2 class="section-title"><i class="fas fa-trophy"></i> Permainan Diselesaikan</h2>
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg overflow-hidden">
                            <div class="p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-yellow-500">
                                        <div class="bg-yellow-100 rounded-full p-3 mr-4">
                                            <i class="fas fa-puzzle-piece text-yellow-500 text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">Word Scramble - Penyakit</h3>
                                            <p class="text-sm text-gray-600">Skor: 98/100 · <span class="text-green-500">Diselesaikan</span></p>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-green-500">
                                        <div class="bg-green-100 rounded-full p-3 mr-4">
                                            <i class="fas fa-th text-green-500 text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">Word Search - Bagian Tubuh</h3>
                                            <p class="text-sm text-gray-600">Skor: 85/100 · <span class="text-green-500">Diselesaikan</span></p>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-blue-500">
                                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                                            <i class="fas fa-object-group text-blue-500 text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">Word Matching - Penyakit</h3>
                                            <p class="text-sm text-gray-600">Skor: 90/100 · <span class="text-green-500">Diselesaikan</span></p>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow p-4 flex items-center border-l-4 border-purple-500">
                                        <div class="bg-purple-100 rounded-full p-3 mr-4">
                                            <i class="fas fa-gamepad text-purple-500 text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">Skor Tertinggi Kamu</h3>
                                            <p class="text-sm text-gray-600">Word Scramble - Penyakit · <span class="text-yellow-500 font-bold">98 Poin</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.achievement-notification')
</body>
</html>
