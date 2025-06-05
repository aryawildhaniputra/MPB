<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MPBing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        body {
            font-family: 'Comic Neue', 'Nunito', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            background-image:
                url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg'),
                url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg'),
                url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4da.svg'),
                url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f680.svg'),
                url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f308.svg');
            background-size: 120px, 80px, 150px, 100px, 150px;
            background-position: 5% 10%, 95% 15%, 90% 90%, 10% 85%, 85% 5%;
            background-repeat: no-repeat;
            background-blend-mode: soft-light;
            background-opacity: 0.1;
            overflow-x: hidden;
        }

        .main-content {
            min-height: calc(100vh - 70px);
            margin-left: 250px;
            padding-top: 80px;
            padding-bottom: 2rem;
            transition: all 0.3s;
            width: calc(100% - 250px);
        }

        .welcome-banner {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(30, 41, 59, 0.9));
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            box-shadow: 0 20px 30px -15px rgba(2, 6, 23, 0.5);
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin-bottom: 2rem;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f389.svg'),
                        url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f3c6.svg');
            background-position: 95% 20%, 5% 80%;
            background-size: 80px, 80px;
            background-repeat: no-repeat;
            opacity: 0.2;
            z-index: -1;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(90deg, #58CC02, #1CB0F6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            font-family: 'Comic Neue', cursive;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.2);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.8);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .wide-card {
            grid-column: span 6;
        }

        .small-card {
            grid-column: span 4;
        }

        .full-card {
            grid-column: span 12;
        }

        @media (max-width: 1280px) {
            .small-card {
                grid-column: span 6;
            }
            .wide-card {
                grid-column: span 12;
            }
        }

        @media (max-width: 768px) {
            .small-card {
                grid-column: span 12;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 80px 1rem 2rem;
            }
            .welcome-title {
                font-size: 2rem;
            }

            /* Mobile specific adjustments */
            .dashboard-grid {
                gap: 1rem;
                margin: 0;
            }

            .welcome-banner {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .adventure-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .adventure-card {
                padding: 1.25rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 2rem;
            }

            .content-title {
                font-size: 2.5rem;
                padding: 0.4rem 1.5rem;
            }

            .subtitle {
                font-size: 1.1rem;
                padding: 0.4rem;
            }

            /* Table responsiveness */
            .leaderboard-table {
                font-size: 0.8rem;
            }

            .leaderboard-table th,
            .leaderboard-table td {
                padding: 0.5rem 0.25rem;
            }

            /* Achievement section mobile */
            .pencapaian-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .pencapaian-icon {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .pencapaian-name {
                font-size: 0.7rem;
                min-height: 24px;
                padding: 4px 6px;
            }

            /* Progress bars mobile */
            .progress-bar-container {
                height: 12px;
                margin: 0.5rem 0;
            }
        }

        @media (max-width: 640px) {
            .main-content {
                padding: 80px 0.75rem 1.5rem;
            }

            .welcome-banner {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .welcome-title {
                font-size: 1.75rem;
                margin-bottom: 0.75rem;
            }

            .dashboard-grid {
                gap: 0.75rem;
            }

            .stat-card {
                padding: 0.75rem;
                border-radius: 10px;
            }

            .stat-value {
                font-size: 1.75rem;
                margin-bottom: 0.25rem;
            }

            .stat-label {
                font-size: 0.9rem;
            }

            .adventure-card {
                padding: 1rem;
            }

            .adventure-card .icon {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }

            .adventure-card h4 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }

            .adventure-card p {
                font-size: 0.85rem;
                margin-bottom: 1rem;
            }

            .kid-button {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }

            .content-title {
                font-size: 2rem;
                padding: 0.3rem 1rem;
            }

            .subtitle {
                font-size: 1rem;
                padding: 0.3rem;
            }

            /* Responsive table - stack on mobile */
            .leaderboard-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                font-size: 0.75rem;
            }

            /* Achievement section - smaller on mobile */
            .pencapaian-icon {
                width: 35px;
                height: 35px;
                font-size: 16px;
                margin-bottom: 6px;
            }

            .pencapaian-name {
                font-size: 0.65rem;
                min-height: 20px;
                padding: 3px 5px;
                line-height: 1.1;
            }

            .pencapaian-count {
                font-size: 0.65rem;
                padding: 1px 6px;
                margin-top: 4px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 75px 0.5rem 1rem;
            }

            .welcome-banner {
                padding: 0.75rem;
                border-radius: 12px;
            }

            .welcome-title {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
                line-height: 1.2;
            }

            .welcome-banner p {
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .dashboard-grid {
                gap: 0.5rem;
            }

            .stat-card {
                padding: 0.6rem;
                border-radius: 8px;
            }

            .stat-value {
                font-size: 1.5rem;
                margin-bottom: 0.2rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }

            .card-icon {
                font-size: 1.25rem;
                top: 0.75rem;
                right: 0.75rem;
            }

            .adventure-card {
                padding: 0.75rem;
            }

            .adventure-card .icon {
                font-size: 1.75rem;
                margin-bottom: 0.5rem;
            }

            .adventure-card h4 {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
            }

            .adventure-card p {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
                line-height: 1.3;
            }

            .kid-button {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
                border-radius: 25px;
            }

            .content-title {
                font-size: 1.75rem;
                padding: 0.25rem 0.75rem;
                margin-bottom: 0.75rem;
            }

            .subtitle {
                font-size: 0.9rem;
                padding: 0.25rem;
                margin-bottom: 1.5rem;
            }

            /* Progress section mobile optimization */
            .progress-bar-container {
                height: 10px;
                margin: 0.4rem 0;
                border-radius: 8px;
            }

            .progress-label {
                font-size: 0.75rem;
            }

            /* Achievement section - very compact for small screens */
            .pencapaian-grid {
                gap: 8px;
            }

            .pencapaian-icon {
                width: 30px;
                height: 30px;
                font-size: 14px;
                margin-bottom: 4px;
            }

            .pencapaian-name {
                font-size: 0.6rem;
                min-height: 18px;
                padding: 2px 4px;
                margin: 4px 0;
            }

            .pencapaian-count {
                font-size: 0.6rem;
                padding: 1px 4px;
                margin-top: 2px;
            }

            .pencapaian-title {
                font-size: 1rem;
                margin-bottom: 8px;
            }

            .pencapaian-footer {
                margin-top: 10px;
                padding: 8px;
                font-size: 0.75rem;
            }

            /* Notification adjustments */
            .success-notification {
                width: calc(100% - 20px);
                max-width: calc(100% - 20px);
                right: 10px;
                left: 10px;
                padding: 10px 15px;
                top: 85px;
            }

            .success-notification .icon {
                font-size: 1.1rem;
                margin-right: 8px;
            }

            .success-notification .message {
                font-size: 0.85rem;
            }

            /* Table mobile - horizontal scroll */
            .leaderboard-table {
                min-width: 400px;
            }

            .leaderboard-table th,
            .leaderboard-table td {
                padding: 0.4rem 0.2rem;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 360px) {
            .main-content {
                padding: 70px 0.25rem 0.75rem;
            }

            .welcome-title {
                font-size: 1.25rem;
                margin-bottom: 0.4rem;
            }

            .welcome-banner {
                padding: 0.5rem;
            }

            .welcome-banner p {
                font-size: 0.8rem;
                line-height: 1.3;
            }

            .stat-card {
                padding: 0.5rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .stat-label {
                font-size: 0.75rem;
            }

            .adventure-card {
                padding: 0.6rem;
            }

            .adventure-card .icon {
                font-size: 1.5rem;
            }

            .adventure-card h4 {
                font-size: 0.85rem;
            }

            .adventure-card p {
                font-size: 0.75rem;
                line-height: 1.2;
            }

            .kid-button {
                padding: 0.4rem 0.6rem;
                font-size: 0.75rem;
            }

            .content-title {
                font-size: 1.5rem;
                padding: 0.2rem 0.5rem;
            }

            .subtitle {
                font-size: 0.8rem;
                padding: 0.2rem;
            }

            .pencapaian-icon {
                width: 25px;
                height: 25px;
                font-size: 12px;
            }

            .pencapaian-name {
                font-size: 0.55rem;
                min-height: 16px;
                padding: 1px 3px;
                line-height: 1;
            }

            .pencapaian-title {
                font-size: 0.9rem;
            }

            .card-icon {
                font-size: 1rem;
                top: 0.5rem;
                right: 0.5rem;
            }
        }

        .adventure-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.25rem;
            width: 100%;
        }

        .adventure-card {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 16px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .adventure-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .progress-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.8));
            border: 2px solid rgba(56, 189, 248, 0.2);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin: 0.5rem 0;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 1rem;
            font-weight: 600;
        }

        .card-icon {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            font-size: 2rem;
            opacity: 0.8;
            color: rgba(255, 255, 255, 0.5);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-family: 'Comic Neue', cursive;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .stat-label {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            font-family: 'Comic Neue', cursive;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .progress-bar-container {
            height: 18px;
            background: rgba(15, 23, 42, 0.7);
            border-radius: 12px;
            overflow: hidden;
            margin: 0.75rem 0 0.5rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .progress-bar {
            height: 100%;
            border-radius: 12px;
            transition: width 1s ease-in-out;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .learning-path {
            position: relative;
            padding-left: 30px;
            margin-top: 1.5rem;
        }

        .path-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .path-item:before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0ea5e9;
            z-index: 1;
        }

        .path-item:after {
            content: '';
            position: absolute;
            left: -21px;
            top: 20px;
            width: 2px;
            height: calc(100% - 20px);
            background: #1e3a8a;
        }

        .path-item:last-child:after {
            display: none;
        }

        .path-title {
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 0.25rem;
        }

        .path-subtitle {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .badge-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .badge {
            width: 70px;
            height: 70px;
            background: rgba(15, 23, 42, 0.6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            position: relative;
            transition: all 0.3s ease;
            cursor: help;
            margin: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .badge.earned {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
            animation: pulse-badge 2s infinite;
        }

        .badge.locked {
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .badge:hover {
            transform: scale(1.15);
            z-index: 10;
        }

        .badge.earned:hover::after {
            content: attr(title);
            position: absolute;
            bottom: -45px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.7rem;
            white-space: nowrap;
            z-index: 20;
        }

        .badge.locked:hover::after {
            content: attr(title);
            position: absolute;
            bottom: -45px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.7rem;
            white-space: nowrap;
            z-index: 20;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes floatUpDown {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .float-animation {
            animation: floatUpDown 3s ease-in-out infinite;
        }

        .suggestions-carousel {
            overflow-x: auto;
            padding: 1rem 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
            scroll-behavior: smooth;
            display: flex;
            flex-wrap: nowrap;
            gap: 1rem;
            position: relative;
        }

        .suggestions-carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            padding: 0 25px;
            overflow: visible;
        }

        .carousel-nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background-color: rgba(15, 23, 42, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
            z-index: 5;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            transition: all 0.2s ease;
        }

        .carousel-nav-button:hover {
            background-color: rgba(56, 189, 248, 0.9);
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav-button i {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .carousel-nav-button.prev {
            left: 5px;
        }

        .carousel-nav-button.next {
            right: 5px;
        }

        @media (max-width: 768px) {
            .suggestions-carousel {
                gap: 0.75rem;
                padding-bottom: 1.5rem;
            }

            .suggestion-card {
                min-width: 230px;
                padding: 1.25rem;
            }

            .carousel-nav-button {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                background-color: rgba(30, 41, 59, 0.98);
                border-width: 2px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            }

            .carousel-container {
                padding: 0 20px;
                margin: 0 5px;
            }
        }

        @media (max-width: 480px) {
            .suggestions-carousel {
                gap: 0.5rem;
                flex-direction: row;
                align-items: stretch;
            }

            .suggestion-card {
                min-width: 85%;
                width: 85%;
                margin-bottom: 0;
            }

            .carousel-nav-button {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }
        }

        .suggestion-card {
            min-width: 270px;
            flex: 0 0 auto;
            padding: 1.5rem;
            background: rgba(30, 41, 59, 0.6);
            border-radius: 16px;
            border: 3px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .suggestion-card:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        @keyframes shine {
            0% { background-position: -100px; }
            100% { background-position: 200px; }
        }

        .achievement-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-size: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
            position: relative;
        }

        .achievement-name {
            font-size: 0.9rem;
            font-weight: 700;
            text-align: center;
            color: white; /* Bright white for better visibility */
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .achievement-desc {
            font-size: 0.75rem;
            text-align: center;
            color: #e2e8f0; /* Lighter color for better visibility */
            line-height: 1.2;
        }

        .achievement-icon.earned {
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.7);
        }

        .achievement-icon.earned::after {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            width: calc(100% + 20px);
            height: calc(100% + 20px);
            background: linear-gradient(45deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0) 100%);
            animation: shine 3s infinite;
        }

        .achievement-icon.locked {
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .achievement-card {
            transition: all 0.3s ease;
        }

        .achievement-card:hover {
            transform: translateY(-5px);
        }

        .achievements-container {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border-radius: 15px;
            background: rgba(15, 23, 42, 0.4);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .pencapaian-title {
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .pencapaian-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        @media (max-width: 1400px) {
            .pencapaian-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 1200px) {
            .pencapaian-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pencapaian-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .pencapaian-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .pencapaian-name {
                font-size: 0.7rem;
                min-height: 32px;
            }
        }

        .pencapaian-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(15, 23, 42, 0.6);
            border-radius: 12px;
            padding: 12px 8px;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            height: 100%;
            justify-content: center;
            box-sizing: border-box;
        }

        .pencapaian-item:hover {
            transform: translateY(-5px);
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            z-index: 5;
        }

        .pencapaian-name {
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            text-align: center;
            line-height: 1.2;
            width: 88%;
            padding: 6px 8px;
            margin: 8px 0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            background-color: rgba(15, 23, 42, 0.7);
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            min-height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            word-break: break-word;
            white-space: normal;
            hyphens: auto;
            overflow-wrap: break-word;
        }

        .pencapaian-item:hover .pencapaian-name {
            background-color: rgba(79, 70, 229, 0.4);
            border-color: rgba(99, 102, 241, 0.5);
        }

        .pencapaian-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 22px;
            color: white;
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .pencapaian-item:hover .pencapaian-icon {
            animation: pulse-badge 1.5s infinite;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.5);
            transform: scale(1.1);
        }

        .pencapaian-icon.earned {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.7);
        }

        .pencapaian-icon.locked {
            background: rgba(75, 85, 99, 0.4);
            color: rgba(255, 255, 255, 0.4);
            filter: grayscale(1);
        }

        .pencapaian-count {
            color: white;
            font-weight: bold;
            font-size: 0.75rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 2px 8px;
            margin-top: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .pencapaian-tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: rgba(15, 23, 42, 0.95);
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 0.7rem;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: all 0.2s ease;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin-bottom: 5px;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .pencapaian-item:hover .pencapaian-tooltip {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .pencapaian-tooltip:after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: rgba(15, 23, 42, 0.95) transparent transparent transparent;
        }

        .pencapaian-footer {
            margin-top: 15px;
            text-align: center;
            color: #e2e8f0;
            font-size: 0.85rem;
            background: rgba(15, 23, 42, 0.4);
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* New fun elements for kids */
        .fun-badge {
            position: absolute;
            width: 60px;
            height: 60px;
            filter: drop-shadow(2px 2px 3px rgba(0,0,0,0.3));
            z-index: 2;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .star-right {
            top: -15px;
            right: -15px;
        }

        .star-left {
            bottom: -10px;
            left: -10px;
        }

        .confetti-effect {
            pointer-events: none;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1000;
        }

        .emoji-bullet {
            display: inline-block;
            margin-right: 5px;
            font-size: 1.2em;
        }

        /* Achievement Modal Styles */
        .achievement-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .achievement-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .achievement-modal-content {
            background: linear-gradient(135deg, #1F2937, #374151);
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
            border: 3px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            padding: 2rem;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .achievement-modal.show .achievement-modal-content {
            transform: scale(1);
        }

        .achievement-modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.3);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }

        .achievement-modal-close:hover {
            background: rgba(239, 68, 68, 0.8);
            transform: scale(1.1);
        }

        .achievement-modal-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .achievement-modal-icon.earned {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            animation: pulse-badge 2s infinite;
        }

        .achievement-modal-icon.locked {
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .achievement-modal-title {
            font-size: 1.5rem;
            font-weight: 800;
            text-align: center;
            color: white;
            margin-bottom: 0.5rem;
        }

        .achievement-modal-description {
            font-size: 1rem;
            text-align: center;
            color: #e2e8f0;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .achievement-modal-reward {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 10px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .achievement-modal-points {
            font-size: 1.5rem;
            font-weight: 800;
            color: #FFD700;
        }

        .achievement-modal-progress {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .achievement-modal-progress-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .achievement-modal-progress-bar {
            height: 10px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .achievement-modal-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4338ca, #6366f1);
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .achievement-modal-progress-text {
            font-size: 0.8rem;
            color: #e2e8f0;
            text-align: center;
        }

        /* Kid button styles optimized for continue button */
        .kid-button {
            background: linear-gradient(145deg, #58CC02, #1CB0F6);
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            letter-spacing: 0.5px;
        }

        .kid-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
        }

        .kid-button i {
            font-size: 1.2em;
            margin-right: 8px;
        }

        @media (max-width: 480px) {
            .kid-button {
                padding: 10px 18px;
                font-size: 14px;
                width: 100%;
            }

            .suggestion-card .kid-button {
                width: 90%;
            }
        }

        /* Mobile Achievement Card */
        .mobile-achievement-card {
            display: none;
            background: linear-gradient(135deg, #be185d, #ec4899);
            border-radius: 16px;
            padding: 1.25rem;
            margin: 1rem 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .mobile-achievement-card .medal-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.75rem;
            color: rgba(0, 0, 0, 0.2);
        }

        .mobile-achievement-card h3 {
            font-size: 1.25rem;
            font-weight: bold;
            color: white;
            margin-bottom: 0.5rem;
        }

        .mobile-achievement-card .count {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
        }

        .mobile-achievement-card p {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        @media (max-width: 768px) {
            .mobile-achievement-card {
                display: block;
            }
        }

        /* Remove old carousel styles and replace with grid styles */
        .adventure-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            width: 100%;
        }

        .adventure-card {
            background: rgba(30, 41, 59, 0.6);
            border-radius: 16px;
            border: 3px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .adventure-card:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .adventure-card .icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .adventure-card h4 {
            font-weight: bold;
            color: white;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            text-align: center;
        }

        .adventure-card p {
            color: #e2e8f0;
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
            text-align: center;
            flex-grow: 1;
        }

        .adventure-card .button-container {
            margin-top: auto;
            display: flex;
            justify-content: center;
        }

        .adventure-card .kid-button {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            justify-content: center;
            background: linear-gradient(145deg, #4A90E2, #67B26F);
            border: 2px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .adventure-card .kid-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        .adventure-card:nth-child(1) .kid-button {
            background: linear-gradient(145deg, #4A90E2, #5A3F99);
        }

        .adventure-card:nth-child(2) .kid-button {
            background: linear-gradient(145deg, #67B26F, #4ca2cd);
        }

        .adventure-card:nth-child(3) .kid-button {
            background: linear-gradient(145deg, #f6d365, #ff9500);
        }

        .adventure-card:nth-child(4) .kid-button {
            background: linear-gradient(145deg, #FF5E62, #FF9966);
        }

        .adventure-section {
            background: rgba(23, 33, 51, 0.6);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.1);
        }

        .adventure-section h3 {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            font-weight: bold;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .adventure-section h3:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            height: 4px;
            width: 80%;
            background: linear-gradient(90deg, #4A90E2, transparent);
            border-radius: 2px;
        }

        /* Media queries for adventure grid */
        @media (max-width: 1024px) {
            .adventure-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .adventure-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .adventure-card {
                padding: 1.25rem;
            }

            .adventure-section {
                padding: 1.5rem;
            }
        }

        /* Action button styles for courses */
        .action-buttons-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 12px;
            margin-top: 10px;
        }

        .action-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        .progress-info {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: white;
            font-weight: 500;
        }

        .suggestion-title {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: white;
            font-family: 'Comic Neue', cursive;
        }

        .suggestion-desc {
            font-size: 0.9rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .leaderboard-table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: white; /* Ensuring table headers are visible */
            font-weight: 600;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .leaderboard-table td {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: white; /* Making table data white for visibility */
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .leaderboard-table tr:hover td {
            background: rgba(30, 64, 175, 0.2);
        }

        .leaderboard-user {
            background: rgba(30, 64, 175, 0.3);
            font-weight: 600;
        }

        .leaderboard-rank {
            font-weight: 700;
            width: 40px;
            text-align: center;
        }

        .rank-1 {
            color: gold !important;
            text-shadow: 0 0 5px rgba(255, 215, 0, 0.7);
        }

        .rank-2 {
            color: silver !important;
            text-shadow: 0 0 5px rgba(192, 192, 192, 0.7);
        }

        .rank-3 {
            color: #cd7f32 !important; /* bronze */
            text-shadow: 0 0 5px rgba(205, 127, 50, 0.7);
        }

        .achievement-count-badge {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: white;
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 1.1rem;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .achievement-count-badge i {
            font-size: 1.2rem;
            color: #FFD700;
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.3));
        }

        .total-points-indicator {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 12px;
            padding: 8px 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(99, 102, 241, 0.3);
            font-weight: 600;
        }

        .total-points-number {
            color: #FFD700;
            font-weight: bold;
            font-size: 1.1rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Override for specific achievement names that might be longer */
        .pencapaian-item[data-name="Pembelajar Bersemangat"] .pencapaian-name,
        .pencapaian-item[data-name="Rajin Pantang Menyerah"] .pencapaian-name,
        .pencapaian-item[data-name="Petualang Pengetahuan"] .pencapaian-name,
        .pencapaian-item[data-name="Pemecah Masalah"] .pencapaian-name {
            font-size: 0.7rem;
            line-height: 1.1;
        }

        /* Success notification */
        .success-notification {
            position: fixed;
            top: 90px;
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

        /* Mobile responsiveness for notification */
        @media (max-width: 768px) {
            .success-notification {
                right: 10px;
                max-width: 280px;
                padding: 12px 20px;
            }
        }

        @media (max-width: 480px) {
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

        .rank-card {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            border: 3px solid #818cf8;
        }

        .points-card {
            background: linear-gradient(135deg, #0369a1, #0ea5e9);
            border: 3px solid #38bdf8;
        }

        .streak-card {
            background: linear-gradient(135deg, #b45309, #f59e0b);
            border: 3px solid #fbbf24;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #4a5af0;
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
            background: #4a5af0;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>
<body>
    @include('header')
    @include('components.duplicate-login-modal')
    <div class="flex">
        @include('sidebar')

        <div class="main-content px-4 md:px-6">
            <!-- Success notification for learning completion -->
            @if(session('learning_completed'))
            <div class="success-notification" id="learningNotification">
                <span class="icon">✓</span>
                <span class="message">{{ session('learning_completed') }}</span>
            </div>
            @endif

            {{-- <div class="container mx-auto">
                <div class="text-center mb-8 px-6">
                    <h1 class="content-title">
                        DASHBOARD <i class="fas fa-home ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Selamat datang di panel utama pembelajaran Bahasa Inggris!</p>
                </div>
                <div class="gradient-border"></div>
            </div> --}}

            <div class="welcome-banner">
                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg" class="fun-badge star-right" alt="Star">
                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg" class="fun-badge star-left" alt="Star">
                <h1 class="welcome-title">Halo, {{ $user->name }}! 👋</h1>
                <p class="text-xl text-white max-w-2xl">
                    <span class="emoji-bullet">🎮</span> Selamat datang kembali di petualangan belajarmu!<br>
                    {{-- <span class="emoji-bullet">🔥</span> Kamu sudah belajar <span class="font-bold text-yellow-300 text-2xl">{{ $stats['learning_streak'] }} hari berturut-turut</span>.<br> --}}
                    <span class="emoji-bullet">⭐</span> Terus semangat untuk jadi juara kelas!
                </p>
            </div>

            <div class="dashboard-grid">
                <!-- Stats Row -->
                <div class="stat-card small-card">
                    <div class="card-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-label">Peringkatmu</div>
                    <div class="stat-value">#{{ $stats['rank'] }}</div>
                    <p class="text-sm text-gray-300 mt-2">
                        @if($stats['rank'] <= 3)
                            Wow! Kamu juara kelas! 🎉
                        @elseif($stats['rank'] <= 10)
                            Hebat! Kamu masuk 10 besar!
                        @else
                            {{ 50 - $stats['rank'] > 0 ? 'Kamu sudah mengalahkan ' . (50 - $stats['rank']) . ' teman!' : 'Ayo belajar lebih giat!' }}
                        @endif
                    </p>
                </div>

                <div class="stat-card small-card">
                    <div class="card-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="stat-label">Penghargaan</div>
                    <div class="stat-value">{{ $stats['total_points'] > 0 ? $stats['total_points'] : '0' }}</div>
                    <p class="text-sm text-gray-300 mt-2">
                        {{ $stats['total_points'] < 50 ? 'Terus belajar untuk mendapatkan penghargaan!' : 'Hebat! Pertahankan semangatmu!' }}
                    </p>
                </div>

                <div class="stat-card small-card">
                    <div class="card-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-label">Materi Selesai</div>
                    <div class="stat-value">{{ $stats['completed_materials'] ?? 0 }}/{{ $stats['total_materials'] ?? 0 }}</div>
                    <p class="text-sm text-gray-300 mt-2">
                        {{ $stats['materi_percentage'] ?? 0 }}% materi telah diselesaikan
                    </p>
                </div>

                <!-- Progress Section -->
                <div class="stat-card wide-card progress-card">
                    <h3 class="text-xl font-bold text-white mb-4">Progres Belajar</h3>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-300">Materi Diselesaikan</span>
                            <span class="text-blue-400 font-semibold">{{ $stats['completed_materials'] ?? 0 }} materi</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar bg-blue-500" style="width: {{ $stats['materi_percentage'] ?? 0 }}%"></div>
                        </div>
                        <div class="text-xs text-right text-blue-300 mt-1">{{ $stats['materi_percentage'] ?? 0 }}% dari total {{ $stats['total_materials'] ?? 0 }} materi</div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <a href="{{ route('user.materi.index') }}" class="kid-button">
                            <i class="fas fa-book"></i> LIHAT MATERI
                        </a>
                    </div>
                </div>

                <!-- Popular Materials -->
                <div class="stat-card wide-card">
                    <h3 class="text-xl font-bold text-white mb-4">Materi Populer</h3>
                    <div class="space-y-3">
                        @foreach($popularMaterials as $material)
                            <div class="flex items-center bg-opacity-30 bg-blue-900 rounded-xl p-3 hover:bg-opacity-40 transition-all">
                                <div class="p-2 bg-blue-500 bg-opacity-20 rounded-full mr-3">
                                    <i class="fas fa-book text-blue-400"></i>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-white">{{ $material->title }}</h4>
                                    <p class="text-sm text-gray-300">{{ Str::limit($material->description ?? 'Materi belajar bahasa Inggris', 50) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('user.materi.index') }}" class="kid-button">
                            <i class="fas fa-book"></i> LIHAT SEMUA
                        </a>
                    </div>
                </div>

                <!-- Adventure Section -->
                <div class="stat-card full-card">
                    <h3 class="text-xl font-bold text-white mb-4">Petualangan Selanjutnya</h3>
                    <div class="adventure-grid">
                        <div class="adventure-card">
                            <div class="icon">📚</div>
                            <h4 class="text-lg font-semibold text-white mb-2">Materi Baru</h4>
                            <p class="text-gray-300 mb-4">Jelajahi materi-materi baru yang seru untuk kamu pelajari!</p>
                            <div class="mt-auto">
                                <a href="{{ route('user.materi.index') }}" class="kid-button w-full">
                                    <i class="fas fa-book"></i> Lihat Materi
                                </a>
                            </div>
                        </div>

                        <div class="adventure-card">
                            <div class="icon">🎯</div>
                            <h4 class="text-lg font-semibold text-white mb-2">Latihan Seru</h4>
                            <p class="text-gray-300 mb-4">Lanjutkan pelajaran yang sedang kamu pelajari!</p>
                            <div class="mt-auto">
                                <a href="{{ route('belajar.index') }}" class="kid-button w-full">
                                    <i class="fas fa-graduation-cap"></i> Belajar
                                </a>
                            </div>
                        </div>

                        <div class="adventure-card">
                            <div class="icon">🏆</div>
                            <h4 class="text-lg font-semibold text-white mb-2">Papan Juara</h4>
                            <p class="text-gray-300 mb-4">Lihat peringkatmu dan teman-teman sekelasmu!</p>
                            <div class="mt-auto">
                                <a href="{{ route('leaderboard') }}" class="kid-button w-full">
                                    <i class="fas fa-crown"></i> Juara Kelas
                                </a>
                            </div>
                        </div>

                        <div class="adventure-card">
                            <div class="icon">🎮</div>
                            <h4 class="text-lg font-semibold text-white mb-2">Permainan Edukatif</h4>
                            <p class="text-gray-300 mb-4">Belajar sambil bermain permainan seru!</p>
                            <div class="mt-auto">
                                <a href="{{ route('permainan.index') }}" class="kid-button w-full">
                                    <i class="fas fa-gamepad"></i> Main Game
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Achievement Modal - Removed -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add some fun interactive elements for kids
            const addFloatingAnimation = () => {
                const cards = document.querySelectorAll('.stat-card');
                cards.forEach(card => {
                    card.style.animationDelay = Math.random() * 2 + 's';
                    card.classList.add('float-animation');
                });
            };

            // Only animate on larger screens to avoid performance issues on mobile
            if (window.innerWidth > 768) {
                addFloatingAnimation();
            }

            // Handle success notifications
            const successNotification = document.getElementById('learningNotification');
            if (successNotification) {
                // Show the notification with animation
                setTimeout(() => {
                    successNotification.classList.add('show');
                }, 100);

                // Auto-hide notifications after 5 seconds
                setTimeout(() => {
                    successNotification.style.opacity = '0';
                    successNotification.style.transform = 'translateX(100px)';
                    setTimeout(() => {
                        successNotification.style.display = 'none';
                    }, 500);
                }, 5000);
            }

            // Achievement Modal Functionality - Removed

            // Carousel Navigation
            const carousel = document.getElementById('suggestionsCarousel');
            const prevButton = document.getElementById('prevSuggestion');
            const nextButton = document.getElementById('nextSuggestion');

            if (carousel && prevButton && nextButton) {
                // Calculate scroll amount based on card width (including gap)
                const scrollAmount = () => {
                    const cards = carousel.querySelectorAll('.suggestion-card');
                    if (cards.length > 0) {
                        const card = cards[0];
                        // Get width + margin + gap
                        return card.offsetWidth + 16; // Card width + gap
                    }
                    return 300; // Default fallback
                };

                // Previous button click
                prevButton.addEventListener('click', () => {
                    carousel.scrollBy({ left: -scrollAmount(), top: 0, behavior: 'smooth' });
                });

                // Next button click
                nextButton.addEventListener('click', () => {
                    carousel.scrollBy({ left: scrollAmount(), top: 0, behavior: 'smooth' });
                });

                // Hide/show arrows based on scroll position
                const updateArrowVisibility = () => {
                    // Show/hide prev button based on scroll position
                    if (carousel.scrollLeft <= 10) {
                        prevButton.style.opacity = '0.5';
                    } else {
                        prevButton.style.opacity = '1';
                    }

                    // Show/hide next button based on scroll position
                    if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth - 10) {
                        nextButton.style.opacity = '0.5';
                    } else {
                        nextButton.style.opacity = '1';
                    }
                };

                // Initial update
                updateArrowVisibility();

                // Update on scroll
                carousel.addEventListener('scroll', updateArrowVisibility);

                // Update on resize
                window.addEventListener('resize', updateArrowVisibility);
            }
        });
    </script>
</body>
</html>
