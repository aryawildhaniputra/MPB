<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Comic+Neue:wght@400;700&display=swap');

        body {
            font-family: 'Comic Neue', 'Nunito', sans-serif;
            background-color: #f0f9ff;
            color: #3c3c3c;
            overflow-x: hidden;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2358cc02' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero-section {
            background: linear-gradient(135deg, #FF9D2F, #FF6839);
            border-radius: 30px;
            padding: 4rem 3rem;
            margin-top: 2rem;
            color: white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            border: none;
            background-clip: padding-box;
        }

        @keyframes borderColor {
            0%, 100% {
                border-image: none;
            }
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            animation: float 6s ease-in-out infinite;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            text-align: center;
        }

        .subtitle {
            font-size: 1.5rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            max-width: 600px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px 36px;
            background: linear-gradient(135deg, #FFEB3B 0%, #FFC107 100%);
            color: #5B3A29;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.25rem;
            transition: all 0.4s ease;
            box-shadow: 0 6px 0 #F57C00, 0 10px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            transform: translateY(0);
            margin: 0 auto;
            max-width: 300px;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        .login-button i {
            font-size: 1.3rem;
            margin-left: 0.5rem;
            animation: rocketWiggle 2s ease-in-out infinite;
            display: inline-block;
        }

        @keyframes rocketWiggle {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-4px) rotate(5deg);
            }
        }

        .login-button:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 0 #F57C00, 0 15px 25px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #FFF176 0%, #FFD54F 100%);
        }

        .login-button:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #F57C00, 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
            margin-top: 5rem;
        }

        .feature-card {
            background-color: white;
            border-radius: 30px;
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            text-align: center;
            transition: all 0.4s ease;
            transform: translateY(0);
            border: 3px solid #F0F0F0;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        .feature-card:hover, .feature-card:active {
            transform: translateY(-12px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.05);
        }

        .feature-card:active .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-bottom: 1.75rem;
            font-size: 2.25rem;
            color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .icon-learn {
            background: linear-gradient(135deg, #8E44AD, #9B59B6);
        }

        .icon-game {
            background: linear-gradient(135deg, #27AE60, #2ECC71);
        }

        .icon-progress {
            background: linear-gradient(135deg, #3498DB, #2980B9);
        }

        .feature-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 1.2rem;
            color: #4b4b4b;
        }

        .mascot {
            position: absolute;
            bottom: -20px;
            right: 80px;
            width: 220px;
            height: 220px;
            z-index: 10;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.25));
        }

        .cartoon-character {
            position: absolute;
            bottom: 20px;
            right: 50px;
            width: 180px;
            height: 180px;
            z-index: 10;
            animation: bounce 4s ease infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-12px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-25px) rotate(5deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            pointer-events: none;
            animation: floatParticle 6s linear infinite;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            animation: bubbleFloat 5s ease-in-out infinite;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(40px);
                opacity: 0;
            }
        }

        @keyframes bubbleFloat {
            0% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-30px) scale(1.1);
            }
            100% {
                transform: translateY(0) scale(1);
            }
        }

        .footer-wave {
            position: relative;
            width: 100%;
            height: 100px;
            background-color: #f0f9ff;
            overflow: hidden;
        }

        .footer-wave::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f3f4f6' fill-opacity='1' d='M0,192L60,202.7C120,213,240,235,360,218.7C480,203,600,149,720,138.7C840,128,960,160,1080,181.3C1200,203,1320,213,1380,218.7L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .star-decoration {
            position: absolute;
            width: 50px;
            height: 50px;
            background-image: url('https://cdn-icons-png.flaticon.com/512/4727/4727496.png');
            background-size: contain;
            background-repeat: no-repeat;
            z-index: 2;
        }

        .star-top-right {
            top: 30px;
            right: 40px;
            animation: float 6s ease-in-out 0.3s infinite;
        }

        .star-bottom-left {
            bottom: 40px;
            left: 50px;
            animation: float 5s ease-in-out 0.7s infinite;
            transform: rotate(-15deg) scale(0.8);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2.5rem 1.75rem;
            }

            h1 {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .star-decoration {
                width: 40px;
                height: 40px;
            }

            .login-button {
                padding: 15px 30px;
                font-size: 1.15rem;
            }
        }

        /* Mobile phone specific styles */
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .hero-section {
                padding: 2rem 1.25rem;
                margin-top: 1rem;
            }

            h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .login-button {
                padding: 12px 24px;
                font-size: 1rem;
                box-shadow: 0 4px 0 #F57C00, 0 8px 16px rgba(0, 0, 0, 0.15);
            }

            .login-button:hover {
                box-shadow: 0 6px 0 #F57C00, 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .login-button i {
                font-size: 1.1rem;
            }

            .features {
                margin-top: 3rem;
                gap: 1.5rem;
            }

            .feature-card {
                padding: 1.5rem 1rem;
                /* Make tapping more responsive on mobile */
                transition: all 0.3s ease;
            }

            .feature-card:active {
                transform: translateY(-5px);
                box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            }

            .feature-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
                margin-bottom: 1.25rem;
            }

            .feature-title {
                font-size: 1.3rem;
                margin-bottom: 0.8rem;
            }

            .star-decoration {
                width: 35px;
                height: 35px;
            }

            .star-top-right {
                top: 20px;
                right: 25px;
            }

            .star-bottom-left {
                bottom: 30px;
                left: 25px;
            }

            .bubble {
                opacity: 0.6;
            }
        }

        /* Small mobile phone styles */
        @media (max-width: 360px) {
            .hero-section {
                padding: 1.75rem 1rem;
            }

            h1 {
                font-size: 1.75rem;
            }

            .subtitle {
                font-size: 0.9rem;
            }

            .login-button {
                padding: 10px 20px;
                font-size: 0.95rem;
                max-width: 250px;
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.6rem;
            }

            .feature-title {
                font-size: 1.2rem;
            }

            .star-decoration {
                width: 30px;
                height: 30px;
            }
        }

        /* iOS specific fixes */
        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            .login-button {
                font-size: 16px; /* Prevents iOS zoom on focus */
                -webkit-touch-callout: none;
                touch-action: manipulation;
            }

            a, button {
                -webkit-touch-callout: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <div class="hero-section">
            <div class="particles" id="particles"></div>
            <div class="bubbles" id="bubbles"></div>
            <div class="relative z-10">
                <h1>Ayo Belajar Bahasa Inggris<br>Bersama Teman-teman!</h1>
                <p class="subtitle">Tempat seru untuk belajar bahasa Inggris dengan permainan dan aktivitas yang menyenangkan!</p>
                <a href="{{ route('login') }}" class="login-button">
                    Mulai Petualangan <i class="fas fa-rocket"></i>
                </a>
            </div>
        </div>

        <div class="features">
            <div class="feature-card">
                <div class="feature-icon icon-learn mx-auto">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="feature-title">Pelajaran Seru</h3>
                <p class="text-gray-600">Belajar bahasa Inggris dengan cara yang mudah dan menyenangkan untuk anak-anak!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-game mx-auto">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h3 class="feature-title">Bermain Sambil Belajar</h3>
                <p class="text-gray-600">Asah kemampuan bahasa Inggrismu dengan permainan-permainan seru!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-progress mx-auto">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="feature-title">Kumpulkan Bintang</h3>
                <p class="text-gray-600">Dapatkan bintang dan hadiah ketika kamu menyelesaikan aktivitas belajar!</p>
            </div>
        </div>
    </div>

    <div class="footer-wave"></div>
    <footer class="py-8 bg-gray-100">
        <div class="container mx-auto text-center text-gray-500">
            <p>© 2023 Media Pembelajaran Bahasa Inggris. Dibuat dengan <i class="fas fa-heart text-red-500"></i> untuk siswa SD.</p>
        </div>
    </footer>

    <script>
        // Create floating particles
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const bubblesContainer = document.getElementById('bubbles');
            const particleCount = 20;
            const bubbleCount = 8;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random size
                const size = Math.random() * 8 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Random position
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                particle.style.left = `${posX}%`;
                particle.style.top = `${posY}%`;

                // Random animation duration and delay
                const duration = Math.random() * 6 + 4;
                const delay = Math.random() * 5;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;

                particlesContainer.appendChild(particle);
            }

            // Create bubbles
            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');

                // Random size
                const size = Math.random() * 60 + 20;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;

                // Random position
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                bubble.style.left = `${posX}%`;
                bubble.style.top = `${posY}%`;

                // Random animation duration and delay
                const duration = Math.random() * 8 + 4;
                const delay = Math.random() * 5;
                bubble.style.animationDuration = `${duration}s`;
                bubble.style.animationDelay = `${delay}s`;

                bubblesContainer.appendChild(bubble);
            }
        });
    </script>

    <!-- Scripts -->
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/@barba/core"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('components.achievement-notification')
</body>
</html>
