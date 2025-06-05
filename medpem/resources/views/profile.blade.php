<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Media Pembelajaran</title>
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
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
            z-index: 1;
            pointer-events: auto;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #1EC38B;
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
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 0.5rem;
            border-radius: 8px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            font-weight: 600;
        }

        /* Mobile styling */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 90px;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .content-title {
                font-size: 2.5rem;
                padding: 0.4rem 1.5rem;
            }

            .subtitle {
                font-size: 1.1rem;
                padding: 0.4rem;
            }

            .gradient-border {
                margin-bottom: 1.5rem;
                height: 3px;
            }
        }

        @media (max-width: 480px) {
            .content-title {
                font-size: 2rem;
                padding: 0.3rem 1rem;
            }

            .subtitle {
                font-size: 1rem;
                padding: 0.3rem;
            }

            .gradient-border {
                margin-bottom: 1rem;
                height: 3px;
            }
        }

        @media (max-width: 640px) {
            .content-title {
                font-size: 1.8rem;
                padding: 0.25rem 0.75rem;
            }

            .subtitle {
                font-size: 0.9rem;
                padding: 0.25rem 0.5rem;
            }
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: none;
            background: #1EC38B;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            color: #1e293b;
        }

        .profile-header {
            background: linear-gradient(135deg, #1EC38B, #0891b2);
            padding: 2rem;
            position: relative;
            text-align: center;
        }

        @media (max-width: 768px) {
            .profile-header {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .profile-header {
                padding: 1rem;
            }
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            background-size: cover;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .profile-avatar {
                width: 120px;
                height: 120px;
                border: 4px solid white;
            }
        }

        @media (max-width: 480px) {
            .profile-avatar {
                width: 100px;
                height: 100px;
                border: 3px solid white;
            }
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 800;
            margin-top: 1rem;
            color: white;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .profile-name {
                font-size: 1.8rem;
                margin-top: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .profile-name {
                font-size: 1.5rem;
                margin-top: 0.6rem;
            }
        }

        .profile-username {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.25rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .profile-username {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .profile-username {
                font-size: 0.9rem;
            }
        }

        .profile-role {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 2rem;
            font-size: 0.875rem;
            color: white;
            font-weight: 600;
            margin-top: 0.75rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .profile-role {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .profile-role {
                padding: 0.3rem 0.6rem;
                font-size: 0.75rem;
            }
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 1px;
            background-color: #e5e7eb;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 480px) {
            .profile-stats {
                grid-template-columns: 1fr;
                margin-bottom: 1rem;
            }
        }

        .profile-stat {
            background-color: white;
            padding: 1.5rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .profile-stat {
                padding: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .profile-stat {
                padding: 1rem;
            }
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1EC38B;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .stat-value {
                font-size: 1.3rem;
            }
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .stat-label {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .stat-label {
                font-size: 0.75rem;
            }
        }

        .profile-section {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .profile-section {
                padding: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .profile-section {
                padding: 1rem;
            }
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1e293b;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 1.1rem;
                margin-bottom: 0.8rem;
                padding-bottom: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 1rem;
                margin-bottom: 0.6rem;
                padding-bottom: 0.3rem;
            }
        }

        .section-title i {
            margin-right: 0.75rem;
            color: #1EC38B;
        }

        .progress-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 1rem;
            margin-top: 1.25rem;
        }

        @media (max-width: 768px) {
            .progress-items {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                grid-gap: 0.8rem;
                margin-top: 1rem;
            }
        }

        @media (max-width: 480px) {
            .progress-items {
                grid-template-columns: 1fr;
                grid-gap: 0.6rem;
                margin-top: 0.8rem;
            }
        }

        .progress-item {
            background-color: #f8fafc;
            border-radius: 0.75rem;
            padding: 1rem;
            border-left: 4px solid #1EC38B;
            transition: all 0.2s;
        }

        @media (max-width: 768px) {
            .progress-item {
                padding: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .progress-item {
                padding: 0.6rem;
            }
        }

        .progress-item-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        @media (max-width: 768px) {
            .progress-item-title {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .progress-item-title {
                font-size: 0.85rem;
                margin-bottom: 0.3rem;
            }
        }

        .progress-bar-bg {
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 4px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(to right, #1EC38B, #10b981);
            border-radius: 4px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .progress-info {
                font-size: 0.7rem;
                flex-direction: column;
                gap: 0.2rem;
            }
        }

        @media (max-width: 480px) {
            .progress-info {
                font-size: 0.65rem;
            }
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            grid-gap: 1rem;
            margin-top: 1.25rem;
        }

        @media (max-width: 768px) {
            .achievements-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                grid-gap: 0.8rem;
                margin-top: 1rem;
            }
        }

        @media (max-width: 480px) {
            .achievements-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                grid-gap: 0.6rem;
                margin-top: 0.8rem;
            }
        }

        .achievement-item {
            background-color: #f8fafc;
            border-radius: 0.75rem;
            padding: 1.25rem 1rem;
            text-align: center;
            transition: all 0.2s;
        }

        @media (max-width: 768px) {
            .achievement-item {
                padding: 1rem 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-item {
                padding: 0.8rem 0.6rem;
            }
        }

        .achievement-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .achievement-item:hover {
                transform: translateY(-2px);
            }
        }

        .achievement-icon {
            width: 3.5rem;
            height: 3.5rem;
            background: linear-gradient(135deg, #1EC38B, #10b981);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem auto;
            color: white;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .achievement-icon {
                width: 3rem;
                height: 3rem;
                font-size: 1.3rem;
                margin-bottom: 0.6rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-icon {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
            }
        }

        .achievement-title {
            font-weight: 700;
            font-size: 0.875rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .achievement-title {
                font-size: 0.8rem;
                margin-bottom: 0.2rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-title {
                font-size: 0.75rem;
                margin-bottom: 0.15rem;
            }
        }

        .achievement-date {
            font-size: 0.75rem;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .achievement-date {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-date {
                font-size: 0.65rem;
            }
        }

        .locked-achievement .achievement-icon {
            background: linear-gradient(135deg, #9ca3af, #6b7280);
        }

        .locked-achievement {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-4 md:p-6">
            <div class="container mx-auto max-w-5xl px-2 md:px-0">
                <h1 class="content-title">Profil Saya</h1>
                <div class="subtitle">Selamat datang di halaman profil Anda</div>
                <div class="gradient-border"></div>

                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar" style="background-image: url('https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff&size=256')"></div>
                        <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                        <div class="profile-username">{{ Auth::user()->username }}</div>
                        <div class="profile-role">
                            <i class="fas {{ Auth::user()->role === 'superadmin' ? 'fa-crown' : (Auth::user()->role === 'admin' ? 'fa-user-shield' : 'fa-user') }} mr-1"></i>
                            {{ ucfirst(Auth::user()->role) }}
                        </div>
                    </div>

                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="stat-value">{{ Auth::user()->total_points ?? 0 }}</div>
                            <div class="stat-label">Total Poin</div>
                        </div>
                        <div class="profile-stat">
                            <div class="stat-value">{{ Auth::user()->lessons->where('pivot.completed', true)->count() }}</div>
                            <div class="stat-label">Pelajaran Selesai</div>
                        </div>
                        <div class="profile-stat">
                            <div class="stat-value">{{ Auth::user()->materi->where('pivot.completed', true)->count() }}</div>
                            <div class="stat-label">Materi Selesai</div>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h3 class="section-title"><i class="fas fa-book-open"></i> Progress Pembelajaran</h3>
                        <p class="text-gray-600 text-sm md:text-base">Berikut adalah progres pembelajaran Anda saat ini:</p>

                        <div class="progress-items">
                            @forelse(Auth::user()->lessons as $lesson)
                            <div class="progress-item">
                                <div class="progress-item-title">{{ $lesson->title }}</div>
                                <div class="text-xs text-gray-500">
                                    <i class="fas {{ $lesson->pivot->completed ? 'fa-check-circle text-green-500' : 'fa-clock text-yellow-500' }} mr-1"></i>
                                    {{ $lesson->pivot->completed ? 'Selesai' : 'Dalam progres' }}
                                </div>
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width: {{ $lesson->pivot->progress }}%"></div>
                                </div>
                                <div class="progress-info">
                                    <span>Progress: {{ $lesson->pivot->progress }}%</span>
                                    <span>{{ $lesson->pivot->updated_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full text-center py-4 md:py-6 text-gray-500">
                                <i class="fas fa-info-circle mr-2"></i> Anda belum memulai pelajaran apapun
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="profile-section">
                        <h3 class="section-title"><i class="fas fa-info-circle"></i> Informasi Akun</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-4">
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <div class="bg-gray-50 px-3 md:px-4 py-2 md:py-3 rounded-lg border border-gray-200 text-sm md:text-base">
                                        {{ Auth::user()->name }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <div class="bg-gray-50 px-3 md:px-4 py-2 md:py-3 rounded-lg border border-gray-200 text-sm md:text-base">
                                        {{ Auth::user()->username }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Peran Pengguna</label>
                                    <div class="bg-gray-50 px-3 md:px-4 py-2 md:py-3 rounded-lg border border-gray-200 text-sm md:text-base">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Bergabung</label>
                                    <div class="bg-gray-50 px-3 md:px-4 py-2 md:py-3 rounded-lg border border-gray-200 text-sm md:text-base">
                                        {{ Auth::user()->created_at->format('d F Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
