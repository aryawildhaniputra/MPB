<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #151b2e;
            color: #ffffff;
        }

        .main-content {
            min-height: calc(100vh - 70px);
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            width: calc(100% - 250px);
            transition: all 0.3s ease;
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
            background: #14b8a6;
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

        .achievement-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 140px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .achievement-card {
                min-height: 120px;
            }
        }

        @media (max-width: 480px) {
            .achievement-card {
                min-height: 110px;
            }
        }

        .achievement-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .achievement-card.unlocked {
            border: none;
            background: linear-gradient(135deg, #ffffff, #f0f9ff);
        }

        .achievement-card.locked {
            background: #f8fafc;
            opacity: 0.95;
        }

        .achievement-card.locked:hover {
            opacity: 1;
        }

        .achievement-icon {
            transition: all 0.3s ease;
            width: 48px !important;
            height: 48px !important;
            padding: 0.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
        }

        @media (max-width: 768px) {
            .achievement-icon {
                width: 40px !important;
                height: 40px !important;
                padding: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-icon {
                width: 36px !important;
                height: 36px !important;
                padding: 0.3rem;
            }
        }

        .achievement-card:hover .achievement-icon {
            transform: scale(1.05);
        }

        .achievement-reward {
            position: absolute;
            top: 12px;
            right: 12px;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 4px;
            background: #f8fafc;
            color: #64748b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .achievement-reward {
                top: 8px;
                right: 8px;
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
                gap: 2px;
            }
        }

        @media (max-width: 480px) {
            .achievement-reward {
                top: 6px;
                right: 6px;
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }
        }

        .achievement-name {
            font-size: 1rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.25rem;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .achievement-name {
                font-size: 0.9rem;
                line-height: 1.3;
            }
        }

        @media (max-width: 480px) {
            .achievement-name {
                font-size: 0.85rem;
                line-height: 1.2;
            }
        }

        .achievement-description {
            font-size: 0.875rem;
            line-height: 1.5;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .achievement-description {
                font-size: 0.8rem;
                line-height: 1.4;
            }
        }

        @media (max-width: 480px) {
            .achievement-description {
                font-size: 0.75rem;
                line-height: 1.3;
            }
        }

        /* Type-specific styles */
        .achievement-card.type-materi_completion {
            background: linear-gradient(to right bottom, #f0f9ff, #ffffff);
            border-color: #bae6fd;
        }
        .achievement-card.type-materi_completion .achievement-icon {
            background: #e0f2fe;
            color: #0284c7;
        }
        .achievement-card.type-materi_completion .achievement-name {
            color: #0369a1;
        }

        .achievement-card.type-bagian_completion {
            background: linear-gradient(to right bottom, #fdf4ff, #ffffff);
            border-color: #f5d0fe;
        }
        .achievement-card.type-bagian_completion .achievement-icon {
            background: #fae8ff;
            color: #c026d3;
        }
        .achievement-card.type-bagian_completion .achievement-name {
            color: #a21caf;
        }

        .achievement-card.type-belajar_singkat_materi {
            background: linear-gradient(to right bottom, #f0fdf4, #ffffff);
            border-color: #bbf7d0;
        }
        .achievement-card.type-belajar_singkat_materi .achievement-icon {
            background: #dcfce7;
            color: #16a34a;
        }
        .achievement-card.type-belajar_singkat_materi .achievement-name {
            color: #15803d;
        }

        .achievement-card.type-points {
            background: linear-gradient(to right bottom, #fffbeb, #ffffff);
            border-color: #fde68a;
        }
        .achievement-card.type-points .achievement-icon {
            background: #fef3c7;
            color: #d97706;
        }
        .achievement-card.type-points .achievement-name {
            color: #b45309;
        }

        .achievement-card.type-speed {
            background: linear-gradient(to right bottom, #fff7ed, #ffffff);
            border-color: #fed7aa;
        }
        .achievement-card.type-speed .achievement-icon {
            background: #ffedd5;
            color: #ea580c;
        }
        .achievement-card.type-speed .achievement-name {
            color: #c2410c;
        }

        .achievement-card.locked {
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
            opacity: 0.95;
        }

        .achievement-card.locked .achievement-icon {
            background: #f1f5f9 !important;
            color: #94a3b8 !important;
        }

        .achievement-card.locked .achievement-name {
            color: #64748b !important;
        }

        .achievement-reward {
            position: absolute;
            top: 12px;
            right: 12px;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 4px;
            background: rgba(255, 255, 255, 0.9);
            color: #64748b;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .locked-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .achievement-card.locked:hover .locked-overlay {
            opacity: 1;
        }

        .locked-message {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            color: #f8fafc;
            font-size: 0.875rem;
        }

        .achievement-card.locked .achievement-icon {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .achievement-content {
            padding: 1.25rem;
        }

        @media (max-width: 768px) {
            .achievement-content {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-content {
                padding: 0.8rem;
            }
        }

        .achievement-header {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .achievement-header {
                gap: 0.8rem;
                margin-bottom: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .achievement-header {
                gap: 0.6rem;
                margin-bottom: 0.3rem;
            }
        }

        .achievement-info {
            flex: 1;
            min-width: 0;
        }

        /* Glow effect for unlocked achievements */
        .achievement-card.unlocked::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(45deg);
            pointer-events: none;
            z-index: 1;
            transition: all 0.6s ease;
        }

        .achievement-card.unlocked:hover::before {
            transform: rotate(65deg);
        }

        .achievement-type-badge {
            position: absolute;
            top: 0;
            left: 20px;
            padding: 2px 12px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 800;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        /* Special animation for speed icons */
        .achievement-card.type-speed .achievement-icon {
            transform: scale(1.05);
        }

        .achievement-card.type-speed:hover .achievement-icon {
            transform: scale(1.15);
        }

        .achievement-card.type-speed .achievement-icon i {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('sidebar')
    @include('header')

    <div class="main-content">
        <div class="px-4 py-6 mx-auto">
            <h1 class="content-title">Pencapaian</h1>
            <div class="subtitle">Pantau prestasi dan pencapaian belajarmu</div>
            <div class="gradient-border"></div>

            <div class="max-w-6xl mx-auto px-2 md:px-0">
                <div class="mb-8 bg-gradient-to-r from-blue-50 to-teal-50 p-3 md:p-5 rounded-lg shadow-md border border-teal-200">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0 flex flex-col md:flex-row items-center">
                            <div class="text-2xl md:text-3xl mb-3 md:mb-0 md:mr-4 bg-teal-100 p-2 md:p-3 rounded-full text-teal-600">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="text-center md:text-left">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Progress Pencapaian</h2>
                                <p class="text-sm md:text-base text-gray-600">Kamu telah membuka <span class="font-bold text-teal-600">{{ $unlockedCount }}</span> dari <span class="font-bold">{{ $totalCount }}</span> pencapaian</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3">
                            <div class="w-full bg-gray-200 rounded-full h-4 md:h-5 mb-2">
                                <div class="bg-gradient-to-r from-teal-500 to-teal-600 h-4 md:h-5 rounded-full transition-all duration-1000" style="width: {{ ($unlockedCount / max(1, $totalCount)) * 100 }}%"></div>
                            </div>
                            <span class="text-xs md:text-sm font-bold">{{ round(($unlockedCount / max(1, $totalCount)) * 100) }}% Selesai</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4 md:mb-6">
                    <h2 class="text-lg md:text-xl font-bold text-black mb-4">Semua Pencapaian</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 px-1 md:px-0">
                    @foreach($achievements as $achievement)
                        @php
                            // Determine type styling
                            $typeClass = 'type-' . $achievement->type;
                            $typeLabel = '';
                            $typeIcon = '';

                            switch($achievement->type) {
                                case 'materi_completion':
                                    $typeLabel = 'Materi';
                                    $typeIcon = '<i class="fas fa-book"></i>';
                                    $bgColor = $achievement->is_unlocked ? 'bg-blue-100' : 'bg-gray-100';
                                    $textColor = $achievement->is_unlocked ? 'text-blue-600' : 'text-gray-400';
                                    $badgeBg = 'bg-blue-500 text-white';
                                    break;
                                case 'bagian_completion':
                                    $typeLabel = 'Bagian';
                                    $typeIcon = '<i class="fas fa-list-check"></i>';
                                    $bgColor = $achievement->is_unlocked ? 'bg-pink-100' : 'bg-gray-100';
                                    $textColor = $achievement->is_unlocked ? 'text-pink-600' : 'text-gray-400';
                                    $badgeBg = 'bg-pink-500 text-white';
                                    break;
                                case 'belajar_singkat_materi':
                                    $typeLabel = 'Belajar Singkat';
                                    $typeIcon = '<i class="fas fa-bolt"></i>';
                                    $bgColor = $achievement->is_unlocked ? 'bg-green-100' : 'bg-gray-100';
                                    $textColor = $achievement->is_unlocked ? 'text-green-600' : 'text-gray-400';
                                    $badgeBg = 'bg-green-500 text-white';
                                    break;
                                case 'points':
                                    $typeLabel = 'Poin';
                                    $typeIcon = '<i class="fas fa-star"></i>';
                                    $bgColor = $achievement->is_unlocked ? 'bg-yellow-100' : 'bg-gray-100';
                                    $textColor = $achievement->is_unlocked ? 'text-yellow-600' : 'text-gray-400';
                                    $badgeBg = 'bg-yellow-500 text-white';
                                    break;
                                case 'speed':
                                    $typeLabel = 'Kecepatan';
                                    $typeIcon = '<i class="fas fa-stopwatch"></i>';
                                    $bgColor = $achievement->is_unlocked ? 'bg-orange-100' : 'bg-gray-100';
                                    $textColor = $achievement->is_unlocked ? 'text-orange-600' : 'text-gray-400';
                                    $badgeBg = 'bg-orange-600 text-white';
                                    break;
                                default:
                                    $typeLabel = 'Lainnya';
                                    $typeIcon = '<i class="fas fa-award"></i>';
                                    $bgColor = $achievement->is_unlocked ? 'bg-purple-100' : 'bg-gray-100';
                                    $textColor = $achievement->is_unlocked ? 'text-purple-600' : 'text-gray-400';
                                    $badgeBg = 'bg-purple-500 text-white';
                            }
                        @endphp

                        <div class="achievement-card {{ $achievement->is_unlocked ? 'unlocked type-' . $achievement->type : 'locked' }} rounded-lg">
                            <div class="p-4 md:p-6">
                                <div class="achievement-reward {{ $achievement->is_unlocked ? 'bg-yellow-100/90 text-yellow-700' : 'bg-gray-100/90 text-gray-500' }}">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $achievement->points_reward }}</span>
                                </div>

                                <div class="achievement-content">
                                    <div class="flex items-start space-x-3 md:space-x-4">
                                        <div class="achievement-icon w-12 h-12 md:w-16 md:h-16 flex items-center justify-center rounded-xl {{ $bgColor }}">
                                            @if($achievement->is_unlocked)
                                                <span class="text-lg md:text-2xl {{ $textColor }}">{!! $typeIcon !!}</span>
                                            @else
                                                <span class="text-lg md:text-2xl text-gray-400"><i class="fas fa-lock"></i></span>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="achievement-name {{ $achievement->is_unlocked ? $textColor : 'text-gray-500' }}">
                                                {{ $achievement->name }}
                                            </h3>
                                            <p class="achievement-description">
                                                {{ $achievement->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @if(!$achievement->is_unlocked)
                                    <div class="locked-overlay">
                                        <div class="locked-message">
                                            <i class="fas fa-lock"></i>
                                            <span>Belum Terbuka</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('components.achievement-notification')
</body>
</html>
