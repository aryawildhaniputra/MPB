<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background-color: #151b2e;
            color: #ffffff;
            /* background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f308.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4da.svg'); */
            background-size: 80px, 120px, 70px;
            background-position: top left, top right, bottom right;
            background-repeat: repeat, no-repeat, no-repeat;
            background-blend-mode: soft-light;
            background-opacity: 0.05;
            overflow-x: hidden;
        }

        /* Fix untuk header dropdown pada halaman materi */
        .header-dropdown-container, .duolingo-header, .user-avatar, #userAvatarControl, #avatarClickOverlay {
            z-index: 10000 !important;
            position: relative !important;
        }

        /* Pastikan user dropdown muncul di atas konten */
        #userDropdownDiv {
            z-index: 10001 !important;
        }

        /* Fix untuk main content yang mungkin menutupi header */
        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
            z-index: 1; /* Pastikan main content ada di bawah header */
            pointer-events: auto; /* Pastikan event mouse masih bisa melewati main content */
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #F25252;
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
            background: #7028E4;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        .card {
            transition: all 0.3s ease;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3), 0 6px 6px rgba(0, 0, 0, 0.23);
            position: relative;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(5px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            height: 100%; /* Make all cards the same height */
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-15px) rotate(2deg);
            box-shadow: 0 25px 30px rgba(0, 0, 0, 0.4), 0 15px 12px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .card-header {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 0 10px;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        .card-header-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 3rem;
            z-index: 1;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.4));
        }

        .card-body {
            padding: 1.5rem;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            margin-top: -20px;
            position: relative;
            background-color: rgba(255, 255, 255, 0.9);
            color: #1e293b;
            display: flex;
            flex-direction: column;
            flex: 1; /* Take up all available space */
        }

        .admin-badge {
            background: linear-gradient(45deg, #3B82F6, #1D4ED8);
            color: white;
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 6px;
            margin-left: 8px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }

        .admin-badge i {
            margin-right: 4px;
            font-size: 0.8rem;
        }

        .action-buttons-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
        }

        .action-wrapper {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-wrapper form {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Style all direct children the same */
        .action-buttons-container > * {
            display: block;
        }

        .action-button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: none;
            line-height: 1;
            padding: 0;
            margin: 0;
        }

        .action-button i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .action-button:hover {
            transform: scale(1.15);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .action-button.edit-button {
            background: linear-gradient(145deg, #3B82F6, #2563EB);
        }

        .action-button.view-button {
            background: linear-gradient(145deg, #10B981, #059669);
        }

        .action-button.delete-button {
            background: linear-gradient(145deg, #EF4444, #DC2626);
        }

        .search-container {
            position: relative;
            max-width: none;
            margin: 0;
            width: 100%;
        }

        .search-input {
            border-radius: 30px;
            padding: 15px 25px;
            font-size: 1.1rem;
            width: 100%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: 3px solid #58CC02;
            padding-left: 60px;
            padding-right: 20px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            color: #1e293b;
        }

        .search-input:focus {
            border-color: #9F7AEA;
            box-shadow: 0 4px 20px rgba(159, 122, 234, 0.4);
            transform: scale(1.03);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #58CC02;
            font-size: 1.5rem;
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background-color: #58CC02;
            color: white;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(88, 204, 2, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .add-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
            z-index: -1;
        }

        .add-button:hover {
            background-color: #4CAF50;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(88, 204, 2, 0.5);
        }

        .add-button:hover::before {
            left: 100%;
        }

        /* Bouncing animation for icons */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-8px) rotate(3deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(-4px) rotate(-3deg); }
        }

        .bounce {
            animation: bounce 3s infinite;
        }

        .float {
            animation: floating 6s infinite;
        }

        .page-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #ef4444, #b91c1c, #991b1b, #7f1d1d);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 3px 3px 10px rgba(0,0,0,0.3);
            position: relative;
            display: inline-block;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(45deg, #d81b60, #8e24aa, #5e35b1, #3949ab);
            border-radius: 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: linear-gradient(45deg, #d81b60, #8e24aa, #5e35b1, #3949ab);
            font-weight: 600;
        }

        /* Mobile styling */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 120px;
            }
        }

        /* Card animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        .animate-wiggle {
            animation: wiggle 1s ease-in-out infinite;
            animation-delay: 1s;
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.6;
        }

        .decoration-1 {
            top: 100px;
            left: 10%;
            font-size: 3rem;
            animation: floating 10s infinite;
        }

        .decoration-2 {
            top: 30%;
            right: 5%;
            font-size: 4rem;
            animation: floating 13s infinite reverse;
        }

        .decoration-3 {
            bottom: 15%;
            left: 7%;
            font-size: 3.5rem;
            animation: floating 8s infinite;
        }

        .title-container {
            position: relative;
            text-align: center;
            margin-bottom: 2rem;
        }

        .card-description {
            flex: 1; /* Take up all available space */
            display: flex;
            flex-direction: column;
            position: relative;
            line-height: 1.5;
            min-height: 100px; /* Ensure minimum height */
        }

        .description-text {
            flex: 1; /* This will push the date to the bottom */
        }

        .card-description p {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 4.5em; /* 3 lines at 1.5 line height */
        }

        .card-description p:last-child {
            margin-top: auto; /* Push date to bottom */
            margin-bottom: 0; /* Remove bottom margin to avoid gap */
        }

        /* Remove the gradient effect */
        .card-description::after {
            content: none;
        }

        /* Perbaiki z-index potensial yang mungkin menutupi header */
        .main-content {
            z-index: 1;
        }

        /* Pastikan header selalu terlihat dan dapat diklik */
        .duolingo-header, .user-avatar, .dropdown-toggle {
            z-index: 10000 !important;
            position: relative !important;
        }
    </style>
</head>
<body>

    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content px-6">
            <!-- Decorative elements -->
            <div class="decoration decoration-1">📝</div>
            <div class="decoration decoration-2">📚</div>
            <div class="decoration decoration-3">🔍</div>

            <!-- Page Header -->
            <div class="container mx-auto">
                <div class="text-center mb-8 px-6">
                    <h1 class="content-title">
                        MATERI <i class="fas fa-graduation-cap ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Mari belajar hal-hal seru dan menarik bersama!</p>
                </div>
                <div class="gradient-border"></div>
            </div>

            <!-- Search and Add Button -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-6 items-start">
                    <a href="{{ route('admin.materi.create') }}" class="add-button group">
                        <i class="fas fa-plus-circle mr-2 text-xl transition-transform group-hover:rotate-90 duration-300"></i>
                        <span>Tambah Materi Baru</span>
                    </a>

                    <form action="{{ route('admin.materi.index') }}" method="GET" class="w-full md:w-auto">
                        <div class="search-container" style="width: auto; min-width: 320px;">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" name="search" value="{{ $search ?? '' }}" class="search-input" placeholder="Mau belajar apa hari ini? 🔎">

                            @if(isset($search) && $search)
                            <a href="{{ route('admin.materi.index') }}" class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times-circle text-xl"></i>
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="hidden md:block"><!-- Spacer for flex layout --></div>
            </div>

            <!-- Search Results Notification -->
            @if(isset($search) && $search)
            <div class="mb-8 bg-indigo-900 text-white p-6 rounded-2xl border-2 border-indigo-700 animate-fadeInUp">
                <div class="flex items-center">
                    <span class="text-4xl mr-4 bounce">🔍</span>
                    <span class="font-bold text-xl">{{ count($materis) }} materi tentang "{{ $search }}"</span>
                </div>
            </div>
            @endif

            <!-- Flash Message Notification -->
            @if(session('success'))
            <div id="successNotification" class="mb-8 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl border-2 border-green-400 shadow-lg transform hover:scale-[1.01] transition-all animate-fadeInUp">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-4xl mr-4 bounce">✅</span>
                        <div>
                            <span class="font-bold text-xl">Berhasil!</span>
                            <p class="text-green-100 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('successNotification').style.display='none'" class="text-white hover:text-green-200 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            @endif

            <!-- Error Message Notification -->
            @if(session('error'))
            <div id="errorNotification" class="mb-8 bg-gradient-to-r from-red-500 to-red-700 text-white p-6 rounded-2xl border-2 border-red-400 shadow-lg transform hover:scale-[1.01] transition-all animate-fadeInUp">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-4xl mr-4 bounce">⚠️</span>
                        <div>
                            <span class="font-bold text-xl">Error!</span>
                            <p class="text-red-100 mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('errorNotification').style.display='none'" class="text-white hover:text-red-200 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            @endif

            <!-- Material Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @if(count($materis) > 0)
                    @foreach($materis as $index => $materi)
                        @php
                            // Define theme for card
                            switch($loop->iteration % 5) {
                                case 1:
                                    $theme = [
                                        'header' => 'bg-gradient-to-r from-pink-500 to-pink-700',
                                        'text' => 'text-pink-600',
                                        'icon' => '📝',
                                        'action' => 'bg-pink-500',
                                    ];
                                    break;
                                case 2:
                                    $theme = [
                                        'header' => 'bg-gradient-to-r from-blue-500 to-blue-700',
                                        'text' => 'text-blue-600',
                                        'icon' => '📚',
                                        'action' => 'bg-blue-500',
                                    ];
                                    break;
                                case 3:
                                    $theme = [
                                        'header' => 'bg-gradient-to-r from-green-500 to-green-700',
                                        'text' => 'text-green-600',
                                        'icon' => '🧮',
                                        'action' => 'bg-green-500',
                                    ];
                                    break;
                                case 4:
                                    $theme = [
                                        'header' => 'bg-gradient-to-r from-yellow-500 to-yellow-700',
                                        'text' => 'text-yellow-600',
                                        'icon' => '🔍',
                                        'action' => 'bg-yellow-500',
                                    ];
                                    break;
                                default:
                                    $theme = [
                                        'header' => 'bg-gradient-to-r from-purple-500 to-purple-700',
                                        'text' => 'text-purple-600',
                                        'icon' => '🔬',
                                        'action' => 'bg-purple-500',
                                    ];
                                    break;
                            }

                            // Animation delay for staggered entry
                            $animationDelay = ($index * 0.1) . 's';
                        @endphp

                        <div class="card animate-fadeInUp relative" style="animation-delay: {{ $animationDelay }}">
                            <!-- Card header with gradient background -->
                            <div class="card-header {{ $theme['header'] }}">
                                <span class="card-header-icon float" style="animation-delay: {{ $animationDelay }}">{{ $theme['icon'] }}</span>
                                <h2 class="text-2xl font-bold text-white text-center px-12">{{ $materi->title }}</h2>
                            </div>

                            <div class="card-body">
                                <div class="card-description">
                                    {{-- <a href="{{ route('admin.materi.show', $materi->id) }}" class="text-xl font-bold {{ $theme['text'] }} hover:underline"> --}}
                                    <div class="description-text">
                                        <p class="text-gray-500 mt-1 mb-2 text-sm">{{ Str::limit($materi->description, 150) }}</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-auto">
                                        <i class="far fa-calendar-alt mr-1"></i> Dibuat: {{ $materi->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <div class="action-buttons-container">
                                        <div class="action-wrapper">
                                            <a href="{{ route('admin.materi.edit', $materi->id) }}" class="action-button edit-button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                        </div>
                                        <div class="action-wrapper">
                                            <a href="{{ route('admin.materi.show', $materi->id) }}" class="action-button view-button">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <div class="action-wrapper">
                                            <form id="delete-form-{{ $materi->id }}" action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $materi->id }})" class="action-button delete-button">
                                                    <i class="fas fa-trash"></i>
                                    </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 md:col-span-3 bg-white dark:bg-gray-800 rounded-xl p-10 text-center shadow-xl animate-fadeInUp relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                        <div class="flex flex-col items-center">
                            <div class="text-8xl mb-6 bounce">{{ isset($search) && $search ? '🔍' : '📚' }}</div>
                            <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-purple-600 to-indigo-600 text-transparent bg-clip-text">
                                @if(isset($search) && $search)
                                    Materi Tidak Ditemukan
                                @else
                                    Belum Ada Materi
                                @endif
                            </h2>

                            @if(isset($search) && $search)
                                <p class="text-gray-700 dark:text-gray-300 mb-8 text-xl">Tidak ada materi tentang "{{ $search }}"</p>
                                <a href="{{ route('admin.materi.index') }}" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-full hover:from-purple-700 hover:to-indigo-700 inline-block font-bold transition shadow-lg transform hover:scale-105">
                                    <i class="fas fa-home mr-2"></i> Lihat Semua Materi
                                </a>
                            @else
                                <p class="text-gray-700 dark:text-gray-300 mb-8 text-xl">Ayo tambahkan materi pembelajaran pertamamu!</p>
                                <a href="{{ route('admin.materi.create') }}" class="px-8 py-4 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-full hover:from-green-600 hover:to-teal-600 inline-block font-bold transition shadow-lg transform hover:scale-105">
                                    <i class="fas fa-plus-circle mr-2"></i> Buat Materi Baru
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-auto shadow-xl">
            <div class="text-center">
                <div class="flex justify-end mb-2">
                    <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-8">Apakah Anda yakin ingin menghapus materi ini?</p>

                <div class="flex justify-center space-x-4">
                    <button id="cancelDelete" class="px-10 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 font-medium transition">
                        Batal
                    </button>
                    <button id="confirmDelete" class="px-10 py-3 bg-red-500 text-white rounded-full hover:bg-red-600 font-medium transition">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Confirmation for delete action
        function confirmDelete(id) {
            const modal = document.getElementById('deleteModal');
            const confirmButton = document.getElementById('confirmDelete');
            const cancelButton = document.getElementById('cancelDelete');

            // Show the modal
            modal.classList.remove('hidden');

            // Set up event listeners
            confirmButton.onclick = function() {
                document.getElementById('delete-form-' + id).submit();
                modal.classList.add('hidden');
            };

            cancelButton.onclick = function() {
                modal.classList.add('hidden');
            };

            // Close modal if clicked outside
            modal.onclick = function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            };
        }

        // Close delete modal
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Add fade-in animation when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide the success notification after 5 seconds
            const successNotification = document.getElementById('successNotification');
            if (successNotification) {
                setTimeout(function() {
                    successNotification.style.opacity = '0';
                    successNotification.style.transition = 'opacity 1s ease';
                    setTimeout(function() {
                        successNotification.style.display = 'none';
                    }, 1000);
                }, 5000);
            }

            // Auto-hide the error notification after 5 seconds
            const errorNotification = document.getElementById('errorNotification');
            if (errorNotification) {
                setTimeout(function() {
                    errorNotification.style.opacity = '0';
                    errorNotification.style.transition = 'opacity 1s ease';
                    setTimeout(function() {
                        errorNotification.style.display = 'none';
                    }, 1000);
                }, 5000);
            }

            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('opacity-100');
                }, index * 100);
            });

            // Keep the dropdown functionality but remove the debugging
            var profileBtn = document.getElementById('profileDropdownBtn');
            var dropdownDiv = document.getElementById('userDropdownDiv');
            var clickOverlay = document.getElementById('avatarClickOverlay');

            // Keep the essential dropdown functionality
            if (clickOverlay) {
                clickOverlay.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (dropdownDiv) {
                        dropdownDiv.style.display = dropdownDiv.style.display === 'block' ? 'none' : 'block';
                    }
                });
            }

            if (profileBtn) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (dropdownDiv) {
                        dropdownDiv.style.display = dropdownDiv.style.display === 'block' ? 'none' : 'block';
                    }
                });
            }

            // Keep the hotkey functionality without debug logging
            document.addEventListener('keydown', function(e) {
                if (e.key === 'd' || e.key === 'D') {
                    if (dropdownDiv) {
                        dropdownDiv.style.display = dropdownDiv.style.display === 'block' ? 'none' : 'block';
                    }
                }
            });
        });
    </script>

    @include('components.achievement-notification')
</body>
</html>
