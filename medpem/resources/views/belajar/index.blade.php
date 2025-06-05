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
            z-index: 1; /* Ensure main content is below modals */
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
            pointer-events: auto;
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
            pointer-events: none;
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
            pointer-events: none;
            z-index: -1;
        }

        .floating-decoration {
            position: absolute;
            z-index: -1;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
            opacity: 0.4;
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

        .lesson-row.row-left {
            justify-content: flex-start;
            padding-left: 20%;
        }

        .lesson-row.row-center {
            justify-content: center;
        }

        .lesson-row.row-right {
            justify-content: flex-end;
            padding-right: 20%;
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
            border-radius: 16px;
            padding: 0.75rem;
            width: 220px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            z-index: 10;
            text-align: left;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s;
            border: 2px solid #58CC02;
            font-size: 0.9rem;
        }

        .lesson-node:hover .lesson-tooltip {
            visibility: visible;
            opacity: 1;
        }

        .lesson-tooltip::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 6px 6px 0 6px;
            border-style: solid;
            border-color: #58CC02 transparent transparent transparent;
        }

        .row-left .lesson-tooltip {
            left: 15px;
            right: auto;
        }

        .row-right .lesson-tooltip {
            right: 15px;
            left: auto;
        }

        .row-center .lesson-tooltip {
            left: 50%;
            transform: translateX(-50%) translateY(-105%);
        }

        .tooltip-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: #58CC02;
        }

        .tooltip-subtitle {
            font-size: 0.8rem;
            color: #a0aec0;
            margin-bottom: 0.4rem;
        }

        .completed-info {
            background: rgba(31, 41, 55, 0.8) !important;
            padding: 0.6rem !important;
            border-radius: 8px !important;
            margin-bottom: 0.6rem !important;
            border: 1.5px solid rgba(34, 197, 94, 0.6) !important;
        }

        .completed-info .fas.fa-check-circle {
            font-size: 1rem !important;
            margin-right: 0.4rem !important;
        }

        .completed-info p {
            font-size: 0.85rem !important;
            margin-bottom: 0.4rem !important;
        }

        .completed-info .bg-gray-900 {
            background: rgba(17, 24, 39, 0.9) !important;
            padding: 0.5rem !important;
            border-radius: 6px !important;
        }

        .completed-info .font-bold {
            font-size: 0.75rem !important;
            margin-bottom: 0.3rem !important;
            padding-bottom: 0.2rem !important;
        }

        .completed-info span {
            font-size: 0.8rem !important;
            padding: 0.4rem 0.6rem !important;
        }

        .tooltip-button {
            display: flex;
            width: 100%;
            padding: 0.5rem;
            background-color: #58CC02;
            color: white;
            font-weight: 700;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            margin-top: 0.6rem;
            transition: all 0.3s;
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
            border: none;
            letter-spacing: 0.3px;
            font-size: 0.85rem;
        }

        .tooltip-button img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
        }

        .tooltip-button span {
            display: inline-block;
            margin-left: 4px;
        }

        .tooltip-button:hover {
            background-color: #4CAF50;
            transform: translateY(-1px);
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

        /* Mobile responsiveness - Improved */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 120px;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* Adjust mascots for mobile */
            .mascot {
                width: 50px;
                height: 50px;
                z-index: 1;
            }

            .lesson-mascot {
                right: 5%;
                top: 120px;
            }

            .teacher-mascot {
                left: 5%;
                top: 250px;
            }

            .lily-mascot {
                right: 8%;
                bottom: 150px;
            }

            .raccoon-mascot {
                left: 8%;
                bottom: 200px;
            }

            /* Adjust speech bubbles for mobile */
            .mascot-speech {
                width: 140px;
                padding: 10px;
                font-size: 0.75rem;
                z-index: 2;
            }

            .lesson-speech {
                right: 2%;
                top: 80px;
            }

            .teacher-speech {
                left: 2%;
                top: 210px;
            }

            .lily-speech {
                right: 5%;
                bottom: 200px;
            }

            .raccoon-speech {
                left: 5%;
                bottom: 250px;
            }

            /* Hide decorative elements that might overlap */
            .floating-decoration {
                opacity: 0.2;
                transform: scale(0.7);
            }

            .decoration {
                opacity: 0.3;
                font-size: 2rem;
            }

            /* Adjust lesson path for mobile */
            .lesson-path-container {
                padding: 0 1rem;
            }

            .lesson-path {
                padding: 20px 10px;
            }

            .lesson-tooltip {
                width: 180px !important;
                left: 50% !important;
                right: auto !important;
                transform: translateX(-50%) translateY(-105%) !important;
                font-size: 0.8rem;
                padding: 0.6rem;
                border-radius: 12px;
            }

            .tooltip-title {
                font-size: 0.9rem;
                margin-bottom: 0.2rem;
            }

            .tooltip-subtitle {
                font-size: 0.75rem;
                margin-bottom: 0.3rem;
            }

            .completed-info {
                padding: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }

            .completed-info p {
                font-size: 0.8rem !important;
                margin-bottom: 0.3rem !important;
            }

            .completed-info .font-bold {
                font-size: 0.7rem !important;
                margin-bottom: 0.25rem !important;
            }

            .completed-info span {
                font-size: 0.75rem !important;
                padding: 0.3rem 0.5rem !important;
            }

            .tooltip-button {
                padding: 0.4rem;
                font-size: 0.8rem;
                margin-top: 0.5rem;
                border-radius: 10px;
            }

            /* Adjust notifications for mobile */
            .notification {
                width: calc(100% - 40px);
                max-width: 320px;
                padding: 12px 20px;
                text-align: center;
                justify-content: center;
                right: 20px;
                left: 20px;
                margin: 0 auto;
                top: 100px;
            }

            .success-notification {
                right: 20px;
                left: 20px;
                max-width: calc(100% - 40px);
                padding: 12px 20px;
                top: 100px;
                margin: 0 auto;
                transform: translateY(-20px);
            }

            .success-notification.show {
                transform: translateY(0);
            }

            .notification.show {
                transform: translateX(0);
            }

            .content-title {
                font-size: 2.5rem;
                padding: 0.4rem 1.5rem;
            }

            .subtitle {
                font-size: 1.1rem;
                padding: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding-top: 110px;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            /* Further reduce mascot size on small mobile */
            .mascot {
                width: 40px;
                height: 40px;
            }

            /* Move mascots further away from content area */
            .lesson-mascot {
                right: 2%;
                top: 100px;
            }

            .teacher-mascot {
                left: 2%;
                top: 200px;
            }

            .lily-mascot {
                right: 3%;
                bottom: 120px;
            }

            .raccoon-mascot {
                left: 3%;
                bottom: 150px;
            }

            /* Smaller speech bubbles */
            .mascot-speech {
                width: 120px;
                padding: 8px;
                font-size: 0.65rem;
            }

            .lesson-speech {
                right: 1%;
                top: 65px;
            }

            .teacher-speech {
                left: 1%;
                top: 165px;
            }

            .lily-speech {
                right: 2%;
                bottom: 170px;
            }

            .raccoon-speech {
                left: 2%;
                bottom: 200px;
            }

            /* Hide more decorations on very small screens */
            .floating-decoration {
                opacity: 0.1;
                transform: scale(0.5);
            }

            .decoration {
                opacity: 0.2;
                font-size: 1.5rem;
            }

            .content-title {
                font-size: 2rem;
                padding: 0.3rem 1rem;
            }

            .subtitle {
                font-size: 0.9rem;
                padding: 0.3rem;
            }

            .lesson-tooltip {
                width: 160px !important;
                font-size: 0.75rem;
                padding: 0.5rem;
                border-radius: 10px;
            }

            .tooltip-title {
                font-size: 0.85rem;
                margin-bottom: 0.15rem;
            }

            .tooltip-subtitle {
                font-size: 0.7rem;
                margin-bottom: 0.25rem;
            }

            .completed-info {
                padding: 0.4rem !important;
                margin-bottom: 0.4rem !important;
            }

            .completed-info p {
                font-size: 0.75rem !important;
                margin-bottom: 0.25rem !important;
            }

            .completed-info .font-bold {
                font-size: 0.65rem !important;
                margin-bottom: 0.2rem !important;
            }

            .completed-info span {
                font-size: 0.7rem !important;
                padding: 0.25rem 0.4rem !important;
            }

            .tooltip-button {
                padding: 0.35rem;
                font-size: 0.75rem;
                margin-top: 0.4rem;
                border-radius: 8px;
            }

            .notification {
                font-size: 0.9rem;
                padding: 10px 15px;
                top: 90px;
            }

            .success-notification {
                font-size: 0.9rem;
                padding: 10px 15px;
                width: calc(100% - 20px);
                max-width: calc(100% - 20px);
                right: 10px;
                left: 10px;
                top: 90px;
            }

            .success-notification .icon {
                font-size: 1.2rem;
            }

            .success-notification .message {
                font-size: 0.9rem;
            }

            /* Ensure lesson nodes are properly sized */
            .lesson-circle {
                width: 60px;
                height: 60px;
            }
        }

        @media (max-width: 360px) {
            /* Extra small screens */
            .mascot {
                width: 35px;
                height: 35px;
            }

            .mascot-speech {
                width: 100px;
                padding: 6px;
                font-size: 0.6rem;
            }

            /* Position mascots even further from content */
            .lesson-mascot, .lily-mascot {
                right: 1%;
            }

            .teacher-mascot, .raccoon-mascot {
                left: 1%;
            }

            .lesson-circle {
                width: 55px;
                height: 55px;
            }

            .lesson-tooltip {
                width: 140px !important;
                font-size: 0.7rem;
                padding: 0.4rem;
                border-radius: 8px;
            }

            .tooltip-title {
                font-size: 0.8rem;
                margin-bottom: 0.1rem;
            }

            .tooltip-subtitle {
                font-size: 0.65rem;
                margin-bottom: 0.2rem;
            }

            .completed-info {
                padding: 0.3rem !important;
                margin-bottom: 0.3rem !important;
            }

            .completed-info p {
                font-size: 0.7rem !important;
                margin-bottom: 0.2rem !important;
            }

            .completed-info .font-bold {
                font-size: 0.6rem !important;
                margin-bottom: 0.15rem !important;
            }

            .completed-info span {
                font-size: 0.65rem !important;
                padding: 0.2rem 0.3rem !important;
            }

            .tooltip-button {
                padding: 0.3rem;
                font-size: 0.7rem;
                margin-top: 0.3rem;
                border-radius: 6px;
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

        /* Fix untuk header dropdown pada halaman belajar */
        .header-dropdown-container, .duolingo-header, .user-avatar, #userAvatarControl, #avatarClickOverlay {
            z-index: 1000 !important;
            position: relative !important;
        }

        /* Pastikan user dropdown muncul di atas konten */
        #userDropdownDiv {
            z-index: 1001 !important;
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
                    <!-- Start Node -->
                    @php
                        // Determine if the initial start node should be inactive
                        $startNodeInactive = false;
                        if (count($lessons) > 0) {
                            $firstLesson = $lessons[0];
                            $firstPosition = $firstLesson['position'] ?? 1;
                            $startNodeInactive = ($firstPosition % 3 == 0) ||
                                               (isset($firstLesson['is_active']) && !$firstLesson['is_active']);
                        }
                    @endphp

                    <div class="lesson-row row-center">
                        <div class="lesson-node">
                            <div class="lesson-circle {{ $startNodeInactive ? 'inactive' : 'active' }}">
                                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f680.svg" alt="Start" class="start-icon">
                            </div>
                        </div>
                    </div>

                    @php
                        // Create a single array of all parts from all lessons
                        $allParts = [];
                        $partIndex = 0;

                        foreach($lessons as $lessonIndex => $lesson) {
                            for($part = 1; $part <= 6; $part++) {
                                $partCompleted = $lesson['user_status']['parts']['part' . $part . '_completed'] ?? false;
                                $partUnlocked = true; // All parts unlocked for now
                                $exampleAnswer = $lesson['user_status']['parts']['part' . $part . '_example'] ?? null;

                                $allParts[] = [
                                    'lesson' => $lesson,
                                    'lesson_index' => $lessonIndex,
                                    'part_number' => $part,
                                    'completed' => $partCompleted,
                                    'unlocked' => $partUnlocked,
                                    'example' => $exampleAnswer,
                                    'global_index' => $partIndex
                                ];
                                $partIndex++;
                            }
                        }

                        // Define zigzag pattern positions
                        $positions = ['center', 'left', 'right', 'left', 'center', 'right', 'center', 'left', 'right'];
                    @endphp

                    @foreach($allParts as $index => $partData)
                        @php
                            $lesson = $partData['lesson'];
                            $part = $partData['part_number'];
                            $partCompleted = $partData['completed'];
                            $partUnlocked = $partData['unlocked'];
                            $exampleAnswer = $partData['example'];

                            // Determine position using pattern + some randomness
                            $basePosition = $positions[$index % count($positions)];

                            // Add variety to prevent monotony
                            if ($index % 8 == 0) $basePosition = 'center';
                            elseif ($index % 11 == 0) $basePosition = 'right';
                            elseif ($index % 13 == 0) $basePosition = 'left';

                            $rowClass = 'lesson-row row-' . $basePosition;

                            // Node styling
                            if ($partCompleted) {
                                $nodeClass = 'completed';
                                $circleClass = 'lesson-circle completed';
                            } elseif (!$partUnlocked) {
                                $nodeClass = 'locked';
                                $circleClass = 'lesson-circle locked';
                            } else {
                                $nodeClass = 'active';
                                $circleClass = 'lesson-circle active';
                            }
                        @endphp

                        <!-- Individual lesson part node -->
                        <div class="{{ $rowClass }}">
                            <div class="lesson-node {{ $nodeClass }}">
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
                                        @if($exampleAnswer)
                                        <div class="bg-gray-900 p-3 rounded-lg">
                                            <p class="font-bold text-green-400 mb-2 border-b border-gray-700 pb-1">Contoh Jawaban Benar:</p>
                                            <div class="flex items-center">
                                                <span class="text-white bg-gray-800 px-3 py-2 rounded-lg font-semibold">{{ $exampleAnswer }}</span>
                                            </div>
                                        </div>
                                        @endif
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

                        <!-- Add a small divider every 6 parts (end of lesson) -->
                        @if(($index + 1) % 6 == 0 && !$loop->last)
                            <div class="lesson-row row-center">
                                <div class="section-divider"></div>
                            </div>
                        @endif
                    @endforeach

                    <!-- Trophy at the end -->
                    <div class="lesson-row row-center">
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

    @include('components.achievement-notification')

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
