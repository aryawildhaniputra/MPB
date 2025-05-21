<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap');

        body {
            font-family: 'Comic Neue', 'Nunito', sans-serif;
            background-color: #0a0e17; /* Darker background to match the nodes better */
            color: #ffffff;
            background-image: none;
            background-size: 100px;
            background-repeat: repeat;
            background-blend-mode: soft-light;
            background-opacity: 0.05;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 160px !important;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s;
            pointer-events: none;
        }

        .main-content > * {
            pointer-events: auto;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #7028E4;
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

        /* Duolingo style path */
        .lesson-path-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0.5rem 0 2rem 0;
            position: relative;
        }

        .mascot {
            position: absolute;
            width: 100px;
            height: 100px;
            z-index: 2;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.4));
            transition: all 0.3s;
            cursor: pointer;
        }

        .mascot:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .mascot-speech {
            position: absolute;
            background-color: white;
            color: #333;
            padding: 15px;
            border-radius: 20px;
            font-size: 0.875rem;
            width: 180px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            font-weight: 700;
            border: 2px solid #8E44AD;
            z-index: 5;
            opacity: 0;
            transition: all 0.3s;
            transform: scale(0.95);
            pointer-events: none;
        }

        .mascot-speech.active {
            transform: scale(1);
            opacity: 1;
        }

        .mascot-speech:after {
            content: '';
            position: absolute;
            border-style: solid;
            border-width: 10px;
        }

        .lesson-mascot {
            right: 15%;
            top: 150px;
            animation: float 3s ease-in-out infinite;
        }

        .lesson-speech {
            right: 12%;
            top: 100px;
        }

        .lesson-speech:after {
            border-color: white transparent transparent transparent;
            bottom: -20px;
            right: 40px;
        }

        .teacher-mascot {
            left: 15%;
            top: 350px;
            animation: float 3s ease-in-out infinite;
            animation-delay: 1s;
        }

        .teacher-speech {
            left: 5%;
            top: 300px;
        }

        .teacher-speech:after {
            border-color: white transparent transparent transparent;
            bottom: -20px;
            left: 40px;
        }

        .lily-mascot {
            right: 20%;
            bottom: 200px;
            animation: float 3s ease-in-out infinite;
            animation-delay: 2s;
        }

        .lily-speech {
            right: 15%;
            bottom: 300px;
        }

        .lily-speech:after {
            border-color: transparent transparent white transparent;
            top: -20px;
            right: 40px;
        }

        .raccoon-mascot {
            left: 18%;
            bottom: 300px;
            animation: float 3s ease-in-out infinite;
            animation-delay: 1.5s;
        }

        .raccoon-speech {
            left: 8%;
            bottom: 400px;
        }

        .raccoon-speech:after {
            border-color: transparent transparent white transparent;
            top: -20px;
            left: 40px;
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.6;
            font-size: 3rem;
        }

        .decoration-1 {
            top: 15%;
            left: 10%;
            animation: float 13s infinite;
        }

        .decoration-2 {
            top: 25%;
            right: 8%;
            animation: float 8s infinite;
        }

        .decoration-3 {
            bottom: 15%;
            left: 15%;
            animation: float 10s infinite;
        }

        .decoration-4 {
            bottom: 25%;
            right: 12%;
            animation: float 15s infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-10px) rotate(3deg);
            }
            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        @keyframes float-reverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(8px) rotate(3deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(4px) rotate(-3deg); }
        }

        .lesson-path {
            position: relative;
            margin: 0 auto;
            max-width: 500px;
            background-image: none;
            background-color: transparent; /* Remove the dark background */
            padding: 40px 15px;
            z-index: 1;
            border-radius: 0;
            box-shadow: none; /* Remove the shadow */
        }

        /* Remove the vertical line in the middle */
        /* .lesson-path::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            height: 100%;
            width: 4px;
            background-color: #FFC107;
            transform: translateX(-50%);
            z-index: 0;
        } */

        /* Additional decorative elements spread throughout the screen */
        .decoration-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none; /* Make sure decorations don't interfere with clicking */
            z-index: 0; /* Place decorations behind interactive elements */
        }

        .floating-decoration {
            position: absolute;
            z-index: 0;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
            opacity: 0.4; /* Lower opacity to make them less distracting */
        }

        .path-section {
            position: relative;
            padding-bottom: 40px;
        }

        /* Simple divider to replace LOMPAT KE SINI button */
        .section-divider {
            width: 80%;
            height: 2px;
            background: linear-gradient(90deg, rgba(10, 14, 23, 0.1), rgba(88, 204, 2, 0.3), rgba(10, 14, 23, 0.1));
            margin: 20px auto;
            position: relative;
            z-index: 1;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: #58CC02;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 0 2px rgba(88, 204, 2, 0.5);
        }

        .lesson-row {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin-bottom: 30px;
            z-index: 1; /* Ensure rows appear above the vertical line */
        }

        .lesson-node {
            position: relative;
            z-index: 1;
            transition: transform 0.3s;
        }

        .lesson-node:hover {
            transform: scale(1.1);
        }

        .lesson-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #0f1721; /* Much darker background for incomplete nodes */
            border: 4px solid #1a2535;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            transition: all 0.3s;
            z-index: 1;
        }

        .lesson-circle.completed {
            border-color: #58CC02;
            background-color: #58CC02;
            transform: rotate(0deg);
        }

        .lesson-circle.active {
            border-color: #58CC02;
            background-color: #58CC02;
            animation: pulse 2s infinite;
        }

        .lesson-circle.inactive {
            border-color: #2d6a14 !important;
            background-color: #2d6a14 !important;
            opacity: 0.7 !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.7) !important;
            animation: none !important;
            /* Override any other styles */
            background-image: none !important;
            filter: saturate(0.7) !important;
        }

        /* Make sure the inactive icon itself is properly styled */
        .lesson-circle.inactive .far.star-icon {
            color: #87bd81 !important;
            opacity: 0.6 !important;
        }

        /* Style for inactive start icon */
        .lesson-circle.inactive .start-icon {
            filter: brightness(0.8) !important;
            opacity: 0.7 !important;
        }

        .lesson-circle.locked {
            cursor: not-allowed;
            opacity: 0.7;
            background-color: #0a101a; /* Even darker for locked nodes */
            border-color: #131e2c;
        }

        .start-icon {
            width: 45px;
            height: 45px;
            filter: brightness(100);
        }

        .star-icon {
            font-size: 1.8rem;
            color: white;
        }

        .far.star-icon {
            color: white;
            opacity: 0.2; /* Make incomplete stars more faded */
        }

        .inactive .far.star-icon {
            color: #87bd81;
            opacity: 0.6;
        }

        .fas.star-icon {
            color: white;
        }

        .lock-icon {
            font-size: 1.5rem;
            color: #e2e8f0;
            opacity: 0.5;
        }

        .trophy-icon {
            font-size: 1.5rem;
            color: #FFF;
        }

        .lesson-tooltip {
            position: absolute;
            top: 0;
            transform: translateY(-105%);
            background-color: #1e2c3a;
            border-radius: 20px;
            padding: 1rem;
            width: 240px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            z-index: 10;
            text-align: left;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s;
            border: 3px solid #58CC02;
        }

        .lesson-node:hover .lesson-tooltip {
            visibility: visible;
            opacity: 1;
        }

        .lesson-tooltip::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 8px 8px 0 8px;
            border-style: solid;
            border-color: #58CC02 transparent transparent transparent;
        }

        .node-left .lesson-tooltip {
            left: auto;
            right: -100px;
        }

        .node-right .lesson-tooltip {
            right: auto;
            left: -100px;
        }

        .tooltip-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            color: #58CC02;
        }

        .tooltip-subtitle {
            font-size: 0.9rem;
            color: #a0aec0;
            margin-bottom: 0.5rem;
        }

        .tooltip-button {
            display: flex;
            width: 100%;
            padding: 0.6rem;
            background-color: #58CC02;
            color: white;
            font-weight: 700;
            border-radius: 15px;
            align-items: center;
            justify-content: center;
            margin-top: 0.8rem;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.4);
            border: none;
            letter-spacing: 0.5px;
        }

        .tooltip-button img {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .tooltip-button span {
            display: inline-block;
            margin-left: 5px;
        }

        .tooltip-button:hover {
            background-color: #4CAF50;
            transform: translateY(-2px);
        }

        .locked-button {
            background-color: #2c3e50;
            cursor: not-allowed;
            border: none;
            color: #a0aec0;
        }

        .locked-button:hover {
            background-color: #2c3e50;
            transform: none;
        }

        /* Notification styles */
        .notification {
            position: fixed;
            top: 90px;
            right: 20px;
            background-color: #7f1d1d;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 400px;
            opacity: 0;
            transition: all 0.5s ease;
            transform: translateX(100px);
            display: flex;
            align-items: center;
        }

        .notification.show,
        .notification.error,
        .notification.success {
            opacity: 1;
            transform: translateX(0);
        }

        .notification.error {
            background: linear-gradient(135deg, #dc2626, #991b1b);
        }

        .notification.success {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .notification i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        /* Success notification */
        .success-notification {
            position: fixed;
            top: 85px;
            right: 20px;
            left: auto;
            transform: translateX(100px);
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            z-index: 1001;
            opacity: 0;
            transition: all 0.3s ease;
            max-width: 90%;
            width: auto;
            border: 2px solid rgba(255, 255, 255, 0.3);
            text-align: left;
        }

        .success-notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .success-notification .icon {
            font-size: 1.3rem;
            margin-right: 10px;
        }

        .success-notification .message {
            font-weight: bold;
            font-size: 1rem;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 120px;
            }

            .mascot {
                width: 60px;
                height: 60px;
            }

            .lesson-tooltip {
                width: 200px;
            }

            .notification {
                width: 90%;
                max-width: 320px;
                padding: 12px 20px;
                text-align: center;
                justify-content: center;
            }

            .success-notification {
                right: 10px;
                max-width: 280px;
                padding: 12px 20px;
            }

            .notification.show {
                transform: translateX(50%);
            }

            .content-title {
                font-size: 2.5rem;
                padding: 0 10px;
            }
        }

        @media (max-width: 480px) {
            .content-title {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 0.9rem;
                padding: 0 15px;
            }

            .notification {
                font-size: 0.9rem;
                padding: 10px 15px;
            }

            .success-notification {
                font-size: 0.9rem;
                padding: 10px 15px;
                width: 90%;
                max-width: 90%;
            }

            .success-notification .icon {
                font-size: 1.2rem;
            }

            .success-notification .message {
                font-size: 0.9rem;
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(88, 204, 2, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(88, 204, 2, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(88, 204, 2, 0);
            }
        }

        /* Pastikan header selalu terlihat dan dapat diklik */
        .duolingo-header, .user-avatar, .dropdown-toggle {
            z-index: 10000 !important;
            position: relative !important;
        }

        /* Tambahkan visual debug area untuk pointer events */
        .debug-area {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background: rgba(255, 0, 0, 0.2);
            color: white;
            padding: 5px;
            font-size: 10px;
            z-index: 9999;
        }

        /* Pastikan tidak ada overlay yang menutupi header */
        .main-content {
            pointer-events: none;
        }

        .main-content > * {
            pointer-events: auto;
        }

        /* Add stronger inactive styling for the star icons */
        .inactive .far.star-icon {
            color: #87bd81;
            opacity: 0.6;
        }

        /* Add special styling for the start icon when inactive */
        .inactive .start-icon {
            filter: brightness(80);
            opacity: 0.7;
        }

                /* This styling is now handled directly through the inactive class */
    </style>
</head>
<body>
    @include('header')
    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6 relative" style="padding-top: 90px !important;">
            <!-- Notification Message -->
            @if(session('error'))
            <div class="notification error" id="errorNotification">
                @if(session('error') == 'Tidak ada pelajaran aktif')
                    <i class="fas fa-book-open"></i>
                @else
                    <i class="fas fa-exclamation-circle"></i>
                @endif
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if(session('success'))
            <div class="success-notification" id="successNotification">
                <span class="icon">✓</span>
                <span class="message">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('learning_completed'))
            <div class="success-notification" id="learningNotification">
                <span class="icon">✓</span>
                <span class="message">{{ session('learning_completed') }}</span>
            </div>
            @endif

            <!-- Decorative elements -->
            <div class="decoration decoration-1">📝</div>
            <div class="decoration decoration-2">📚</div>
            <div class="decoration decoration-3">🔍</div>
            <div class="decoration decoration-4">📘</div>

            <!-- Page Header -->
            <div class="container mx-auto">
                <div class="text-center mb-3 px-4">
                    <h1 class="content-title">
                        BELAJAR <i class="fas fa-book ml-2 text-white"></i>
                    </h1>
                    <p class="subtitle">Mari belajar hal-hal seru dan menarik bersama!</p>
                </div>
                <div class="gradient-border"></div>
            </div>

            <div class="lesson-path-container">
                <!-- Decoration Container for scattered decorative elements -->
                <div class="decoration-container">
                    <!-- Stars -->
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2b50.svg" class="floating-decoration" style="width: 30px; height: 30px; top: 10%; left: 5%; animation: float 7s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg" class="floating-decoration" style="width: 40px; height: 40px; top: 25%; left: 12%; animation: float-reverse 9s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2b50.svg" class="floating-decoration" style="width: 20px; height: 20px; top: 15%; right: 8%; animation: float 8s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg" class="floating-decoration" style="width: 35px; height: 35px; bottom: 20%; right: 15%; animation: float-reverse 10s ease-in-out infinite;">

                    <!-- School items -->
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/270f.svg" class="floating-decoration" style="width: 40px; height: 40px; top: 40%; right: 10%; animation: float 11s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4d6.svg" class="floating-decoration" style="width: 45px; height: 45px; bottom: 30%; left: 8%; animation: float-reverse 9s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4da.svg" class="floating-decoration" style="width: 42px; height: 42px; top: 60%; left: 18%; animation: float 8.5s ease-in-out infinite;">

                    <!-- Playful elements -->
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f388.svg" class="floating-decoration" style="width: 38px; height: 38px; bottom: 15%; right: 8%; animation: float 7.5s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f380.svg" class="floating-decoration" style="width: 32px; height: 32px; top: 75%; right: 25%; animation: float-reverse 10.5s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f381.svg" class="floating-decoration" style="width: 36px; height: 36px; bottom: 40%; left: 5%; animation: float 12s ease-in-out infinite;">

                    <!-- Language learning related -->
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4ac.svg" class="floating-decoration" style="width: 35px; height: 35px; top: 30%; left: 20%; animation: float-reverse 11.5s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4dd.svg" class="floating-decoration" style="width: 32px; height: 32px; bottom: 25%; right: 22%; animation: float 9.5s ease-in-out infinite;">
                    <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f516.svg" class="floating-decoration" style="width: 30px; height: 30px; top: 65%; right: 10%; animation: float-reverse 8.5s ease-in-out infinite;">
                </div>

                <!-- Mascot Characters with Speech Bubbles -->
                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f42d.svg" alt="Mascot" class="mascot lesson-mascot">
                <div class="mascot-speech lesson-speech">Ayo belajar bahasa baru! Klik aku!</div>

                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f989.svg" alt="Teacher" class="mascot teacher-mascot">
                <div class="mascot-speech teacher-speech">Jadilah yang terbaik di kelas!</div>

                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f430.svg" alt="Lily" class="mascot lily-mascot">
                <div class="mascot-speech lily-speech">Kumpulkan semua bintang!</div>

                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f98a.svg" alt="Fox" class="mascot raccoon-mascot">
                <div class="mascot-speech raccoon-speech">Jangan lupa latihan tiap hari!</div>

                <!-- Lesson Path -->
                <div class="lesson-path">
                    @php
                        // Group lessons by level/theme for sections
                        $sectionCount = min(3, ceil(count($lessons) / 2)); // Create 2-3 sections
                        $currentSection = 0;
                    @endphp

                    @for($section = 0; $section < $sectionCount; $section++)
                        <div class="path-section">
                            <!-- Start Node (only in first section) -->
                            @if($section == 0)
                                                                @php
                                    // Determine if the initial start node should be inactive
                                    // For demo purposes, let's make the start node inactive if first lesson is inactive
                                    $startNodeInactive = false;

                                    // If there are lessons, check if the first one is inactive
                                    if (count($lessons) > 0) {
                                        $firstLesson = $lessons[0];
                                        // For testing, mark the start node as inactive if first lesson is in position 3, 6, 9...
                                        // In production, directly check the first lesson's is_active status
                                        $firstPosition = $firstLesson['position'] ?? 1;
                                        $startNodeInactive = ($firstPosition % 3 == 0) ||
                                                           (isset($firstLesson['is_active']) && !$firstLesson['is_active']);
                                    }
                                @endphp
                                <div class="lesson-row justify-content-center">
                                    <div class="text-center mb-2">
                                        {{-- <span class="text-green-500 font-bold text-xl" style="text-shadow: 0 0 10px rgba(88, 204, 2, 0.7);">MULAILAH PERJALANANU SEKARANG</span> --}}
                                    </div>
                                </div>
                                <div class="lesson-row">
                                    <div class="lesson-node">
                                        <div class="lesson-circle {{ $startNodeInactive ? 'inactive' : 'active' }}">
                                            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f680.svg" alt="Start" class="start-icon">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @php
                                // Calculate which lessons belong to this section
                                $sectionSize = ceil(count($lessons) / $sectionCount);
                                $startIndex = $section * $sectionSize;
                                $endIndex = min(($section + 1) * $sectionSize, count($lessons));
                                $sectionLessons = array_slice($lessons->toArray(), $startIndex, $endIndex - $startIndex);
                            @endphp

                            @foreach($sectionLessons as $lessonIndex => $lesson)
                                                                                                        @php
                                        $globalIndex = $startIndex + $lessonIndex;
                                        $isFirstLesson = $globalIndex === 0;

                                        // Check if lesson is active directly from the database attribute
                                        // For testing, explicitly mark some lessons as inactive
                                        if (!isset($lesson['is_active'])) {
                                            // This is for testing only - remove in production
                                            // Force every 3rd lesson to be inactive for demonstration
                                            $lesson['is_active'] = !($globalIndex % 3 == 0);
                                        }
                                        $isLessonActive = $lesson['is_active'] ?? true;

                                        // Use the unlocked field from user_status
                                        $isUnlocked = $lesson['user_status']['unlocked'] ?? true;

                                        $isCompleted = $lesson['user_status']['completed'];
                                        $isEven = $lessonIndex % 2 == 0;
                                        $rowClass = $isEven ? 'justify-content-center' : 'justify-content-center';
                                        $nodeClass = $isEven ? 'node-right' : 'node-left';
                                @endphp

                                <!-- Divide each lesson into 6 parts/exercises in zigzag pattern -->
                                @for($part = 1; $part <= 6; $part++)
                                    @php
                                        // Determine if this specific part is completed
                                        $lessonStarted = $lesson['user_status']['started'] ?? false;

                                        // Check the specific part completion status
                                        $partCompleted = false;
                                        if ($part == 1) {
                                            $partCompleted = $lesson['user_status']['part1_completed'] ?? false;
                                        } elseif ($part == 2) {
                                            $partCompleted = $lesson['user_status']['part2_completed'] ?? false;
                                        } elseif ($part == 3) {
                                            $partCompleted = $lesson['user_status']['part3_completed'] ?? false;
                                        } elseif ($part == 4) {
                                            $partCompleted = $lesson['user_status']['part4_completed'] ?? false;
                                        } elseif ($part == 5) {
                                            $partCompleted = $lesson['user_status']['part5_completed'] ?? false;
                                        } elseif ($part == 6) {
                                            $partCompleted = $lesson['user_status']['part6_completed'] ?? false;
                                        }

                                        // All parts are unlocked by default now
                                        $partUnlocked = true;

                                        // Part is active (current focus) if:
                                        // 1. It's unlocked
                                        // 2. Not yet completed
                                        // 3. The lesson is active
                                        $isActive = $partUnlocked && !$partCompleted && $isLessonActive;

                                        // Define the node CSS classes
                                        $circleClass = 'lesson-circle';
                                        if ($partCompleted) {
                                            $circleClass .= ' completed';
                                        } elseif (!$isLessonActive) {
                                            $circleClass .= ' inactive'; // Force inactive class for inactive lessons
                                        } elseif ($isActive) {
                                            $circleClass .= ' active';
                                        }
                                        if (!$partUnlocked) $circleClass .= ' locked';

                                        // Create a structured zigzag pattern like in the image
                                        // Calculate the position based on the absolute index
                                        $absoluteIndex = $globalIndex * 6 + $part;

                                        // Determine if this node should be centered, left, or right
                                        // Use a repeating pattern of: center, left, right, center, left, right, etc.
                                        $position = $absoluteIndex % 3;

                                        if ($position == 0) {
                                            // Center
                                            $rowClass = 'justify-content-center';
                                            $nodeClass = '';
                                            $offset = '';
                                        } elseif ($position == 1) {
                                            // Left
                                            $rowClass = 'justify-content-start';
                                            $nodeClass = 'node-left';
                                            $offset = 'ml-20';
                                        } else {
                                            // Right
                                            $rowClass = 'justify-content-end';
                                            $nodeClass = 'node-right';
                                            $offset = 'mr-20';
                                        }
                                    @endphp

                                    <div class="lesson-row {{ $rowClass }}">
                                        <div class="lesson-node {{ $nodeClass }} {{ $offset }}">
                                            <div class="{{ $circleClass }}">
                                                @if($partCompleted)
                                                    <i class="fas fa-star star-icon"></i>
                                                @elseif(!$partUnlocked)
                                                    <i class="fas fa-lock lock-icon"></i>
                                                @else
                                                    <i class="far fa-star star-icon"></i>
                                                @endif
                                            </div>

                                            <!-- Tooltip for the node -->
                                            <div class="lesson-tooltip">
                                                <div class="tooltip-title">{{ $lesson['title'] }}</div>
                                                <div class="tooltip-subtitle">
                                                    @if($part < 6)
                                                        Bagian {{ $part }} dari 6
                                                    @else
                                                        Ujian Akhir
                                                    @endif
                                                </div>

                                                @if($partCompleted)
                                                <div class="completed-info bg-gray-800 p-3 rounded-lg mb-3 border-2 border-green-800">
                                                    <div class="flex items-center mb-2">
                                                        <i class="fas fa-check-circle text-green-500 mr-2 text-lg"></i>
                                                        <p class="text-green-400 font-bold">Bagian Selesai!</p>
                                                    </div>
                                                    <div class="bg-gray-900 p-3 rounded-lg">
                                                        <p class="font-bold text-green-400 mb-2 border-b border-gray-700 pb-1">Contoh Jawaban Benar:</p>
                                                        @php
                                                            $exampleAnswer = null;
                                                            $partField = 'part' . $part . '_example';
                                                            if (isset($lesson['user_status'][$partField])) {
                                                                $exampleAnswer = $lesson['user_status'][$partField];
                                                            }
                                                        @endphp

                                                        @if($exampleAnswer)
                                                            <div class="flex items-center">
                                                                <span class="text-white bg-gray-800 px-3 py-2 rounded-lg font-semibold">{{ $exampleAnswer }}</span>
                                                            </div>
                                                        @else
                                                            <p class="text-green-400">Jawaban tidak tersedia</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif

                                                @if(!$partUnlocked)
                                                    <div class="text-sm text-gray-600 mb-2">
                                                        Selesaikan semua level di atas untuk membuka ini!
                                                    </div>
                                                    <a href="#" class="tooltip-button locked-button">
                                                        <i class="fas fa-lock mr-2"></i>TERKUNCI
                                                    </a>
                                                @else
                                                    @if($partCompleted)
                                                        <a href="{{ route('belajar.review', ['id' => $lesson['id'], 'part' => $part]) }}" class="tooltip-button bg-blue-600 hover:bg-blue-700">
                                                            <i class="fas fa-eye mr-2"></i>Lihat Soal
                                                    </a>
                                                @else
                                                    <form action="{{ route('belajar.start', $lesson['id']) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="part" value="{{ $part }}">
                                                        <button type="submit" class="tooltip-button">
                                                                <span>+15 poin</span>
                                                        </button>
                                                    </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                                <!-- Skip button after each unit (except the last) -->
                                @if(!$loop->last)
                                    <div class="lesson-row justify-content-center">
                                        <div class="section-divider"></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endfor

                    <!-- Trophy at the end -->
                    <div class="lesson-row justify-content-center">
                        <div class="lesson-node">
                            <div class="lesson-circle" style="width: 70px; height: 70px; background-color: #0f1721; border-color: #1a2535;">
                                <i class="fas fa-trophy trophy-icon" style="color: #e2e8f0; opacity: 0.3; font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan debug area untuk pointer events -->
    <div class="debug-area" style="display: none;">
        Debug area
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('[Belajar Page] DOMContentLoaded triggered');

                                    // We now handle inactive lessons directly in the PHP/Blade template
            // No need for JavaScript detection based on notifications

            // Show all notifications with animation
            const showNotification = (element) => {
                if (element) {
                    // Add the show class to make it visible with animation
                    setTimeout(() => {
                        element.classList.add('show');
                    }, 100);

                                        // Auto-hide notifications after 5 seconds
                    setTimeout(() => {
                        element.style.opacity = '0';
                        element.style.transform = 'translateX(100px)';
                        setTimeout(() => {
                            element.style.display = 'none';
                        }, 500);
                    }, 5000);
                }
            };

            // Handle all types of notifications
            const errorNotification = document.getElementById('errorNotification');
            const successNotification = document.getElementById('successNotification');
            const learningNotification = document.getElementById('learningNotification');

            // Show each notification if it exists
            showNotification(errorNotification);
            showNotification(successNotification);
            showNotification(learningNotification);

            // Add click event listeners to mascots
            const mascots = document.querySelectorAll('.mascot');
            mascots.forEach(mascot => {
                mascot.addEventListener('click', function() {
                    // Find the corresponding speech bubble (next sibling element)
                    const speechBubble = this.nextElementSibling;

                    // Hide all other speech bubbles first
                    document.querySelectorAll('.mascot-speech').forEach(bubble => {
                        bubble.classList.remove('active');
                    });

                    // Toggle the active class on the current speech bubble
                    speechBubble.classList.toggle('active');

                    // Auto-hide the speech bubble after 4 seconds
                    setTimeout(() => {
                        speechBubble.classList.remove('active');
                    }, 4000);
                });
            });

            // Allow clicking anywhere else to dismiss speech bubbles
            document.addEventListener('click', function(event) {
                if (!event.target.classList.contains('mascot')) {
                    document.querySelectorAll('.mascot-speech').forEach(bubble => {
                        bubble.classList.remove('active');
                    });
                }
            });

            // Log info about dropdown elements
            var profileBtn = document.getElementById('profileDropdownBtn');
            var dropdown = document.getElementById('userDropdown');

            console.log('[Belajar Page] Profile button:', profileBtn);
            console.log('[Belajar Page] Dropdown:', dropdown);

            // Add event listener for profile button
            if (profileBtn) {
                profileBtn.addEventListener('mouseenter', function() {
                    console.log('[Belajar Page] Profile button mouse enter');
                });
            }
        });
    </script>
</body>
</html>
