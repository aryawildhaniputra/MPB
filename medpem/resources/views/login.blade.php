<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Comic+Neue:wght@400;700&display=swap');

        body {
            font-family: 'Comic Neue', 'Nunito', sans-serif;
            background-color: #f0f9ff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2358cc02' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: -100px;
            left: -100px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 157, 47, 0.1), rgba(255, 104, 57, 0.15));
            z-index: -1;
        }

        body::after {
            content: "";
            position: absolute;
            bottom: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 104, 57, 0.15), rgba(255, 157, 47, 0.1));
            z-index: -1;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            padding: 3rem;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            transform: translateY(0);
            transition: all 0.3s ease;
            border: 6px solid transparent;
            background-clip: padding-box;
            border-image: linear-gradient(to right, #FF9D2F, #FF6839, #FFC107, #FFEB3B, #FF9D2F) 1;
            animation: borderColor 8s linear infinite;
        }

        @keyframes borderColor {
            0% {
                border-image: linear-gradient(to right, #FF9D2F, #FF6839, #FFC107, #FFEB3B, #FF9D2F) 1;
            }
            25% {
                border-image: linear-gradient(to right, #FF6839, #FFC107, #FFEB3B, #FF9D2F, #FF6839) 1;
            }
            50% {
                border-image: linear-gradient(to right, #FFC107, #FFEB3B, #FF9D2F, #FF6839, #FFC107) 1;
            }
            75% {
                border-image: linear-gradient(to right, #FFEB3B, #FF9D2F, #FF6839, #FFC107, #FFEB3B) 1;
            }
            100% {
                border-image: linear-gradient(to right, #FF9D2F, #FF6839, #FFC107, #FFEB3B, #FF9D2F) 1;
            }
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .login-header h1 {
            color: #FF9D2F;
            font-size: 2.75rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, #FF9D2F, #FF6839);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: float 6s ease-in-out infinite;
        }

        .login-header p {
            color: #777;
            font-size: 1.1rem;
        }

        .character {
            position: absolute;
            width: 120px;
            height: auto;
            top: -70px;
            right: -20px;
            transform: rotate(0deg);
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.2));
            z-index: 10;
        }

        .cartoon-friends {
            display: none; /* Hide cartoon friends */
        }

        .form-control {
            margin-bottom: 1.75rem;
            position: relative;
        }

        .form-label {
            display: inline-flex;
            align-items: center;
            background-color: rgba(255, 157, 47, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            transition: all 0.2s;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        /* Icon styling for consistency */
        .form-label i {
            display: inline-block;
        }

        .form-input {
            width: 100%;
            padding: 1.2rem 1.5rem;
            border: 3px solid #FFE0B2;
            border-radius: 20px;
            transition: all 0.3s;
            font-size: 1.1rem;
            background-color: #FFFAF0;
            color: #2d3748;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .form-input:focus {
            border-color: #FF9D2F;
            box-shadow: 0 0 0 3px rgba(255, 157, 47, 0.2), 0 8px 16px rgba(0, 0, 0, 0.08);
            outline: none;
            transform: translateY(-2px);
        }

        .error-message {
            color: #FF5252;
            font-size: 0.9rem;
            margin-top: 0.75rem;
            display: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            background-color: rgba(255, 82, 82, 0.1);
            border: 1px solid rgba(255, 82, 82, 0.2);
            animation: fadeIn 0.3s ease-in;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message::before {
            content: '😅';
            font-size: 1.1rem;
        }

        .error-message.active {
            display: flex;
        }

        .form-input.error {
            border-color: #FF5252;
            animation: shake 0.5s linear;
            background-color: rgba(255, 82, 82, 0.05);
        }

        .form-input.error:focus {
            border-color: #FF5252;
            box-shadow: 0 0 0 3px rgba(255, 82, 82, 0.2);
        }

        .login-button {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #FFEB3B, #FFC107);
            color: #5B3A29;
            border: none;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 0 #F57C00, 0 8px 20px rgba(255, 193, 7, 0.3);
            position: relative;
            overflow: hidden;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 0 #F57C00, 0 12px 25px rgba(255, 193, 7, 0.5);
            background: linear-gradient(135deg, #FFF176, #FFD54F);
        }

        .login-button:active {
            transform: translateY(3px);
            box-shadow: 0 2px 0 #F57C00, 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        .login-button i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
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

        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 157, 47, 0.1);
            z-index: 0;
        }

        .circle-1 {
            width: 180px;
            height: 180px;
            bottom: -90px;
            left: -90px;
        }

        .circle-2 {
            width: 120px;
            height: 120px;
            top: 40px;
            right: -60px;
        }

        .back-to-home {
            margin-top: 2rem;
            text-align: center;
        }

        .back-to-home a {
            color: #FF9D2F;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s;
            padding: 0.5rem 1rem;
            border-radius: 100px;
            background-color: rgba(255, 157, 47, 0.1);
        }

        .back-to-home a:hover {
            background-color: rgba(255, 157, 47, 0.2);
            transform: translateY(-2px);
        }

        .password-toggle {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #FF9D2F;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #FF6839;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .alert {
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            font-weight: 600;
            display: none;
        }

        .alert.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        .alert-danger {
            background-color: rgba(255, 82, 82, 0.1);
            color: #FF5252;
            border: 1px solid rgba(255, 82, 82, 0.3);
        }

        .alert-success {
            background-color: rgba(88, 204, 2, 0.1);
            color: #58CC02;
            border: 1px solid rgba(88, 204, 2, 0.3);
        }

        .form-footer {
            font-size: 0.95rem;
            color: #718096;
            text-align: center;
            margin-top: 1.8rem;
            background-color: rgba(255, 235, 59, 0.1);
            padding: 0.8rem;
            border-radius: 15px;
            box-shadow: inset 0 0 8px rgba(255, 193, 7, 0.2);
        }

        .password-rules {
            display: none;
        }

        .flying-items {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .flying-item {
            position: absolute;
            width: 35px;
            height: 35px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.7;
            animation: flyAround 15s linear infinite;
        }

        @keyframes flyAround {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(30vw, 20vh) rotate(90deg);
            }
            50% {
                transform: translate(10vw, 40vh) rotate(180deg);
            }
            75% {
                transform: translate(-20vw, 20vh) rotate(270deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-10px) rotate(5deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            20%, 60% {
                transform: translateX(-5px);
            }
            40%, 80% {
                transform: translateX(5px);
            }
        }

        @media (max-width: 768px) {
            .login-container {
                max-width: 90%;
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 2.2rem;
            }

            .cartoon-friends {
                width: 80px;
            }

            .flying-item {
                width: 25px;
                height: 25px;
            }
        }

        /* Mobile phone specific styles */
        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .login-container {
                padding: 1.5rem;
                max-width: 100%;
                margin: 0 0.5rem;
            }

            .decorative-circle {
                display: none;
            }

            .login-header h1 {
                font-size: 1.8rem;
            }

            .login-header p {
                font-size: 0.95rem;
            }

            .star {
                width: 25px;
                height: 25px;
            }

            .header-decoration {
                height: 50px;
            }

            .form-label {
                font-size: 0.95rem;
                padding: 0.4rem 0.8rem;
            }

            .form-input {
                padding: 0.9rem 1rem;
                font-size: 1rem;
            }

            .password-toggle {
                top: 2.7rem;
            }

            .login-button {
                padding: 1rem;
                font-size: 1rem;
            }

            .form-footer {
                font-size: 0.85rem;
                padding: 0.6rem;
                margin-top: 1.2rem;
            }

            .back-to-home {
                margin-top: 1.5rem;
            }

            .back-to-home a {
                font-size: 0.9rem;
            }

            .flying-items {
                opacity: 0.5;
            }

            .flying-item {
                width: 20px;
                height: 20px;
            }
        }

        /* Small mobile phone styles */
        @media (max-width: 360px) {
            .login-header h1 {
                font-size: 1.6rem;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .login-button {
                padding: 0.9rem;
            }
        }

        .header-decoration {
            display: none;
        }

        .star {
            display: none;
        }

        .flying-items {
            display: none;
        }

        /* iOS specific fixes */
        @media screen and (-webkit-min-device-pixel-ratio: 0) {
            .form-input {
                font-size: 16px; /* Prevents iOS zoom on focus */
            }

            input, button, a {
                -webkit-touch-callout: none;
            }

            .login-button {
                cursor: pointer;
                -webkit-touch-callout: none;
                touch-action: manipulation;
            }
        }
    </style>
</head>
<body>
    <div class="flying-items" id="flying-items"></div>

    <div class="login-container">
        <div class="decorative-circle circle-1"></div>
        <div class="decorative-circle circle-2"></div>

        <div class="login-header">
            <h1>Halo Teman!</h1>
            <p>Yuk masuk untuk mulai petualangan belajarmu!</p>
        </div>

        <!-- Alert messages container -->
        <div id="alert-danger" class="alert alert-danger">
            <i class="fas fa-exclamation-circle mr-2"></i> <span id="alert-message">Username atau password salah</span>
        </div>

        <form action="{{ route('login') }}" method="POST" class="relative z-10" id="login-form">
            @csrf
            <div class="form-control">
                <label for="username" class="form-label">
                    <i class="fas fa-user text-yellow-500 mr-2"></i>Nama Pengguna
                </label>
                <input type="text" name="username" id="username" class="form-input @error('username') error @enderror" placeholder="Ketik nama pengguna kamu di sini" value="{{ old('username') }}" required>
                @error('username')
                    <div class="error-message active">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="password" class="form-label">
                    <i class="fas fa-key text-yellow-500 mr-2"></i>Kata Sandi
                </label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="form-input @error('password') error @enderror" placeholder="Ketik kata sandi rahasiamu di sini" required>
                    <span class="password-toggle" id="password-toggle">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <div class="error-message active">{{ $message }}</div>
                @enderror
                @if(session('error'))
                    <div class="error-message active">{{ session('error') }}</div>
                @endif
            </div>

            <button type="submit" class="login-button" id="login-button">
                <i class="fas fa-rocket"></i> Mulai Petualangan!
            </button>

            <div class="form-footer">
                Dengan masuk, kamu bisa mulai belajar dan bermain bersama teman-teman!
            </div>
        </form>
    </div>

    <div class="back-to-home">
        <a href="/">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Awal
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const passwordToggle = document.getElementById('password-toggle');
            const loginButton = document.getElementById('login-button');
            const flyingItemsContainer = document.getElementById('flying-items');

            // Create flying items
            const flyingItemsCount = 6;
            const flyingItemsImages = [
                'https://cdn-icons-png.flaticon.com/512/4329/4329979.png', // book
                'https://cdn-icons-png.flaticon.com/512/5765/5765355.png', // pencil
                'https://cdn-icons-png.flaticon.com/512/7749/7749982.png', // abc block
                'https://cdn-icons-png.flaticon.com/512/4727/4727496.png', // star
                'https://cdn-icons-png.flaticon.com/512/6357/6357059.png', // balloon
                'https://cdn-icons-png.flaticon.com/512/6941/6941697.png'  // rocket
            ];

            for (let i = 0; i < flyingItemsCount; i++) {
                const flyingItem = document.createElement('div');
                flyingItem.classList.add('flying-item');

                // Random image
                const randomImageIndex = Math.floor(Math.random() * flyingItemsImages.length);
                flyingItem.style.backgroundImage = `url('${flyingItemsImages[randomImageIndex]}')`;

                // Random starting position
                const posX = Math.random() * window.innerWidth;
                const posY = Math.random() * window.innerHeight;
                flyingItem.style.left = `${posX}px`;
                flyingItem.style.top = `${posY}px`;

                // Random animation duration and delay
                const duration = Math.random() * 10 + 15;
                const delay = Math.random() * 5;
                flyingItem.style.animationDuration = `${duration}s`;
                flyingItem.style.animationDelay = `${delay}s`;

                flyingItemsContainer.appendChild(flyingItem);
            }

            // Toggle password visibility
            passwordToggle.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                passwordToggle.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
        });
    </script>
</body>
</html>
