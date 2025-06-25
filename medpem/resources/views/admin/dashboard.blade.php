<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MPBing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        body {
            font-family: 'Source Sans Pro', 'Nunito', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            overflow-x: hidden;
        }

        .main-content {
            min-height: calc(100vh - 70px);
            margin-left: 250px;
            padding-top: 70px;
            padding-bottom: 2rem;
            transition: all 0.3s;
            width: calc(100% - 250px);
        }

        .welcome-banner {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.8));
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.75rem;
            box-shadow: 0 20px 30px -15px rgba(2, 6, 23, 0.5);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.25rem;
            margin-top: 1.5rem;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .wide-card {
            grid-column: span 6;
        }

        @media (max-width: 1024px) {
            .wide-card {
                grid-column: span 12;
            }
            .small-card {
                grid-column: span 6;
            }
        }

        .full-card {
            grid-column: span 12;
        }

        .small-card {
            grid-column: span 3;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 80px;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .small-card {
                grid-column: span 12;
            }

            /* Mobile specific adjustments */
            .dashboard-grid {
                gap: 1rem;
            }

            .welcome-banner {
                padding: 1.25rem;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.75rem;
            }

            .admin-action-button {
                width: 100%;
                margin-bottom: 0.5rem;
                margin-right: 0;
                justify-content: center;
            }

            /* Table responsiveness */
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .admin-table {
                min-width: 600px;
                font-size: 0.8rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.5rem 0.25rem;
                white-space: nowrap;
            }

            .data-section-heading {
                font-size: 1rem;
            }

            .info-tooltip .tooltip-text {
                width: 150px;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 640px) {
            .main-content {
                padding-top: 80px;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .welcome-banner {
                padding: 1rem;
            }

            .welcome-title {
                font-size: 1.75rem;
                margin-bottom: 0.4rem;
            }

            .welcome-banner p {
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .dashboard-grid {
                gap: 0.75rem;
            }

            .stat-card {
                padding: 0.75rem;
                border-radius: 10px;
            }

            .stat-value {
                font-size: 1.5rem;
                margin-bottom: 0.2rem;
            }

            .stat-label {
                font-size: 0.9rem;
            }

            .subtitle {
                font-size: 0.8rem;
            }

            .card-icon {
                font-size: 1.5rem;
                top: 0.75rem;
                right: 0.75rem;
            }

            .admin-action-button {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }

            .data-section-heading {
                font-size: 0.95rem;
                margin-bottom: 0.5rem;
            }

            /* Compact table for mobile */
            .admin-table {
                min-width: 500px;
                font-size: 0.75rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.4rem 0.2rem;
            }

            .status-pill {
                font-size: 0.65rem;
                padding: 0.2rem 0.5rem;
            }

            .info-tooltip .tooltip-text {
                width: 120px;
                font-size: 0.65rem;
                padding: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding-top: 75px;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .welcome-banner {
                padding: 0.75rem;
                border-radius: 12px;
            }

            .welcome-title {
                font-size: 1.5rem;
                margin-bottom: 0.3rem;
                line-height: 1.2;
            }

            .welcome-banner p {
                font-size: 0.8rem;
                line-height: 1.3;
            }

            .dashboard-grid {
                gap: 0.5rem;
            }

            .stat-card {
                padding: 0.6rem;
                border-radius: 8px;
            }

            .stat-value {
                font-size: 1.25rem;
                margin-bottom: 0.15rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }

            .subtitle {
                font-size: 0.75rem;
                margin-top: 0.15rem;
            }

            .card-icon {
                font-size: 1.25rem;
                top: 0.6rem;
                right: 0.6rem;
            }

            .admin-action-button {
                padding: 0.45rem 0.8rem;
                font-size: 0.8rem;
                margin-bottom: 0.4rem;
            }

            .admin-action-button i {
                margin-right: 0.3rem;
            }

            .data-section-heading {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
            }

            .data-section-heading i {
                margin-right: 0.3rem;
            }

            /* Very compact table for small screens */
            .admin-table {
                min-width: 450px;
                font-size: 0.7rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.3rem 0.15rem;
            }

            .status-pill {
                font-size: 0.6rem;
                padding: 0.15rem 0.4rem;
            }

            .info-tooltip {
                display: none; /* Hide tooltips on very small screens */
            }

            /* Activity section adjustments */
            .space-y-3 > * + * {
                margin-top: 0.5rem;
            }

            .space-y-3 .flex.items-start {
                padding: 0.5rem;
                border-radius: 6px;
            }

            .space-y-3 .text-sm {
                font-size: 0.75rem;
            }

            .space-y-3 .text-xs {
                font-size: 0.65rem;
            }

            /* System status section */
            .space-y-2 > * + * {
                margin-top: 0.4rem;
            }

            .flex.justify-between .text-gray-300 {
                font-size: 0.8rem;
            }

            .flex.justify-between span:last-child {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 360px) {
            .main-content {
                padding-top: 70px;
                padding-left: 0.25rem;
                padding-right: 0.25rem;
            }

            .welcome-title {
                font-size: 1.25rem;
                margin-bottom: 0.25rem;
            }

            .welcome-banner {
                padding: 0.5rem;
            }

            .welcome-banner p {
                font-size: 0.75rem;
                line-height: 1.2;
            }

            .stat-card {
                padding: 0.5rem;
            }

            .stat-value {
                font-size: 1.1rem;
            }

            .stat-label {
                font-size: 0.75rem;
            }

            .subtitle {
                font-size: 0.7rem;
            }

            .card-icon {
                font-size: 1rem;
                top: 0.5rem;
                right: 0.5rem;
            }

            .admin-action-button {
                padding: 0.4rem 0.6rem;
                font-size: 0.75rem;
            }

            .data-section-heading {
                font-size: 0.85rem;
            }

            /* Ultra compact table */
            .admin-table {
                min-width: 380px;
                font-size: 0.65rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 0.25rem 0.1rem;
            }

            .status-pill {
                font-size: 0.55rem;
                padding: 0.1rem 0.3rem;
            }

            /* Activity items very compact */
            .space-y-3 .flex.items-start {
                padding: 0.4rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .space-y-3 .text-sm {
                font-size: 0.7rem;
                line-height: 1.2;
            }

            .space-y-3 .text-xs {
                font-size: 0.6rem;
                margin-top: 0.2rem;
            }

            /* System status very compact */
            .flex.justify-between {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.1rem;
            }

            .flex.justify-between .text-gray-300 {
                font-size: 0.75rem;
            }

            .flex.justify-between span:last-child {
                font-size: 0.7rem;
            }
        }

        /* Landscape orientation adjustments for mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .main-content {
                padding-top: 70px;
            }

            .welcome-title {
                font-size: 1.75rem;
            }

            .dashboard-grid {
                gap: 0.75rem;
            }

            .stat-card {
                padding: 0.75rem;
            }
        }

        /* Touch-friendly adjustments */
        @media (max-width: 768px) {
            .admin-action-button {
                min-height: 44px; /* iOS recommended touch target */
                touch-action: manipulation;
            }

            .status-pill {
                min-height: 24px;
                display: inline-flex;
                align-items: center;
            }

            .table-container {
                border-radius: 6px;
            }

            .admin-table th {
                position: sticky;
                top: 0;
                background: rgba(30, 41, 59, 0.95);
                z-index: 1;
            }
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            color: white;
        }

        .stat-label {
            color: #e2e8f0;
            font-size: 1rem;
            font-weight: 600;
        }

        .subtitle {
            font-size: 0.85rem;
            color: #cbd5e1;
            margin-top: 0.25rem;
        }

        .users-card {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            border-left: 4px solid #818cf8;
        }

        .materials-card {
            background: linear-gradient(135deg, #0369a1, #0ea5e9);
            border-left: 4px solid #38bdf8;
        }

        .lessons-card {
            background: linear-gradient(135deg, #b45309, #f59e0b);
            border-left: 4px solid #fbbf24;
        }

        .completion-card {
            background: linear-gradient(135deg, #be185d, #ec4899);
            border-left: 4px solid #f472b6;
        }

        .card-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.75rem;
            opacity: 0.6;
        }

        .admin-action-button {
            display: inline-flex;
            align-items: center;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            margin-right: 0.75rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .admin-action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .admin-action-button i {
            margin-right: 0.5rem;
        }

        .analytics-card {
            background: rgba(30, 41, 59, 0.85);
            border-left: 4px solid #6366f1;
        }

        .table-container {
            background: rgba(15, 23, 42, 0.3);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            background: rgba(30, 41, 59, 0.9);
            color: #ffffff;
            font-weight: 600;
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        .admin-table td {
            padding: 0.75rem 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 0.875rem;
        }

        .admin-table tr:hover td {
            background: rgba(30, 41, 59, 0.5);
        }

        .status-pill {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .data-section-heading {
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }

        .data-section-heading i {
            margin-right: 0.5rem;
            color: #6366f1;
        }

        .info-tooltip {
            position: relative;
            display: inline-block;
            margin-left: 0.5rem;
            cursor: help;
        }

        .info-tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #1e293b;
            color: #e2e8f0;
            text-align: center;
            border-radius: 6px;
            padding: 0.5rem;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-weight: normal;
            font-size: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .info-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Custom scrollbar for student table scroll */
        .table-container[style*="overflow-y: auto"] {
            scrollbar-width: thin;
            scrollbar-color: #6366f1 #1e293b;
        }
        .table-container[style*="overflow-y: auto"]::-webkit-scrollbar {
            width: 10px;
        }
        .table-container[style*="overflow-y: auto"]::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 8px;
        }
        .table-container[style*="overflow-y: auto"]::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            border-radius: 8px;
            border: 2px solid #1e293b;
        }
        .table-container[style*="overflow-y: auto"]::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
        }
    </style>
</head>
<body>
    @include('header')
    @include('components.duplicate-login-modal')
    <div class="flex">
        @include('sidebar')

        <div class="main-content px-4 md:px-6">
            <div class="welcome-banner">
                <h1 class="welcome-title">Dashboard Admin</h1>
                <p class="text-base text-gray-300 max-w-2xl">
                    Selamat datang, {{ $user->name }}. Dari dashboard ini Anda dapat memantau aktivitas siswa, mengelola konten pembelajaran, dan menganalisis perkembangan pembelajaran.
                </p>
            </div>

            <div class="dashboard-grid">
                <!-- User Stats Card -->
                <div class="stat-card small-card users-card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-value">{{ $stats['user_count'] ?? '0' }}</div>
                    <div class="subtitle">{{ ($stats['active_users'] ?? '0') . ' pengguna aktif minggu ini' }}</div>
                </div>

                <!-- Materials Card -->
                <div class="stat-card small-card materials-card">
                    <div class="card-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-label">Materi</div>
                    <div class="stat-value">{{ $stats['materi_count'] ?? '0' }}</div>
                    <div class="subtitle">{{ ($stats['popular_materi'] ?? 'Tidak ada data') . ' paling populer' }}</div>
                </div>

                <!-- Lessons Card -->
                <div class="stat-card small-card lessons-card">
                    <div class="card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-label">Pelajaran</div>
                    <div class="stat-value">{{ $stats['lesson_count'] ?? '0' }}</div>
                    <div class="subtitle">{{ ($stats['completed_lessons'] ?? '0') . ' diselesaikan minggu ini' }}</div>
                </div>

                <!-- Completion Rate Card -->
                <div class="stat-card small-card completion-card">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-label">Tingkat Penyelesaian</div>
                    <div class="stat-value">{{ $stats['completion_rate'] ?? '0' }}%</div>
                    <div class="subtitle">
                        @if(isset($stats['completion_change']))
                            @if($stats['completion_change'] > 0)
                                <span class="text-green-300">+{{ $stats['completion_change'] }}% vs minggu lalu</span>
                            @elseif($stats['completion_change'] < 0)
                                <span class="text-red-300">{{ $stats['completion_change'] }}% vs minggu lalu</span>
                            @else
                                <span>{{ $stats['completion_change'] }}% vs minggu lalu</span>
                            @endif
                        @else
                            <span>0% vs minggu lalu</span>
                        @endif
                    </div>
                </div>

                <!-- Student Performance -->
                <div class="stat-card wide-card analytics-card">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-white">Performa Siswa</h3>
                        <div class="text-xs text-blue-300 bg-blue-900 bg-opacity-30 px-2 py-1 rounded">
                            <i class="fas fa-sync-alt mr-1"></i> Terakhir diperbarui: {{ date('d M Y, H:i') }}
                        </div>
                    </div>

                    <div class="data-section-heading">
                        <i class="fas fa-user-graduate"></i> Semua Siswa
                        <div class="info-tooltip">
                            <i class="fas fa-info-circle text-blue-400"></i>
                            <span class="tooltip-text">Daftar semua siswa beserta performanya. Scroll ke bawah untuk melihat lebih banyak.</span>
                        </div>
                    </div>

                    <div class="table-container" style="max-height: 350px; overflow-y: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Total Poin</th>
                                    <th>Materi Selesai</th>
                                    <th>Pelajaran Selesai</th>
                                    <th>Streak</th>
                                    <th>Pencapaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allStudents as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->total_points }}</td>
                                    <td>{{ $student->completed_materials }}/{{ $stats['materi_count'] }}</td>
                                    <td>{{ $student->completed_lessons }}/{{ $stats['lesson_count'] }}</td>
                                    <td>{{ $student->streak }} hari</td>
                                    <td>{{ $student->achievements_count }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada data siswa.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('leaderboard') }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center">
                            <i class="fas fa-trophy mr-1"></i> Lihat Semua Siswa <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Content Analytics -->
                <div class="stat-card wide-card analytics-card">
                    <h3 class="text-lg font-bold text-white mb-3">Analisis Konten Pembelajaran</h3>

                    <div class="data-section-heading">
                        <i class="fas fa-chart-bar"></i> Materi Paling Banyak Dibaca
                        <div class="info-tooltip">
                            <i class="fas fa-info-circle text-blue-400"></i>
                            <span class="tooltip-text">Materi yang paling banyak diakses oleh siswa dalam 30 hari terakhir.</span>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Judul Materi</th>
                                    <th>Dibaca</th>
                                    <th>Penyelesaian</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularMaterials as $material)
                                <tr>
                                    <td>{{ $material->title }}</td>
                                    <td>{{ $material->access_count }}</td>
                                    <td>{{ round($material->completion_rate) }}%</td>
                                    <td>{{ number_format(rand(40, 50) / 10, 1) }}/5</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada data materi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="data-section-heading mt-4">
                        <i class="fas fa-exclamation-triangle"></i> Materi Dengan Tingkat Penyelesaian Rendah
                        <div class="info-tooltip">
                            <i class="fas fa-info-circle text-blue-400"></i>
                            <span class="tooltip-text">Materi yang memiliki tingkat penyelesaian rendah mungkin terlalu sulit atau kurang menarik bagi siswa.</span>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Judul Materi</th>
                                    <th>Dibaca</th>
                                    <th>Penyelesaian</th>
                                    <th>Kesulitan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowCompletionMaterials as $material)
                                <tr>
                                    <td>{{ $material->title }}</td>
                                    <td>{{ $material->access_count }}</td>
                                    <td>{{ round($material->completion_rate) }}%</td>
                                    <td>{{ $material->completion_rate < 30 ? 'Tinggi' : 'Sedang' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Tidak ada materi dengan tingkat penyelesaian rendah.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.materi.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center">
                            <i class="fas fa-book mr-1"></i> Kelola Semua Materi <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Admin Quick Actions -->
                <div class="stat-card full-card">
                    <h3 class="text-lg font-bold text-white mb-3">Aksi Cepat</h3>
                    <div class="flex flex-wrap mt-2">
                        <a href="{{ route('admin.materi.create') }}" class="admin-action-button">
                            <i class="fas fa-plus"></i> Tambah Materi Baru
                        </a>
                        <a href="{{ route('admin.materi.index') }}" class="admin-action-button">
                            <i class="fas fa-edit"></i> Kelola Materi
                        </a>
                        <a href="{{ route('leaderboard') }}" class="admin-action-button">
                            <i class="fas fa-trophy"></i> Lihat Papan Peringkat
                        </a>
                        <a href="{{ route('admin.users.export') }}" class="admin-action-button">
                            <i class="fas fa-file-export"></i> Ekspor Data Siswa
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="admin-action-button">
                            <i class="fas fa-users"></i> Manajemen Pengguna
                        </a>
                    </div>
                </div>

                <!-- Recent Activity Log -->
                <div class="stat-card wide-card">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-white">Aktivitas Terbaru Sistem</h3>
                        <span class="text-xs text-gray-400">Menampilkan 24 jam terakhir</span>
                    </div>

                    <div class="space-y-3 mt-3">
                        @forelse($recentActivities as $activity)
                        <div class="flex items-start space-x-3 p-2 rounded-lg bg-gray-800 bg-opacity-40">
                            <div class="text-{{ $activity['color'] }} mt-1"><i class="fas {{ $activity['icon'] }}"></i></div>
                            <div>
                                <div class="text-sm">
                                    <span class="font-semibold text-white">{{ $activity['title'] }}</span> - {{ $activity['message'] }}
                                </div>
                                <div class="text-xs text-gray-400">{{ $activity['time']->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-gray-400">
                            <i class="fas fa-info-circle mr-2"></i> Tidak ada aktivitas sistem dalam 24 jam terakhir.
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        <a href="#" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center">
                            <i class="fas fa-history mr-1"></i> Lihat Semua Aktivitas <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- System Status -->
                <div class="stat-card wide-card">
                    <h3 class="text-lg font-bold text-white mb-3">Status Sistem & Informasi Teknis</h3>
                    <p class="text-gray-400 mb-3">Informasi detail mengenai status aplikasi, platform, dan layanan untuk pengajar dan administrator.</p>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Database Connection</span>
                            <span class="text-green-400 font-semibold"><i class="fas fa-circle text-xs mr-1"></i> Connected</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Laravel Version</span>
                            <span class="text-blue-400 font-semibold">12.8.1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">PHP Version</span>
                            <span class="text-blue-400 font-semibold">8.2.21</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">MySQL Server</span>
                            <span class="text-blue-400 font-semibold">8.0.35</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Server Load Average</span>
                            <span class="text-green-400 font-semibold">0.32, 0.45, 0.38</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Storage Usage</span>
                            <span class="text-blue-400 font-semibold">4.8 GB / 20 GB (24%)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Backup Status</span>
                            <span class="text-green-400 font-semibold">Last backup: {{ date('d M Y, H:i', strtotime('-1 day')) }}</span>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-900 bg-opacity-30 rounded-lg border border-blue-800 border-opacity-40">
                        <div class="flex items-start">
                            <div class="text-blue-500 text-lg mr-3"><i class="fas fa-info-circle"></i></div>
                            <div>
                                <div class="text-blue-300 font-semibold mb-1">Informasi untuk Pengajar</div>
                                <p class="text-sm text-blue-200">
                                    Sistem pembelajaran untuk siswa kelas 5 SD ini dirancang dengan kurikulum terbaru.
                                    Materi dibuat khusus untuk usia 10-11 tahun dengan pendekatan gamifikasi untuk meningkatkan
                                    motivasi belajar. Pencapaian (achievements) disesuaikan dengan kemampuan kognitif siswa kelas 5.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle table row interactions
            const tableRows = document.querySelectorAll('.admin-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function() {
                    // Could implement row selection or detail view
                });
            });
        });
    </script>
</body>
</html>
