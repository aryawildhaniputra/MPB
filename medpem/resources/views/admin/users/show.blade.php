<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna - {{ $user->name }} - Media Pembelajaran</title>
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
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #4f46e5;
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

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: none;
            background: #4f46e5;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
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

            .card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .property-list {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }

            .property-item {
                padding: 0.8rem;
            }

            .section-title {
                font-size: 1.1rem;
                margin-bottom: 1.2rem;
                padding-bottom: 0.4rem;
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

            .card {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .property-item {
                padding: 0.6rem;
            }

            .property-label {
                font-size: 0.8rem;
                margin-bottom: 0.2rem;
            }

            .property-value {
                font-size: 0.9rem;
            }

            .section-title {
                font-size: 1rem;
                margin-bottom: 1rem;
                padding-bottom: 0.3rem;
            }

            .btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
                width: 100%;
                margin-bottom: 0.5rem;
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

        .card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
        }

        .property-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            .property-list {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .property-item {
            padding: 1rem;
            background: #f7fafc;
            border-radius: 0.5rem;
            border-left: 4px solid #3b82f6;
        }

        .property-label {
            font-size: 0.875rem;
            color: #718096;
            margin-bottom: 0.25rem;
        }

        .property-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
        }

        .tag {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .tag {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
                margin-right: 0.3rem;
                margin-bottom: 0.3rem;
            }
        }

        @media (max-width: 480px) {
            .tag {
                padding: 0.15rem 0.3rem;
                font-size: 0.65rem;
                margin-right: 0.2rem;
                margin-bottom: 0.2rem;
            }
        }

        .tag-blue {
            background-color: #ebf5ff;
            color: #2563eb;
        }

        .tag-green {
            background-color: #ecfdf5;
            color: #059669;
        }

        .tag-purple {
            background-color: #f5f3ff;
            color: #7c3aed;
        }

        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            transition: all 0.15s ease-in-out;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-danger {
            background-color: #f56565;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #e53e3e;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-4 md:p-6">
            <div class="container mx-auto max-w-4xl px-2 md:px-0">
                <h1 class="content-title">Detail Pengguna</h1>
                <div class="subtitle">Informasi lengkap - {{ $user->name }}</div>
                <div class="gradient-border"></div>

                <!-- Back button -->
                <div class="mb-4 md:mb-6">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center text-blue-400 hover:text-blue-600 transition text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar pengguna
                    </a>
                </div>

                <!-- Alert for success/error messages -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 md:p-4 rounded-lg mb-4 md:mb-6 shadow text-sm md:text-base">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500 text-white p-3 md:p-4 rounded-lg mb-4 md:mb-6 shadow text-sm md:text-base">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    </div>
                @endif

                <!-- User info card -->
                <div class="card">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 md:mb-6 gap-3 md:gap-0">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <div>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $user->role === 'superadmin' ? 'bg-purple-100 text-purple-800' :
                                   ($user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>

                    <div class="section-title">Informasi Dasar</div>
                    <div class="property-list mb-4 md:mb-6">
                        <div class="property-item">
                            <div class="property-label">Username</div>
                            <div class="property-value">{{ $user->username }}</div>
                        </div>
                        <div class="property-item">
                            <div class="property-label">Peran</div>
                            <div class="property-value">{{ ucfirst($user->role) }}</div>
                        </div>
                        <div class="property-item">
                            <div class="property-label">Total Poin</div>
                            <div class="property-value">{{ $user->total_points ?? 0 }}</div>
                        </div>
                        <div class="property-item">
                            <div class="property-label">Tanggal Registrasi</div>
                            <div class="property-value">{{ $user->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    <!-- Learning Progress Section -->
                    <div class="section-title">Progress Pembelajaran</div>

                    <!-- Lessons -->
                    <div class="mb-4 md:mb-6">
                        <h3 class="text-base md:text-lg font-semibold text-gray-700 mb-3">Pelajaran ({{ $user->lessons->count() }})</h3>
                        @if($user->lessons->isEmpty())
                            <p class="text-gray-500 italic text-sm md:text-base">Pengguna belum mengakses pelajaran apapun.</p>
                        @else
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-4">
                                @foreach($user->lessons as $lesson)
                                    <div class="bg-gray-50 p-3 md:p-4 rounded-lg border border-gray-200">
                                        <div class="font-semibold text-gray-800 text-sm md:text-base">{{ $lesson->title }}</div>
                                        <div class="text-xs md:text-sm text-gray-500 mt-1">
                                            <span class="mr-2">
                                                <i class="fas fa-tasks"></i> Progress: {{ $lesson->pivot->progress ?? 0 }}%
                                            </span>
                                            <span>
                                                <i class="fas {{ $lesson->pivot->completed ? 'fa-check-circle text-green-500' : 'fa-clock text-yellow-500' }}"></i>
                                                {{ $lesson->pivot->completed ? 'Selesai' : 'Belum Selesai' }}
                                            </span>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-2">
                                            Terakhir diakses: {{ $lesson->pivot->updated_at->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Materi -->
                    <div class="mb-4 md:mb-6">
                        <h3 class="text-base md:text-lg font-semibold text-gray-700 mb-3">Materi ({{ $user->materi->count() }})</h3>
                        @if($user->materi->isEmpty())
                            <p class="text-gray-500 italic text-sm md:text-base">Pengguna belum mengakses materi apapun.</p>
                        @else
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-4">
                                @foreach($user->materi as $materi)
                                    <div class="bg-gray-50 p-3 md:p-4 rounded-lg border border-gray-200">
                                        <div class="font-semibold text-gray-800 text-sm md:text-base">{{ $materi->title }}</div>
                                        <div class="text-xs md:text-sm text-gray-500 mt-1">
                                            <span class="mr-2">
                                                <i class="fas fa-tasks"></i> Progress: {{ $materi->pivot->progress ?? 0 }}%
                                            </span>
                                            <span>
                                                <i class="fas {{ $materi->pivot->completed ? 'fa-check-circle text-green-500' : 'fa-clock text-yellow-500' }}"></i>
                                                {{ $materi->pivot->completed ? 'Selesai' : 'Belum Selesai' }}
                                            </span>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-2">
                                            Terakhir diakses: {{ $materi->pivot->last_accessed_at ? date('d M Y, H:i', strtotime($materi->pivot->last_accessed_at)) : 'Belum pernah' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Achievements -->
                    <div class="mb-4 md:mb-6">
                        <h3 class="text-base md:text-lg font-semibold text-gray-700 mb-3">Pencapaian ({{ $user->achievements->where('pivot.unlocked', true)->count() }})</h3>
                        @if($user->achievements->isEmpty())
                            <p class="text-gray-500 italic text-sm md:text-base">Pengguna belum mendapatkan pencapaian apapun.</p>
                        @else
                            <div class="flex flex-wrap gap-2">
                                @foreach($user->achievements as $achievement)
                                    <div class="tag {{ $achievement->pivot->unlocked ? 'tag-green' : 'tag-blue' }}">
                                        <i class="fas {{ $achievement->pivot->unlocked ? 'fa-trophy' : 'fa-lock' }} mr-1"></i>
                                        {{ $achievement->title }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col md:flex-row justify-between mt-6 md:mt-8 gap-3 md:gap-0">
                        @if(Auth::user()->role === 'superadmin' || (Auth::user()->role === 'admin' && $user->role === 'user'))
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary order-2 md:order-1">
                                <i class="fas fa-edit mr-2"></i> Edit Pengguna
                            </a>

                            @if(Auth::user()->id !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline order-1 md:order-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')">
                                        <i class="fas fa-trash mr-2"></i> Hapus Pengguna
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
