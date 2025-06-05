<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Peringkat - Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background-color: #151b2e;
            color: #ffffff;
            min-height: 100vh;
            position: relative;
        }

        /* Fix untuk header dropdown pada halaman leaderboard */
        .header-dropdown-container {
            z-index: 1000;
        }

        #userDropdownDiv {
            z-index: 1001;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #FF9500;
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
            background: #FF9500;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        /* Mobile responsive header */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 80px;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .content-title {
                font-size: 2rem;
                padding: 0.3rem 1rem;
                margin-bottom: 0.75rem;
            }

            .subtitle {
                font-size: 0.95rem;
                padding: 0.3rem 0.75rem;
                margin-bottom: 1.25rem;
            }

            .gradient-border {
                margin-bottom: 1rem;
                height: 3px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding-top: 75px;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .content-title {
                font-size: 1.5rem;
                padding: 0.25rem 0.75rem;
                margin-bottom: 0.5rem;
                letter-spacing: 0.5px;
            }

            .subtitle {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
                margin-bottom: 1rem;
            }

            .gradient-border {
                margin-bottom: 0.75rem;
                height: 2px;
            }
        }

        @media (max-width: 360px) {
            .main-content {
                padding-left: 0.25rem;
                padding-right: 0.25rem;
            }

            .content-title {
                font-size: 1.25rem;
                padding: 0.2rem 0.5rem;
                margin-bottom: 0.4rem;
            }

            .subtitle {
                font-size: 0.8rem;
                padding: 0.2rem 0.4rem;
                margin-bottom: 0.75rem;
            }
        }

        .leaderboard-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #333333;
        }

        @media (max-width: 768px) {
            .leaderboard-container {
                padding: 1rem;
                border-radius: 12px;
                margin: 0 0.25rem;
            }
        }

        @media (max-width: 480px) {
            .leaderboard-container {
                padding: 0.75rem;
                border-radius: 10px;
                margin: 0;
            }
        }

        @media (max-width: 360px) {
            .leaderboard-container {
                padding: 0.5rem;
                border-radius: 8px;
            }
        }

        .top-users {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .top-users {
                grid-template-columns: 1fr;
                gap: 0.75rem;
                margin-bottom: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .top-users {
                gap: 0.5rem;
                margin-bottom: 1rem;
            }
        }

        .user-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border: 2px solid #eaeaea;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .user-card {
                padding: 1rem;
                border-radius: 12px;
                display: flex;
                align-items: center;
                text-align: left;
                gap: 1rem;
            }

            .user-card:hover {
                transform: translateY(-3px);
            }
        }

        @media (max-width: 480px) {
            .user-card {
                padding: 0.75rem;
                border-radius: 10px;
                gap: 0.75rem;
            }
        }

        @media (max-width: 360px) {
            .user-card {
                padding: 0.5rem;
                border-radius: 8px;
                gap: 0.5rem;
            }
        }

        .user-card.gold {
            border-top: 5px solid #FFD700;
            background: linear-gradient(135deg, #FFF9C4, #ffffff);
        }

        .user-card.silver {
            border-top: 5px solid #C0C0C0;
            background: linear-gradient(135deg, #F5F5F5, #ffffff);
        }

        .user-card.bronze {
            border-top: 5px solid #CD7F32;
            background: linear-gradient(135deg, #FFCCBC, #ffffff);
        }

        .rank-badge {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .rank-badge {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
                margin: 0 0.75rem 0 0;
                flex-shrink: 0;
            }
        }

        @media (max-width: 480px) {
            .rank-badge {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
                margin: 0 0.5rem 0 0;
            }
        }

        @media (max-width: 360px) {
            .rank-badge {
                width: 35px;
                height: 35px;
                font-size: 1rem;
                margin: 0 0.4rem 0 0;
            }
        }

        .gold .rank-badge {
            background: linear-gradient(135deg, #FFD700, #B7950B);
            color: white;
        }

        .silver .rank-badge {
            background: linear-gradient(135deg, #C0C0C0, #757575);
            color: white;
        }

        .bronze .rank-badge {
            background: linear-gradient(135deg, #CD7F32, #A04000);
            color: white;
        }

        .leaderboard-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 1rem auto;
            object-fit: cover;
            border: 3px solid #eaeaea;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .leaderboard-avatar {
                width: 50px;
                height: 50px;
                margin: 0;
                flex-shrink: 0;
            }
        }

        @media (max-width: 480px) {
            .leaderboard-avatar {
                width: 45px;
                height: 45px;
                border-width: 2px;
            }
        }

        @media (max-width: 360px) {
            .leaderboard-avatar {
                width: 40px;
                height: 40px;
            }
        }

        .leaderboard-name {
            font-size: 1.2rem;
            font-weight: 800;
            margin: 0.5rem 0;
            color: #333333;
        }

        @media (max-width: 768px) {
            .leaderboard-name {
                font-size: 1rem;
                margin: 0;
                margin-bottom: 0.25rem;
            }
        }

        @media (max-width: 480px) {
            .leaderboard-name {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 360px) {
            .leaderboard-name {
                font-size: 0.85rem;
            }
        }

        .user-points {
            font-size: 1.5rem;
            font-weight: bold;
            color: #FF9500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .user-points {
                font-size: 1.1rem;
                justify-content: flex-start;
                margin-bottom: 0.25rem;
            }
        }

        @media (max-width: 480px) {
            .user-points {
                font-size: 1rem;
                gap: 0.3rem;
            }
        }

        @media (max-width: 360px) {
            .user-points {
                font-size: 0.9rem;
            }
        }

        .achievement-label {
            display: inline-block;
            background: linear-gradient(135deg, #FF9500, #E07600);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .achievement-label {
                font-size: 0.7rem;
                padding: 0.2rem 0.6rem;
                margin-top: 0;
                border-radius: 15px;
            }
        }

        @media (max-width: 480px) {
            .achievement-label {
                font-size: 0.65rem;
                padding: 0.15rem 0.5rem;
                border-radius: 12px;
            }
        }

        @media (max-width: 360px) {
            .achievement-label {
                font-size: 0.6rem;
                padding: 0.1rem 0.4rem;
            }
        }

        .other-users {
            background: rgba(255, 255, 255, 0.98);
            padding: 0.75rem;
            margin-top: 1rem;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            backdrop-filter: none;
        }

        @media (max-width: 768px) {
            .other-users {
                background: rgba(255, 255, 255, 0.98);
                padding: 0.75rem;
                margin-top: 1rem;
                border-radius: 8px;
                border: 1px solid rgba(0, 0, 0, 0.05);
                backdrop-filter: none;
            }
        }

        @media (max-width: 480px) {
            .other-users {
                background: #ffffff;
                padding: 0.5rem;
                margin-top: 0.75rem;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
                border: none;
            }
        }

        @media (max-width: 360px) {
            .other-users {
                padding: 0.4rem;
                margin-top: 0.5rem;
                border-radius: 4px;
                box-shadow: none;
                border-bottom: 1px solid #f0f0f0;
            }
        }

        .other-users-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #4B5563;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .other-users-title {
                font-size: 0.9rem;
                margin-bottom: 0.75rem;
                color: #6B7280;
                font-weight: 600;
            }
        }

        @media (max-width: 480px) {
            .other-users-title {
                font-size: 0.8rem;
                margin-bottom: 0.5rem;
                color: #9CA3AF;
                font-weight: 500;
            }

            .other-users-title i {
                display: none;
            }
        }

        @media (max-width: 360px) {
            .other-users-title {
                font-size: 0.75rem;
                margin-bottom: 0.4rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
        }

        .user-row {
            background: #ffffff;
            border-radius: 12px;
            padding: 1rem 1.2rem;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid #eaeaea;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .user-row:hover {
            transform: translateX(8px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .user-row {
                background: rgba(255, 255, 255, 0.7);
                padding: 0.5rem 0.75rem;
                border-radius: 6px;
                margin-bottom: 0.3rem;
                border: none;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
                transition: all 0.2s ease;
            }

            .user-row:hover {
                transform: translateX(2px);
                background: rgba(255, 255, 255, 0.9);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
            }
        }

        @media (max-width: 480px) {
            .user-row {
                padding: 0.4rem 0.5rem;
                border-radius: 4px;
                margin-bottom: 0.2rem;
                box-shadow: none;
                background: transparent;
                border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            }

            .user-row:hover {
                transform: none;
                background: rgba(255, 149, 0, 0.02);
            }

            .user-row:last-child {
                border-bottom: none;
            }
        }

        @media (max-width: 360px) {
            .user-row {
                padding: 0.3rem 0.4rem;
                margin-bottom: 0.1rem;
            }
        }

        .user-rank {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF9500, #E07600);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: bold;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .user-rank {
                width: 24px;
                height: 24px;
                margin-right: 0.5rem;
                font-size: 0.7rem;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
                background: #FF9500;
            }
        }

        @media (max-width: 480px) {
            .user-rank {
                width: 20px;
                height: 20px;
                margin-right: 0.4rem;
                font-size: 0.65rem;
                box-shadow: none;
                background: #FF9500;
                border-radius: 4px;
            }
        }

        @media (max-width: 360px) {
            .user-rank {
                width: 18px;
                height: 18px;
                margin-right: 0.3rem;
                font-size: 0.6rem;
                border-radius: 3px;
            }
        }

        .leaderboard-user-info {
            flex: 1;
            margin-left: 1rem;
        }

        @media (max-width: 768px) {
            .leaderboard-user-info {
                margin-left: 0.6rem;
            }
        }

        @media (max-width: 480px) {
            .leaderboard-user-info {
                margin-left: 0.4rem;
            }
        }

        @media (max-width: 360px) {
            .leaderboard-user-info {
                margin-left: 0.3rem;
            }
        }

        .row-user-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333333;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .row-user-name {
                font-size: 0.85rem;
                margin-bottom: 0.1rem;
                font-weight: 600;
                color: #374151;
            }
        }

        @media (max-width: 480px) {
            .row-user-name {
                font-size: 0.8rem;
                margin-bottom: 0.05rem;
                color: #4B5563;
                font-weight: 500;
            }
        }

        @media (max-width: 360px) {
            .row-user-name {
                font-size: 0.75rem;
                margin-bottom: 0;
                font-weight: 400;
            }
        }

        .user-stats {
            background: rgba(255, 149, 0, 0.1);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            color: #FF9500;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            width: fit-content;
        }

        @media (max-width: 768px) {
            .user-stats {
                background: none;
                padding: 0;
                border-radius: 0;
                font-size: 0.7rem;
                gap: 0.2rem;
                font-weight: 500;
                color: #6B7280;
            }
        }

        @media (max-width: 480px) {
            .user-stats {
                font-size: 0.65rem;
                color: #9CA3AF;
                font-weight: 400;
                gap: 0.1rem;
            }

            .user-stats i {
                display: none;
            }
        }

        @media (max-width: 360px) {
            .user-stats {
                font-size: 0.6rem;
                color: #D1D5DB;
            }
        }

        .current-user {
            border-left: 4px solid #FF9500;
            background: rgba(255, 149, 0, 0.05);
        }

        .my-status {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 2px solid #FF9500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .my-status {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .my-status {
                padding: 1rem;
            }
        }

        .my-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .my-info {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .my-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #FF9500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 480px) {
            .my-avatar {
                width: 50px;
                height: 50px;
            }
        }

        .rank-status {
            font-size: 1.2rem;
            font-weight: bold;
            color: #FF9500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: rgba(255, 149, 0, 0.1);
            border-radius: 25px;
            border: 1px solid rgba(255, 149, 0, 0.3);
        }

        @media (max-width: 480px) {
            .rank-status {
                font-size: 1rem;
                padding: 0.5rem 1rem;
            }
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 0.6rem;
                margin-top: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .action-buttons {
                gap: 0.5rem;
                margin-top: 1rem;
            }
        }

        @media (max-width: 360px) {
            .action-buttons {
                gap: 0.4rem;
                margin-top: 0.75rem;
            }
        }

        .action-button {
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 1rem;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .action-button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
                border-radius: 20px;
            }

            .action-button:hover {
                transform: translateY(-2px);
            }
        }

        @media (max-width: 480px) {
            .action-button {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
                border-radius: 18px;
            }

            .action-button:hover {
                transform: translateY(-1px);
            }
        }

        @media (max-width: 360px) {
            .action-button {
                padding: 0.45rem 0.9rem;
                font-size: 0.8rem;
                border-radius: 15px;
            }
        }

        .learn-button {
            background: linear-gradient(135deg, #58CC02, #4BA802);
            color: white;
        }

        .learn-button:hover {
            background: linear-gradient(135deg, #4CAF50, #3E8E41);
            color: white;
        }

        .play-button {
            background: linear-gradient(135deg, #9D50BB, #7B3F98);
            color: white;
        }

        .play-button:hover {
            background: linear-gradient(135deg, #8E44AD, #6C3483);
            color: white;
        }

        .users-scroll-container {
            max-height: 380px;
            overflow-y: auto;
            padding-right: 10px;
            scrollbar-width: thin;
            scrollbar-color: #FF9500 #F0F0F0;
        }

        @media (max-width: 768px) {
            .users-scroll-container {
                max-height: 250px;
                padding-right: 6px;
            }
        }

        @media (max-width: 480px) {
            .users-scroll-container {
                max-height: 200px;
                padding-right: 3px;
            }
        }

        @media (max-width: 360px) {
            .users-scroll-container {
                max-height: 150px;
                padding-right: 2px;
            }
        }

        .users-scroll-container::-webkit-scrollbar {
            width: 8px;
        }

        .users-scroll-container::-webkit-scrollbar-track {
            background: #F0F0F0;
            border-radius: 10px;
        }

        .users-scroll-container::-webkit-scrollbar-thumb {
            background-color: #FF9500;
            border-radius: 10px;
        }

        .users-scroll-container::-webkit-scrollbar-thumb:hover {
            background-color: #E07600;
        }

        .user-avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            margin-right: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .user-avatar-circle {
                width: 24px;
                height: 24px;
                font-size: 10px;
                margin-right: 0.4rem;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
            }
        }

        @media (max-width: 480px) {
            .user-avatar-circle {
                display: none;
            }
        }

        .empty-message {
            text-align: center;
            padding: 20px;
            color: #718096;
            font-style: italic;
        }

        /* Decorative elements */
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

        /* Mobile optimization for decorative elements */
        @media (max-width: 768px) {
            .decoration {
                opacity: 0.3;
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .decoration {
                opacity: 0.2;
                font-size: 1.5rem;
            }
        }

        @media (max-width: 360px) {
            .decoration {
                display: none;
            }
        }

        /* Simplified current user highlight for mobile */
        @media (max-width: 480px) {
            .current-user {
                border-left: 2px solid #FF9500;
                background: rgba(255, 149, 0, 0.02);
            }
        }

        @media (max-width: 360px) {
            .current-user {
                border-left: 1px solid #FF9500;
                background: rgba(255, 149, 0, 0.01);
            }
        }

        /* Ultra-compact empty message for mobile */
        @media (max-width: 480px) {
            .empty-message {
                padding: 15px;
                font-size: 0.8rem;
                color: #9CA3AF;
            }
        }

        @media (max-width: 360px) {
            .empty-message {
                padding: 10px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <!-- Decorative elements -->
            <div class="decoration decoration-1">🏆</div>
            <div class="decoration decoration-2">⭐</div>
            <div class="decoration decoration-3">🎖️</div>
            <div class="decoration decoration-4">🥇</div>

            <!-- Page Header -->
            <div class="container mx-auto">
                <div class="text-center mb-8 px-6">
                    <h1 class="content-title">
                        PERINGKAT <i class="fas fa-trophy ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Pengguna terbaik berdasarkan perolehan poin</p>
                </div>
                <div class="gradient-border"></div>
            </div>

            <div class="container mx-auto">
                <div class="leaderboard-container">
                    <!-- Top 3 Users -->
                    <div class="top-users">
                        @if(count($leaderboard) > 0)
                            <div class="user-card gold">
                                <div class="rank-badge">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <img class="leaderboard-avatar" src="https://ui-avatars.com/api/?name={{ $leaderboard[0]->name }}&background=FFD700&color=fff" alt="{{ $leaderboard[0]->name }}">
                                <h3 class="leaderboard-name">{{ $leaderboard[0]->name }}</h3>
                                <div class="user-points">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($leaderboard[0]->total_points) }}
                                </div>
                                <div class="achievement-label">1</div>
                </div>
                @endif

                        @if(count($leaderboard) > 1)
                            <div class="user-card silver">
                                <div class="rank-badge">
                                    <i class="fas fa-medal"></i>
                                </div>
                                <img class="leaderboard-avatar" src="https://ui-avatars.com/api/?name={{ $leaderboard[1]->name }}&background=C0C0C0&color=fff" alt="{{ $leaderboard[1]->name }}">
                                <h3 class="leaderboard-name">{{ $leaderboard[1]->name }}</h3>
                                <div class="user-points">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($leaderboard[1]->total_points) }}
                                </div>
                                <div class="achievement-label">2</div>
                </div>
                @endif

                        @if(count($leaderboard) > 2)
                            <div class="user-card bronze">
                                <div class="rank-badge">
                                    <i class="fas fa-award"></i>
                                </div>
                                <img class="leaderboard-avatar" src="https://ui-avatars.com/api/?name={{ $leaderboard[2]->name }}&background=CD7F32&color=fff" alt="{{ $leaderboard[2]->name }}">
                                <h3 class="leaderboard-name">{{ $leaderboard[2]->name }}</h3>
                                <div class="user-points">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($leaderboard[2]->total_points) }}
                                </div>
                                <div class="achievement-label">3</div>
                            </div>
                        @endif
                    </div>

                    <!-- Other Users -->
                    <div class="other-users">
                        <div class="other-users-title">
                            <i class="fas fa-users"></i> Pengguna Lainnya
                        </div>

                        <div class="users-scroll-container">
                            @php $count = 0; @endphp
                            @foreach($leaderboard as $index => $user)
                                @if($index > 2)
                                    <div class="user-row {{ isset($currentUser) && $user->id == $currentUser->id ? 'current-user' : '' }}">
                                        <div class="user-rank">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="user-avatar-circle" style="background-color: #{{ substr(md5($user->name), 0, 6) }}">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    <div class="leaderboard-user-info">
                                            <h3 class="row-user-name">{{ $user->name }}</h3>
                                            <div class="user-stats">
                                                <i class="fas fa-star"></i>
                                                {{ number_format($user->total_points) }} Poin
                                            </div>
                                        </div>
                                    </div>
                                    @php $count++; @endphp
                                        @endif
                            @endforeach
                            @if($count == 0)
                                <div class="empty-message">
                                    <p>Belum ada data pengguna lainnya.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(isset($currentUser))
                        <div class="my-status">
                            <div class="my-info">
                                <img src="https://ui-avatars.com/api/?name={{ $currentUser->name }}&background=4F46E5&color=fff" alt="{{ $currentUser->name }}" class="my-avatar">
                                <div class="leaderboard-user-info">
                                    <h3 class="row-user-name">{{ $currentUser->name }}</h3>
                                    <div class="user-stats">
                                        <i class="fas fa-star"></i>
                                        {{ number_format($currentUser->total_points ?? 0) }} Poin
                            </div>
                        </div>
                            </div>
                            <div class="rank-status">
                                <i class="fas fa-chart-line"></i>
                                Peringkat ke-{{ $currentUserRank }}
                            </div>
                    </div>

                    @if(!in_array($currentUser->role, ['admin', 'superadmin']))
                            <div class="action-buttons">
                                <a href="{{ route('belajar.index') }}" class="action-button learn-button">
                                    <i class="fas fa-book-open"></i>
                                    Mulai Belajar
                                </a>
                                <a href="{{ route('permainan.index') }}" class="action-button play-button">
                                    <i class="fas fa-gamepad"></i>
                                    Main Games
                                </a>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('components.achievement-notification')
</body>
</html>



