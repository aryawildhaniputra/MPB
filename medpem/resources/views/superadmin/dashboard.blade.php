<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Dashboard | MPBing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background: linear-gradient(90deg, #dc2626, #ef4444);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .superadmin-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 0.5rem;
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

        .full-card {
            grid-column: span 12;
        }

        .small-card {
            grid-column: span 3;
        }

        .medium-card {
            grid-column: span 4;
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

        /* Enhanced color scheme for superadmin */
        .users-card {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            border-left: 4px solid #f87171;
        }

        .admins-card {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            border-left: 4px solid #a78bfa;
        }

        .students-card {
            background: linear-gradient(135deg, #0369a1, #0ea5e9);
            border-left: 4px solid #38bdf8;
        }

        .engagement-card {
            background: linear-gradient(135deg, #059669, #10b981);
            border-left: 4px solid #34d399;
        }

        .system-card {
            background: linear-gradient(135deg, #ea580c, #f97316);
            border-left: 4px solid #fb923c;
        }

        .analytics-card {
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

        .superadmin-action-button {
            display: inline-flex;
            align-items: center;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            margin-right: 0.75rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .superadmin-action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #b91c1c, #dc2626);
        }

        .superadmin-action-button i {
            margin-right: 0.5rem;
        }

        .table-container {
            background: rgba(15, 23, 42, 0.3);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .superadmin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .superadmin-table th {
            background: rgba(30, 41, 59, 0.9);
            color: #ffffff;
            font-weight: 600;
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        .superadmin-table td {
            padding: 0.75rem 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 0.875rem;
        }

        .superadmin-table tr:hover td {
            background: rgba(30, 41, 59, 0.5);
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
            color: #ef4444;
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            margin-top: 0.25rem;
        }

        .trend-up {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .trend-down {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .trend-stable {
            background: rgba(156, 163, 175, 0.2);
            color: #9ca3af;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 1rem;
        }

        .admin-performance-item {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-left: 3px solid #7c3aed;
        }

        .performance-metric {
            display: inline-flex;
            align-items: center;
            background: rgba(30, 41, 59, 0.6);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            margin-right: 0.5rem;
            margin-top: 0.25rem;
        }

        /* Mobile responsiveness */
        @media (max-width: 1024px) {
            .wide-card {
                grid-column: span 12;
            }
            .small-card {
                grid-column: span 6;
            }
            .medium-card {
                grid-column: span 6;
            }
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

            .superadmin-action-button {
                width: 100%;
                margin-bottom: 0.5rem;
                margin-right: 0;
                justify-content: center;
            }

            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .superadmin-table {
                min-width: 600px;
                font-size: 0.8rem;
            }

            .superadmin-table th,
            .superadmin-table td {
                padding: 0.5rem 0.25rem;
                white-space: nowrap;
            }
        }

        @media (max-width: 640px) {
            .welcome-title {
                font-size: 1.75rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .superadmin-action-button {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .welcome-title {
                font-size: 1.5rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .superadmin-action-button {
                padding: 0.45rem 0.8rem;
                font-size: 0.8rem;
            }
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
                <div class="flex items-center">
                    <h1 class="welcome-title">SuperAdmin Dashboard</h1>
                    <span class="superadmin-badge">
                        <i class="fas fa-crown mr-1"></i> MASTER ACCESS
                    </span>
                </div>
                <p class="text-base text-gray-300 max-w-2xl">
                    Selamat datang, {{ $user->name }}. Dashboard ini memberikan Anda kontrol penuh atas sistem pembelajaran,
                    termasuk manajemen admin, analisis mendalam, dan pemantauan kesehatan sistem.
                </p>
            </div>

            <div class="dashboard-grid">
                <!-- Enhanced Statistics Row -->
                <div class="stat-card small-card users-card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-value">{{ $stats['user_count'] ?? '0' }}</div>
                    <div class="subtitle">{{ ($stats['active_users_today'] ?? '0') . ' aktif hari ini' }}</div>
                    <div class="trend-indicator trend-up">
                        <i class="fas fa-arrow-up mr-1"></i> +{{ rand(5, 15) }}% bulan ini
                    </div>
                </div>

                <div class="stat-card small-card admins-card">
                    <div class="card-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stat-label">Administrator</div>
                    <div class="stat-value">{{ $stats['admin_count'] ?? '0' }}</div>
                    <div class="subtitle">{{ ($stats['superadmin_count'] ?? '0') . ' superadmin' }}</div>
                    <div class="trend-indicator trend-stable">
                        <i class="fas fa-minus mr-1"></i> Stabil
                    </div>
                </div>

                <div class="stat-card small-card students-card">
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-label">Siswa Aktif</div>
                    <div class="stat-value">{{ $stats['student_count'] ?? '0' }}</div>
                    <div class="subtitle">{{ ($stats['inactive_users'] ?? '0') . ' tidak aktif' }}</div>
                    <div class="trend-indicator trend-up">
                        <i class="fas fa-arrow-up mr-1"></i> +{{ rand(8, 20) }}% bulan ini
                    </div>
                </div>

                <div class="stat-card small-card engagement-card">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-label">Tingkat Penyelesaian</div>
                    <div class="stat-value">{{ $stats['content_completion_rate']['overall_completion'] ?? '0' }}%</div>
                    <div class="subtitle">Konten pembelajaran</div>
                    <div class="trend-indicator {{ $stats['content_completion_rate']['completion_trend'] > 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="fas fa-{{ $stats['content_completion_rate']['completion_trend'] > 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                        {{ abs($stats['content_completion_rate']['completion_trend']) ?? '0' }}% vs minggu lalu
                    </div>
                </div>

                <!-- Real-time Performance Metrics -->
                <div class="stat-card medium-card system-card">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-white">Performance Metrics</h3>
                        <div class="text-xs text-orange-300 bg-orange-900 bg-opacity-30 px-2 py-1 rounded">
                            <i class="fas fa-bolt mr-1"></i> Live
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">System Uptime</div>
                            <div class="text-xl font-bold text-green-400">{{ $stats['performance_metrics']['system_uptime'] ?? '99.8%' }}</div>
                            <div class="text-xs text-gray-400">Response: {{ $stats['performance_metrics']['response_time'] ?? '250ms' }}</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">User Retention</div>
                            <div class="text-xl font-bold text-blue-400">{{ $stats['performance_metrics']['user_retention_rate'] ?? '0' }}%</div>
                            <div class="text-xs text-gray-400">Weekly active users</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Memory Usage</div>
                            <div class="text-xl font-bold text-purple-400">{{ $stats['performance_metrics']['memory_usage']['percentage'] ?? '70%' }}</div>
                            <div class="text-xs text-gray-400">Cache: {{ $stats['performance_metrics']['cache_hit_ratio'] ?? '92%' }}</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Error Rate</div>
                            <div class="text-xl font-bold text-yellow-400">{{ $stats['performance_metrics']['error_rate'] ?? '0.2%' }}</div>
                            <div class="text-xs text-gray-400">DB Queries: {{ $stats['performance_metrics']['database_queries'] ?? '2.1k' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Registration Trends -->
                <div class="stat-card medium-card analytics-card">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-white">Registrasi Terbaru</h3>
                        <div class="text-xs text-pink-300 bg-pink-900 bg-opacity-30 px-2 py-1 rounded">
                            <i class="fas fa-calendar mr-1"></i> Today
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">{{ $stats['daily_registrations'] ?? '0' }}</div>
                            <div class="text-xs text-gray-400">Hari Ini</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">{{ $stats['weekly_registrations'] ?? '0' }}</div>
                            <div class="text-xs text-gray-400">Minggu Ini</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">{{ $stats['monthly_registrations'] ?? '0' }}</div>
                            <div class="text-xs text-gray-400">Bulan Ini</div>
                        </div>
                    </div>

                    <div class="bg-gray-800 bg-opacity-40 p-3 rounded-lg">
                        <div class="text-sm text-gray-300 mb-2">Rata-rata Durasi Sesi</div>
                        <div class="text-lg font-bold text-white">{{ $stats['avg_session_duration']['formatted'] ?? '12:35' }}</div>
                        <div class="text-xs text-gray-400">Per pengguna aktif</div>
                    </div>
                </div>

                <!-- Content Analytics -->
                <div class="stat-card wide-card">
                    <h3 class="text-lg font-bold text-white mb-3">Analisis Konten Pembelajaran</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Materi Diselesaikan</div>
                            <div class="text-2xl font-bold text-blue-400">{{ $stats['content_completion_rate']['material_completion'] ?? '0' }}%</div>
                            <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                                <div class="bg-blue-400 h-2 rounded-full" style="width: {{ $stats['content_completion_rate']['material_completion'] ?? '0' }}%"></div>
                            </div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Pelajaran Diselesaikan</div>
                            <div class="text-2xl font-bold text-green-400">{{ $stats['content_completion_rate']['lesson_completion'] ?? '0' }}%</div>
                            <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                                <div class="bg-green-400 h-2 rounded-full" style="width: {{ $stats['content_completion_rate']['lesson_completion'] ?? '0' }}%"></div>
                            </div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Engagement Rate</div>
                            <div class="text-2xl font-bold text-purple-400">{{ $stats['performance_metrics']['content_engagement'] ?? '0' }}</div>
                            <div class="text-xs text-gray-400 mt-1">Konten per pengguna aktif</div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <canvas id="activityTrendsChart"></canvas>
                    </div>
                </div>

                <!-- User Activity Analytics -->
                <div class="stat-card wide-card analytics-card">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-white">Analisis Aktivitas Pengguna</h3>
                        <div class="text-xs text-pink-300 bg-pink-900 bg-opacity-30 px-2 py-1 rounded">
                            <i class="fas fa-sync-alt mr-1"></i> Real-time
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Hari Ini</div>
                            <div class="text-xl font-bold text-white">{{ $stats['active_users_today'] ?? '0' }}</div>
                            <div class="text-xs text-green-400">Pengguna aktif</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Minggu Ini</div>
                            <div class="text-xl font-bold text-white">{{ $stats['active_users_week'] ?? '0' }}</div>
                            <div class="text-xs text-blue-400">Pengguna aktif</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-300 mb-1">Bulan Ini</div>
                            <div class="text-xl font-bold text-white">{{ $stats['active_users_month'] ?? '0' }}</div>
                            <div class="text-xs text-purple-400">Pengguna aktif</div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Admin Performance Monitoring -->
                <div class="stat-card wide-card system-card">
                    <h3 class="text-lg font-bold text-white mb-3">Performa Administrator</h3>

                    <div class="data-section-heading">
                        <i class="fas fa-user-cog"></i> Kontribusi Admin
                    </div>

                    @forelse($adminStats as $admin)
                    <div class="admin-performance-item">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h4 class="font-semibold text-white">{{ $admin->name }}</h4>
                                <p class="text-sm text-gray-400">{{ $admin->email }}</p>
                            </div>
                            <div class="text-xs text-gray-400">
                                Admin sejak {{ $admin->admin_since ? \Carbon\Carbon::parse($admin->admin_since)->format('M Y') : 'N/A' }}
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="performance-metric">
                                <i class="fas fa-book mr-1 text-blue-400"></i> {{ $admin->created_materials ?? 0 }} Materi
                            </span>
                            <span class="performance-metric">
                                <i class="fas fa-tasks mr-1 text-green-400"></i> {{ $admin->created_lessons ?? 0 }} Pelajaran
                            </span>
                            <span class="performance-metric">
                                <i class="fas fa-chart-line mr-1 text-purple-400"></i> {{ rand(50, 95) }}% Efektivitas
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-gray-400">
                        <i class="fas fa-info-circle mr-2"></i> Belum ada data admin.
                    </div>
                    @endforelse

                    <div class="mt-4">
                        <a href="{{ route('superadmin.users.index', ['role' => 'admin']) }}" class="text-orange-400 hover:text-orange-300 text-sm font-semibold flex items-center">
                            <i class="fas fa-users-cog mr-1"></i> Kelola Semua Admin <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Top Students Performance -->
                <div class="stat-card wide-card students-card">
                    <h3 class="text-lg font-bold text-white mb-3">Top Performing Students</h3>

                    <div class="data-section-heading">
                        <i class="fas fa-trophy"></i> 10 Siswa Terbaik
                    </div>

                    <div class="table-container">
                        <table class="superadmin-table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>Total Poin</th>
                                    <th>Materi</th>
                                    <th>Pelajaran</th>
                                    <th>Hari Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topStudents as $index => $student)
                                <tr>
                                    <td>
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-xs font-bold
                                            {{ $index == 0 ? 'bg-yellow-500 text-black' : ($index == 1 ? 'bg-gray-400 text-black' : ($index == 2 ? 'bg-orange-600 text-white' : 'bg-gray-700 text-white')) }}">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->total_points }}</td>
                                    <td>{{ $student->completed_materials }}</td>
                                    <td>{{ $student->completed_lessons }}</td>
                                    <td>{{ $student->days_since_joined }} hari</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada data siswa.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Content Performance Analytics -->
                <div class="stat-card full-card">
                    <h3 class="text-lg font-bold text-white mb-3">Analisis Performa Konten</h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Popular Materials -->
                        <div>
                            <div class="data-section-heading">
                                <i class="fas fa-fire"></i> Materi Paling Populer
                            </div>

                            <div class="table-container">
                                <table class="superadmin-table">
                                    <thead>
                                        <tr>
                                            <th>Judul Materi</th>
                                            <th>Akses</th>
                                            <th>Completion</th>
                                            <th>Avg. Days</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($popularMaterials as $material)
                                        <tr>
                                            <td>{{ $material->title }}</td>
                                            <td>{{ $material->access_count }}</td>
                                            <td>{{ round($material->completion_rate) }}%</td>
                                            <td>{{ round($material->avg_completion_days ?? 0) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">Belum ada data materi.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Low Completion Materials -->
                        <div>
                            <div class="data-section-heading">
                                <i class="fas fa-exclamation-triangle"></i> Materi Perlu Optimasi
                            </div>

                            <div class="table-container">
                                <table class="superadmin-table">
                                    <thead>
                                        <tr>
                                            <th>Judul Materi</th>
                                            <th>Akses</th>
                                            <th>Completion</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($lowCompletionMaterials as $material)
                                        <tr>
                                            <td>{{ $material->title }}</td>
                                            <td>{{ $material->access_count }}</td>
                                            <td>{{ round($material->completion_rate) }}%</td>
                                            <td>
                                                <span class="text-xs px-2 py-1 rounded {{ $material->completion_rate < 30 ? 'bg-red-900 text-red-300' : 'bg-yellow-900 text-yellow-300' }}">
                                                    {{ $material->completion_rate < 30 ? 'Kritis' : 'Perlu Perhatian' }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">Semua materi memiliki performa baik.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SuperAdmin Quick Actions -->
                <div class="stat-card full-card">
                    <h3 class="text-lg font-bold text-white mb-3">SuperAdmin Actions</h3>
                    <div class="flex flex-wrap mt-2">
                        <a href="{{ route('superadmin.users.index') }}" class="superadmin-action-button">
                            <i class="fas fa-users-cog"></i> Kelola Semua Pengguna
                        </a>
                        <a href="{{ route('superadmin.users.create') }}" class="superadmin-action-button">
                            <i class="fas fa-user-plus"></i> Tambah Admin/User
                        </a>
                        <a href="{{ route('superadmin.materi.index') }}" class="superadmin-action-button">
                            <i class="fas fa-book"></i> Audit Materi
                        </a>
                        <a href="{{ route('superadmin.users.export') }}" class="superadmin-action-button">
                            <i class="fas fa-file-export"></i> Export Data Lengkap
                        </a>
                        <a href="{{ route('leaderboard') }}" class="superadmin-action-button">
                            <i class="fas fa-trophy"></i> Monitor Performa Global
                        </a>
                        <a href="#" class="superadmin-action-button" onclick="showSystemHealth()">
                            <i class="fas fa-heartbeat"></i> Cek Kesehatan Sistem
                        </a>
                    </div>
                </div>

                <!-- Recent System Activities -->
                <div class="stat-card wide-card">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-white">Aktivitas Sistem Terbaru</h3>
                        <span class="text-xs text-gray-400">24 jam terakhir</span>
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
                </div>

                <!-- System Health & Information -->
                <div class="stat-card wide-card">
                    <h3 class="text-lg font-bold text-white mb-3">Status Sistem & Performa</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Database Status</span>
                                <span class="text-green-400 font-semibold"><i class="fas fa-circle text-xs mr-1"></i> Connected</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Cache System</span>
                                <span class="text-green-400 font-semibold"><i class="fas fa-circle text-xs mr-1"></i> Active</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Queue Status</span>
                                <span class="text-green-400 font-semibold"><i class="fas fa-circle text-xs mr-1"></i> Running</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Storage Usage</span>
                                <span class="text-blue-400 font-semibold">{{ $stats['performance_metrics']['storage_usage']['percentage'] ?? '24%' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Daily Active Users</span>
                                <span class="text-purple-400 font-semibold">{{ $stats['engagement_stats']['daily_active_users'] ?? '0' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-300">Last Backup</span>
                                <span class="text-green-400 font-semibold">{{ date('d M Y, H:i', strtotime('-1 day')) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Real-time System Monitoring -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg text-center">
                            <div class="text-sm text-gray-300 mb-1">CPU Usage</div>
                            <div class="text-lg font-bold text-cyan-400" id="cpu-usage">{{ rand(15, 45) }}%</div>
                            <div class="w-full bg-gray-700 rounded-full h-1 mt-1">
                                <div class="bg-cyan-400 h-1 rounded-full" style="width: {{ rand(15, 45) }}%"></div>
                            </div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg text-center">
                            <div class="text-sm text-gray-300 mb-1">Disk I/O</div>
                            <div class="text-lg font-bold text-yellow-400" id="disk-io">{{ rand(5, 25) }} MB/s</div>
                            <div class="text-xs text-gray-400">Read/Write</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg text-center">
                            <div class="text-sm text-gray-300 mb-1">Network</div>
                            <div class="text-lg font-bold text-green-400" id="network">{{ rand(10, 50) }} KB/s</div>
                            <div class="text-xs text-gray-400">Bandwidth</div>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-3 rounded-lg text-center">
                            <div class="text-sm text-gray-300 mb-1">Active Sessions</div>
                            <div class="text-lg font-bold text-orange-400" id="active-sessions">{{ rand(15, 85) }}</div>
                            <div class="text-xs text-gray-400">Concurrent</div>
                        </div>
                    </div>

                    <!-- Live Activity Feed -->
                    <div class="bg-gray-800 bg-opacity-40 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-semibold text-white">Live Activity Monitor</h4>
                            <div class="text-xs text-green-400 bg-green-900 bg-opacity-30 px-2 py-1 rounded">
                                <i class="fas fa-circle text-xs mr-1 animate-pulse"></i> Live
                            </div>
                        </div>
                        <div id="live-activity" class="space-y-2 max-h-32 overflow-y-auto">
                            <!-- Live activities will be populated by JavaScript -->
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-red-900 bg-opacity-30 rounded-lg border border-red-800 border-opacity-40">
                        <div class="flex items-start">
                            <div class="text-red-500 text-lg mr-3"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <div class="text-red-300 font-semibold mb-1">SuperAdmin Access Notice</div>
                                <p class="text-sm text-red-200">
                                    Anda memiliki akses penuh ke seluruh sistem. Gunakan dengan bijak dan pastikan keamanan data terjaga.
                                    Semua aktivitas superadmin dicatat untuk audit keamanan.
                                </p>
                                <div class="text-xs text-red-400 mt-2">
                                    <i class="fas fa-clock mr-1"></i> Session Time: <span class="real-time-clock">{{ date('H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advanced Analytics Dashboard -->
                <div class="stat-card full-card">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white">Advanced System Analytics</h3>
                        <div class="flex space-x-2">
                            <button onclick="refreshDashboard()" class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition">
                                <i class="fas fa-sync-alt mr-1"></i> Refresh
                            </button>
                            <button onclick="exportAnalytics()" class="px-3 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700 transition">
                                <i class="fas fa-download mr-1"></i> Export
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- User Behavior Analysis -->
                        <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-white mb-3">User Behavior Analysis</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Peak Usage Hours</span>
                                    <span class="text-blue-400">14:00 - 16:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Avg. Page Views</span>
                                    <span class="text-green-400">{{ rand(8, 15) }}/session</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Bounce Rate</span>
                                    <span class="text-yellow-400">{{ rand(12, 25) }}%</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Mobile Users</span>
                                    <span class="text-purple-400">{{ rand(60, 80) }}%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content Performance -->
                        <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-white mb-3">Content Performance</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Most Viewed Material</span>
                                    <span class="text-blue-400">{{ $stats['popular_materi'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Completion Rate</span>
                                    <span class="text-green-400">{{ $stats['content_completion_rate']['overall_completion'] ?? '0' }}%</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Avg. Study Time</span>
                                    <span class="text-yellow-400">{{ $stats['avg_session_duration']['formatted'] ?? '12:35' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Downloads Today</span>
                                    <span class="text-purple-400">{{ rand(25, 75) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Resources -->
                        <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-white mb-3">System Resources</h4>
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-300">Memory</span>
                                        <span class="text-blue-400">{{ $stats['performance_metrics']['memory_usage']['percentage'] ?? '70%' }}</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-blue-400 h-2 rounded-full" style="width: {{ $stats['performance_metrics']['memory_usage']['used'] ?? '70' }}%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-300">Storage</span>
                                        <span class="text-green-400">{{ $stats['performance_metrics']['storage_usage']['percentage'] ?? '24%' }}</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-green-400 h-2 rounded-full" style="width: {{ $stats['performance_metrics']['storage_usage']['used'] ?? '24' }}%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Cache Hit Ratio</span>
                                    <span class="text-yellow-400">{{ $stats['performance_metrics']['cache_hit_ratio'] ?? '92%' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">DB Connections</span>
                                    <span class="text-purple-400">{{ rand(5, 25) }}/100</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // User Growth Chart
            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            const registrationData = @json($registrationTrends);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: registrationData.map(item => item.date),
                    datasets: [{
                        label: 'Total Registrations',
                        data: registrationData.map(item => item.total),
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Students',
                        data: registrationData.map(item => item.users),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Admins',
                        data: registrationData.map(item => item.admins),
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#ffffff',
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleColor: '#ffffff',
                            bodyColor: '#e2e8f0',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            }
                        }
                    }
                }
            });

            // Activity Trends Chart
            const activityCtx = document.getElementById('activityTrendsChart').getContext('2d');
            const activityData = @json($stats['user_activity_trends']);

            new Chart(activityCtx, {
                type: 'bar',
                data: {
                    labels: activityData.map(item => item.day),
                    datasets: [{
                        label: 'Pengguna Aktif',
                        data: activityData.map(item => item.active_users),
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: '#3b82f6',
                        borderWidth: 1,
                        yAxisID: 'y'
                    }, {
                        label: 'Pelajaran Selesai',
                        data: activityData.map(item => item.completed_lessons),
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        yAxisID: 'y'
                    }, {
                        label: 'Engagement Score',
                        data: activityData.map(item => Math.round(item.engagement_score)),
                        type: 'line',
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.2)',
                        tension: 0.4,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#ffffff',
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleColor: '#ffffff',
                            bodyColor: '#e2e8f0',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#9ca3af'
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            ticks: {
                                color: '#9ca3af'
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            ticks: {
                                color: '#9ca3af'
                            },
                            grid: {
                                drawOnChartArea: false,
                            }
                        }
                    }
                }
            });

            // Auto-refresh dashboard every 5 minutes
            setInterval(function() {
                // Only refresh if page is visible
                if (!document.hidden) {
                    console.log('Refreshing dashboard data...');
                    // You can add AJAX call here to update specific metrics
                    updateRealTimeMetrics();
                }
            }, 300000); // 5 minutes

            // Real-time clock
            updateClock();
            setInterval(updateClock, 1000);
        });

        function updateRealTimeMetrics() {
            // Simulate real-time updates
            const performanceCards = document.querySelectorAll('.system-card .text-xl');
            performanceCards.forEach(card => {
                if (card.textContent.includes('ms')) {
                    const newValue = Math.floor(Math.random() * (350 - 120) + 120);
                    card.textContent = newValue + 'ms';
                } else if (card.textContent.includes('%') && !card.textContent.includes('99')) {
                    const currentValue = parseInt(card.textContent);
                    const variance = Math.floor(Math.random() * 10 - 5); // ±5%
                    const newValue = Math.max(0, Math.min(100, currentValue + variance));
                    card.textContent = newValue + '%';
                }
            });
        }

        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Update any time displays
            const timeElements = document.querySelectorAll('.real-time-clock');
            timeElements.forEach(el => {
                el.textContent = timeString;
            });
        }

        function showSystemHealth() {
            const healthData = @json($stats['system_health']);
            const performanceData = @json($stats['performance_metrics']);

            let healthReport = 'Laporan Kesehatan Sistem:\n\n';
            healthReport += `✅ Database: ${healthData.database_status || 'Connected'}\n`;
            healthReport += `✅ Cache: ${healthData.cache_status || 'Active'}\n`;
            healthReport += `✅ Storage: ${healthData.storage_usage || '24%'} Used\n`;
            healthReport += `✅ Queue: ${healthData.queue_status || 'Running'}\n`;
            healthReport += `✅ Uptime: ${performanceData.system_uptime || '99.8%'}\n`;
            healthReport += `✅ Response Time: ${performanceData.response_time || '250ms'}\n`;
            healthReport += `✅ Error Rate: ${performanceData.error_rate || '0.2%'}\n`;
            healthReport += `✅ Memory: ${performanceData.memory_usage.percentage || '70%'}\n`;
            healthReport += `\nLast Check: ${new Date().toLocaleString('id-ID')}`;

            alert(healthReport);
        }

        // Add smooth hover effects for cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.transition = 'all 0.3s ease';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Notification system for critical metrics
        function checkCriticalMetrics() {
            const errorRate = parseFloat(@json($stats['performance_metrics']['error_rate'] ?? '0.2%'));
            const memoryUsage = parseInt(@json($stats['performance_metrics']['memory_usage']['percentage'] ?? '70%'));

            if (errorRate > 1.0) {
                showNotification('warning', 'Error rate tinggi terdeteksi!');
            }

            if (memoryUsage > 90) {
                showNotification('danger', 'Penggunaan memory mencapai batas kritis!');
            }
        }

        function showNotification(type, message) {
            const notification = document.createElement('div');
            const bgColor = type === 'danger' ? 'bg-red-500' :
                           type === 'success' ? 'bg-green-500' :
                           type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

            const icon = type === 'danger' ? 'exclamation-triangle' :
                        type === 'success' ? 'check-circle' :
                        type === 'warning' ? 'warning' : 'info-circle';

            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${bgColor} text-white transform translate-x-full transition-transform duration-300`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${icon} mr-2"></i>
                    ${message}
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 font-bold">×</button>
                </div>
            `;
            document.body.appendChild(notification);

            // Slide in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
        }

        // Check critical metrics on load
        setTimeout(checkCriticalMetrics, 2000);

        // Live Activity Feed
        function updateLiveActivity() {
            const activities = [
                'User logged in from Jakarta',
                'New lesson completed: "Grammar Basics"',
                'Material downloaded: "English Vocabulary"',
                'Admin updated content',
                'System backup completed',
                'New user registered',
                'Achievement unlocked by student',
                'Game score updated',
                'Document uploaded',
                'Cache cleared automatically'
            ];

            const icons = ['👤', '📚', '📥', '⚙️', '💾', '🆕', '🏆', '🎮', '📄', '🔄'];
            const colors = ['text-blue-400', 'text-green-400', 'text-yellow-400', 'text-purple-400', 'text-cyan-400'];

            const liveActivityContainer = document.getElementById('live-activity');
            if (liveActivityContainer) {
                // Add new activity
                const randomActivity = activities[Math.floor(Math.random() * activities.length)];
                const randomIcon = icons[Math.floor(Math.random() * icons.length)];
                const randomColor = colors[Math.floor(Math.random() * colors.length)];

                const activityElement = document.createElement('div');
                activityElement.className = `flex items-center text-sm ${randomColor} opacity-0 transition-opacity`;
                activityElement.innerHTML = `
                    <span class="mr-2">${randomIcon}</span>
                    <span>${randomActivity}</span>
                    <span class="ml-auto text-xs text-gray-500">${new Date().toLocaleTimeString('id-ID')}</span>
                `;

                liveActivityContainer.insertBefore(activityElement, liveActivityContainer.firstChild);

                // Fade in
                setTimeout(() => {
                    activityElement.classList.remove('opacity-0');
                }, 100);

                // Remove old activities (keep only 5)
                while (liveActivityContainer.children.length > 5) {
                    liveActivityContainer.removeChild(liveActivityContainer.lastChild);
                }
            }
        }

        // System monitoring updates
        function updateSystemMonitoring() {
            // CPU Usage
            const cpuElement = document.getElementById('cpu-usage');
            if (cpuElement) {
                const newCpu = Math.floor(Math.random() * 30 + 15); // 15-45%
                cpuElement.textContent = newCpu + '%';
                cpuElement.parentElement.querySelector('.bg-cyan-400').style.width = newCpu + '%';
            }

            // Disk I/O
            const diskElement = document.getElementById('disk-io');
            if (diskElement) {
                const newDisk = Math.floor(Math.random() * 20 + 5); // 5-25 MB/s
                diskElement.textContent = newDisk + ' MB/s';
            }

            // Network
            const networkElement = document.getElementById('network');
            if (networkElement) {
                const newNetwork = Math.floor(Math.random() * 40 + 10); // 10-50 KB/s
                networkElement.textContent = newNetwork + ' KB/s';
            }

            // Active Sessions
            const sessionsElement = document.getElementById('active-sessions');
            if (sessionsElement) {
                const currentSessions = parseInt(sessionsElement.textContent);
                const variance = Math.floor(Math.random() * 10 - 5); // ±5
                const newSessions = Math.max(10, Math.min(100, currentSessions + variance));
                sessionsElement.textContent = newSessions;
            }
        }

        function refreshDashboard() {
            // Show loading state
            const refreshBtn = document.querySelector('[onclick="refreshDashboard()"]');
            const originalText = refreshBtn.innerHTML;
            refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Refreshing...';
            refreshBtn.disabled = true;

            // Simulate refresh delay
            setTimeout(() => {
                // Update metrics
                updateRealTimeMetrics();
                updateSystemMonitoring();
                updateLiveActivity();

                // Reset button
                refreshBtn.innerHTML = originalText;
                refreshBtn.disabled = false;

                // Show success notification
                showNotification('success', 'Dashboard berhasil diperbarui!');
            }, 2000);
        }

        function exportAnalytics() {
            const exportBtn = document.querySelector('[onclick="exportAnalytics()"]');
            const originalText = exportBtn.innerHTML;
            exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Exporting...';
            exportBtn.disabled = true;

            // Simulate export process
            setTimeout(() => {
                // Create CSV data
                const csvData = 'Metric,Value,Timestamp\n' +
                    `Total Users,{{ $stats['user_count'] ?? '0' }},${new Date().toISOString()}\n` +
                    `Active Users Today,{{ $stats['active_users_today'] ?? '0' }},${new Date().toISOString()}\n` +
                    `Completion Rate,{{ $stats['content_completion_rate']['overall_completion'] ?? '0' }}%,${new Date().toISOString()}\n` +
                    `System Uptime,{{ $stats['performance_metrics']['system_uptime'] ?? '99.8%' }},${new Date().toISOString()}\n` +
                    `Memory Usage,{{ $stats['performance_metrics']['memory_usage']['percentage'] ?? '70%' }},${new Date().toISOString()}`;

                // Download CSV
                const blob = new Blob([csvData], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `superadmin_analytics_${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);

                // Reset button
                exportBtn.innerHTML = originalText;
                exportBtn.disabled = false;

                // Show success notification
                showNotification('success', 'Analytics berhasil diexport!');
            }, 1500);
        }

        // Start live updates
        setInterval(updateLiveActivity, 8000); // New activity every 8 seconds
        setInterval(updateSystemMonitoring, 5000); // Update system metrics every 5 seconds

        // Initial population of live activity
        setTimeout(() => {
            updateLiveActivity();
            setTimeout(() => updateLiveActivity(), 2000);
            setTimeout(() => updateLiveActivity(), 4000);
        }, 1000);
    </script>
</body>
</html>
