<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pencapaian | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .main-content {
            min-height: calc(100vh - 70px);
            margin-left: 250px;
            padding-top: 80px;
            padding-bottom: 1rem;
            transition: all 0.3s;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #14b8a6;
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
            background: #14b8a6;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('sidebar')
    @include('header')

    <div class="main-content">
        <div class="px-4 py-6 mx-auto">
            <h1 class="content-title">Detail Pencapaian</h1>
            <div class="subtitle">Informasi lengkap tentang pencapaian</div>
            <div class="gradient-border"></div>

            <div class="max-w-6xl mx-auto">
                <div class="mb-4">
                    <a href="{{ route('achievements.index') }}" class="text-teal-600 hover:text-teal-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Daftar Pencapaian
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden border {{ $achievement->is_unlocked ? 'border-green-500' : 'border-gray-300' }} max-w-3xl mx-auto">
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row items-center justify-center mb-6">
                            <div class="w-24 h-24 flex items-center justify-center rounded-full {{ $achievement->is_unlocked ? 'bg-green-100' : 'bg-gray-100' }} mb-4 md:mb-0 md:mr-6">
                                @if($achievement->is_unlocked)
                                    <span class="text-5xl">{{ $achievement->icon }}</span>
                                @else
                                    <span class="text-5xl text-gray-400">🔒</span>
                                @endif
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-center md:text-left">{{ $achievement->name }}</h1>
                                <p class="text-lg text-gray-600 mt-2 text-center md:text-left">{{ $achievement->description }}</p>
                            </div>
                        </div>

                        <div class="mb-6 p-4 rounded-lg {{ $achievement->is_unlocked ? 'bg-green-50' : 'bg-gray-50' }}">
                            <h2 class="text-xl font-semibold mb-2">Status</h2>
                            <div class="text-lg">
                                @if($achievement->is_unlocked)
                                    <div class="flex items-center text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Terbuka pada: {{ \Carbon\Carbon::parse($achievement->unlocked_at)->format('d M Y, H:i') }}</span>
                                    </div>
                                @else
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span>Belum Terbuka</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-2">Persyaratan</h2>
                            <div class="p-4 bg-blue-50 rounded-lg">
                                @if($achievement->type == 'lesson_completion')
                                    <p class="text-lg">Selesaikan {{ $achievement->requirement }} pelajaran</p>
                                @elseif($achievement->type == 'materi_completion')
                                    <p class="text-lg">Selesaikan {{ $achievement->requirement }} materi</p>
                                @elseif($achievement->type == 'points')
                                    <p class="text-lg">Kumpulkan {{ $achievement->requirement }} poin</p>
                                @elseif($achievement->type == 'streak')
                                    <p class="text-lg">Mencapai streak {{ $achievement->requirement }} hari</p>
                                @elseif($achievement->type == 'speed')
                                    <p class="text-lg">Selesaikan bagian dalam {{ $achievement->requirement }} detik atau kurang</p>
                                @elseif($achievement->type == 'bagian_completion')
                                    <p class="text-lg">Selesaikan {{ $achievement->requirement }} bagian pelajaran</p>
                                @elseif($achievement->type == 'belajar_singkat_materi')
                                    <p class="text-lg">Selesaikan {{ $achievement->requirement }} materi di Belajar Singkat</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold mb-2">Hadiah</h2>
                            <div class="p-4 bg-yellow-50 rounded-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-lg font-medium">{{ $achievement->points_reward }} poin</span>
                            </div>
                        </div>

                        @if(!$achievement->is_unlocked)
                            <div class="mt-8 text-center">
                                <p class="text-gray-600 italic">Teruslah belajar untuk membuka pencapaian ini!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
