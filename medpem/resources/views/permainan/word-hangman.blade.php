<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gameData['title'] }} - Media Pembelajaran</title>
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
            padding-top: 100px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 160px;
            }
        }

        .game-title {
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
            color: #ffffff;
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .game-description {
            text-align: center;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #ffffff;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: 300px;
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            margin: 0 auto 2rem auto;
            border-radius: 2px;
        }

        .game-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            color: #151b2e;
        }

        .game-stats {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .stat-item {
            text-align: center;
            padding: 0 1rem;
        }

        .stat-title {
            color: #151b2e;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #151b2e;
        }

        .stat-value.score {
            color: #9D50BB;
        }

        .progress-container {
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            margin-bottom: 2rem;
            overflow: hidden;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .progress-bar {
            height: 10px;
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            width: 0%;
            transition: width 0.5s ease;
            border-radius: 10px;
        }

        .hangman-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .hangman-drawing {
            width: 450px;
            height: 200px;
            position: relative;
            margin-bottom: 2rem;
            background: linear-gradient(to bottom, #87CEEB, #a9daee);
            border-radius: 20px;
            padding: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* Ground */
        .ground {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(to bottom, #7CBA43, #689C38);
            border-radius: 0 0 20px 20px;
            box-shadow: inset 0 3px 5px rgba(0,0,0,0.1);
        }

        /* Ground texture */
        .grass {
            position: absolute;
            width: 100%;
            height: 10px;
            bottom: 30px;
            left: 0;
            background-image:
                radial-gradient(circle, #8CD448 10%, transparent 10%),
                radial-gradient(circle, #8CD448 10%, transparent 10%);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.5;
        }

        /* Cloud styling enhancement */
        .cloud {
            position: absolute;
            background: white;
            border-radius: 50%;
            filter: blur(2px);
            opacity: 0.9;
            z-index: 1;
        }

        .cloud-1 {
            width: 60px;
            height: 25px;
            top: 20px;
            left: 40px;
            animation: floatCloud 30s linear infinite;
        }

        .cloud-2 {
            width: 40px;
            height: 20px;
            top: 40px;
            left: 360px;
            animation: floatCloud 20s linear infinite reverse;
        }

        .cloud-3 {
            width: 50px;
            height: 20px;
            top: 30px;
            left: 200px;
            animation: floatCloud 40s linear infinite;
        }

        @keyframes floatCloud {
            0% {transform: translateX(0);}
            50% {transform: translateX(30px);}
            100% {transform: translateX(0);}
        }

        /* Enhanced sun */
        .sun {
            position: absolute;
            top: 15px;
            right: 25px;
            width: 30px;
            height: 30px;
            background: #FFC107;
            border-radius: 50%;
            box-shadow: 0 0 20px #FFC107;
            z-index: 1;
            animation: sunGlow 5s ease-in-out infinite;
        }

        @keyframes sunGlow {
            0%, 100% {box-shadow: 0 0 20px #FFC107;}
            50% {box-shadow: 0 0 30px #FFC107;}
        }

        /* Tree enhancement */
        .tree {
            position: absolute;
            bottom: 40px;
            right: 25px;
            z-index: 2;
        }

        .tree-trunk {
            width: 15px;
            height: 30px;
            background: linear-gradient(to right, #8B4513, #a05a2c, #8B4513);
            margin-left: 10px;
            border-radius: 2px;
        }

        .tree-top {
            width: 35px;
            height: 50px;
            background: linear-gradient(135deg, #2E7D32, #4CAF50, #2E7D32);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }

        /* Flower decorations */
        .flowers {
            position: absolute;
            bottom: 40px;
            left: 100px;
            z-index: 2;
        }

        .flower {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #FF69B4;
            border-radius: 50%;
        }

        .flower:before, .flower:after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: #FF69B4;
            border-radius: 50%;
        }

        .flower:before {
            top: -5px;
            left: -5px;
        }

        .flower:after {
            top: -5px;
            left: 5px;
        }

        .flower-stem {
            position: absolute;
            width: 2px;
            height: 15px;
            background: #4CAF50;
            bottom: 4px;
            left: 3px;
            z-index: -1;
        }

        .flower-2 {
            left: 20px;
        }

        .flower-3 {
            left: 40px;
        }

        /* Butterflies */
        .butterfly {
            position: absolute;
            z-index: 5;
            animation: butterflyFly 15s ease-in-out infinite alternate;
        }

        .butterfly-1 {
            top: 30px;
            left: 150px;
        }

        .butterfly-wing {
            position: absolute;
            width: 8px;
            height: 10px;
            background: #9C27B0;
            border-radius: 50% 50% 50% 50%;
            opacity: 0.7;
            animation: wingFlap 0.5s ease-in-out infinite alternate;
        }

        .butterfly-wing-left {
            transform: rotate(-30deg);
            left: -5px;
        }

        .butterfly-wing-right {
            transform: rotate(30deg);
            left: 5px;
        }

        .butterfly-body {
            position: absolute;
            width: 2px;
            height: 8px;
            background: #000;
            top: 0;
            left: 4px;
        }

        @keyframes wingFlap {
            0% {transform: rotate(-30deg);}
            100% {transform: rotate(-50deg);}
        }

        @keyframes butterflyFly {
            0% {transform: translate(0, 0);}
            25% {transform: translate(20px, -10px);}
            50% {transform: translate(40px, 5px);}
            75% {transform: translate(20px, 15px);}
            100% {transform: translate(0, 0);}
        }

        /* Child character */
        .child {
            position: absolute;
            bottom: 40px;
            left: 30px;
            width: 70px;
            height: 100px;
            z-index: 2;
            transition: left 0.5s ease-in-out;
        }

        .child-head {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: #FFD7B5;
            border-radius: 50%;
            top: 0;
            left: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .child-body {
            position: absolute;
            width: 30px;
            height: 45px;
            background-color: #FF9500;
            border-radius: 8px;
            top: 35px;
            left: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .child-eye {
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: #333;
            border-radius: 50%;
        }

        .child-eye-left {
            top: 15px;
            left: 25px;
        }

        .child-eye-right {
            top: 15px;
            left: 38px;
        }

        .child-smile {
            position: absolute;
            width: 16px;
            height: 8px;
            border-bottom: 3px solid #333;
            border-radius: 50%;
            top: 25px;
            left: 27px;
        }

        .child-arm {
            position: absolute;
            width: 8px;
            height: 25px;
            background-color: #FFD7B5;
            border-radius: 4px;
        }

        .child-arm-left {
            transform: rotate(-20deg);
            top: 40px;
            left: 15px;
        }

        .child-arm-right {
            transform: rotate(30deg);
            top: 40px;
            left: 45px;
        }

        .child-leg {
            position: absolute;
            width: 10px;
            height: 25px;
            background-color: #3a86ff;
            border-radius: 4px;
        }

        .child-leg-left {
            top: 75px;
            left: 25px;
        }

        .child-leg-right {
            top: 75px;
            left: 40px;
        }

        /* Cat character */
        .cat {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 60px;
            z-index: 2;
        }

        /* Replace positions with centered position */
        .cat.position-0 {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Speech bubble for cat */
        .speech-bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 8px;
            width: 100px;
            text-align: center;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: bold;
            color: #e63946;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.1);
            display: inline-block;
        }

        .speech-bubble:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 10px 8px 0;
            border-style: solid;
            border-color: rgba(255, 255, 255, 0.9) transparent transparent;
        }

        .cat-body {
            position: absolute;
            width: 50px;
            height: 30px;
            background-color: #F09E59;
            border-radius: 40% 40% 40% 40%;
            top: 20px;
            left: 15px;
            z-index: 1;
        }

        .cat-head {
            position: absolute;
            width: 35px;
            height: 35px;
            background-color: #F09E59;
            border-radius: 50%;
            top: 5px;
            left: 0;
            z-index: 2;
        }

        .cat-ear {
            position: absolute;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 15px solid #F09E59;
        }

        .cat-ear-left {
            top: -5px;
            left: 2px;
            transform: rotate(-30deg);
        }

        .cat-ear-right {
            top: -5px;
            left: 18px;
            transform: rotate(30deg);
        }

        .cat-eye {
            position: absolute;
            width: 6px;
            height: 10px;
            background-color: #333;
            border-radius: 50%;
        }

        .cat-eye-left {
            top: 15px;
            left: 8px;
        }

        .cat-eye-right {
            top: 15px;
            left: 22px;
        }

        .cat-nose {
            position: absolute;
            width: 5px;
            height: 5px;
            background-color: #333;
            border-radius: 50%;
            top: 23px;
            left: 15px;
        }

        .cat-tail {
            position: absolute;
            width: 40px;
            height: 8px;
            background-color: #F09E59;
            border-radius: 4px;
            top: 25px;
            left: 60px;
            transform-origin: left center;
            transform: rotate(-20deg);
            animation: tailWag 2s infinite;
        }

        @keyframes tailWag {
            0%, 100% { transform: rotate(-20deg); }
            50% { transform: rotate(20deg); }
        }

        .cat-leg {
            position: absolute;
            width: 8px;
            height: 15px;
            background-color: #F09E59;
            border-radius: 4px;
        }

        .cat-leg-1 {
            top: 45px;
            left: 20px;
        }

        .cat-leg-2 {
            top: 45px;
            left: 35px;
        }

        .cat-leg-3 {
            top: 45px;
            left: 50px;
        }

        .cat-leg-4 {
            top: 45px;
            left: 65px;
        }

        /* Wolf character (predator) */
        .wolf {
            position: absolute;
            bottom: 40px;
            right: 30px;
            width: 100px;
            height: 70px;
            z-index: 2;
            transition: right 0.5s ease-in-out;
        }

        .wolf-body {
            position: absolute;
            width: 70px;
            height: 40px;
            background-color: #6b6b6b;
            border-radius: 40% 40% 40% 40%;
            top: 20px;
            left: 15px;
            z-index: 1;
        }

        .wolf-head {
            position: absolute;
            width: 45px;
            height: 45px;
            background-color: #6b6b6b;
            border-radius: 50% 60% 40% 40%;
            top: 5px;
            left: 0;
            z-index: 2;
        }

        .wolf-ear {
            position: absolute;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 20px solid #6b6b6b;
        }

        .wolf-ear-left {
            top: -10px;
            left: 2px;
            transform: rotate(-30deg);
        }

        .wolf-ear-right {
            top: -10px;
            left: 22px;
            transform: rotate(30deg);
        }

        .wolf-eye {
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: #ff0000;
            border-radius: 50%;
        }

        .wolf-eye-left {
            top: 15px;
            left: 10px;
        }

        .wolf-eye-right {
            top: 15px;
            left: 28px;
        }

        .wolf-nose {
            position: absolute;
            width: 10px;
            height: 5px;
            background-color: #333;
            border-radius: 50%;
            top: 25px;
            left: 18px;
        }

        .wolf-mouth {
            position: absolute;
            width: 25px;
            height: 10px;
            border-bottom: 3px solid #333;
            border-radius: 50%;
            top: 30px;
            left: 10px;
        }

        .wolf-tail {
            position: absolute;
            width: 40px;
            height: 12px;
            background-color: #6b6b6b;
            border-radius: 4px;
            top: 25px;
            left: 80px;
            transform-origin: left center;
            transform: rotate(-20deg);
        }

        .wolf-leg {
            position: absolute;
            width: 10px;
            height: 20px;
            background-color: #6b6b6b;
            border-radius: 4px;
        }

        .wolf-leg-1 {
            top: 50px;
            left: 20px;
        }

        .wolf-leg-2 {
            top: 50px;
            left: 35px;
        }

        .wolf-leg-3 {
            top: 50px;
            left: 55px;
        }

        .wolf-leg-4 {
            top: 50px;
            left: 70px;
        }

        /* Fence */
        .fence {
            position: absolute;
            bottom: 40px;
            right: 80px;
            display: flex;
        }

        .fence-post {
            width: 8px;
            height: 25px;
            background: #A1887F;
            margin-right: 5px;
            border-radius: 2px 2px 0 0;
        }

        .child-frown {
            position: absolute;
            width: 16px;
            height: 8px;
            border-top: 3px solid #333;
            border-radius: 50%;
            top: 25px;
            left: 27px;
            display: none;
        }

        .word-display {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 8px;
        }

        .letter-box {
            width: 45px;
            height: 45px;
            border: 2px solid #6E48AA;
            border-radius: 8px;
            margin: 0 3px;
            font-size: 1.8rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            text-transform: uppercase;
            background-color: white;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .letter-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 12px;
            margin-bottom: 2rem;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .hangman-drawing {
                width: 100%;
                max-width: 450px;
            }
        }

        @media (max-width: 640px) {
            .letter-grid {
                grid-template-columns: repeat(7, 1fr);
                gap: 8px;
            }

            .letter-btn {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }
        }

        .letter-btn {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            border: 2px solid #6E48AA;
            background-color: white;
            font-weight: bold;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #151b2e;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .letter-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            background-color: #f9f4ff;
        }

        .letter-btn.correct {
            background: linear-gradient(to bottom, #58CC02, #4BA802);
            color: white;
            border-color: #58CC02;
            pointer-events: none;
        }

        .letter-btn.incorrect {
            background: linear-gradient(to bottom, #FF5252, #E01919);
            color: white;
            border-color: #FF5252;
            pointer-events: none;
        }

        .letter-btn.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        .hint-container {
            background-color: #eff6ff;
            border: 2px solid #93c5fd;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hint-title {
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        #hint-text {
            font-size: 1.2rem;
            color: #1e40af;
            font-weight: 600;
        }

        .result-message {
            font-size: 1.6rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            display: none;
            padding: 1rem;
            border-radius: 12px;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .result-message.win {
            color: white;
            background: linear-gradient(to right, #58CC02, #3CAA00);
        }

        .result-message.lose {
            color: white;
            background: linear-gradient(to right, #FF5252, #D01919);
        }

        .definition-box {
            background-color: #F6EEFF;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            display: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            border: 1px solid rgba(157, 80, 187, 0.2);
        }

        .definition-title {
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: #6E48AA;
            font-size: 1.1rem;
        }

        .control-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.8rem;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            background: linear-gradient(90deg, #A55AC0, #7952B4);
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #151b2e;
            border: 2px solid #151b2e;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            background: #e8e8e8;
        }

        /* Hint button styling */
        .hint-button {
            background: linear-gradient(to bottom, #3b82f6, #2563eb);
            color: white;
            padding: 8px 16px;
            font-weight: bold;
            border-radius: 20px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .hint-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.25);
            background: linear-gradient(to bottom, #4f8df9, #3673ed);
        }

        .hint-button:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .hint-count {
            background-color: white;
            color: #3b82f6;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 8px;
            font-weight: bold;
        }

        .game-over-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            display: none;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .game-over-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #9D50BB;
        }

        .game-over-message {
            font-size: 1.1rem;
            color: #151b2e;
            margin-bottom: 2rem;
            text-align: center;
        }

        .game-over-stats {
            display: flex;
            justify-content: space-around;
            margin: 2rem 0;
        }

        .game-over-stat {
            text-align: center;
        }

        .game-over-stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9D50BB;
        }

        .game-over-stat-label {
            font-size: 1rem;
            color: #151b2e;
        }

        .game-over-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .game-over-btn {
            padding: 0.8rem 1.8rem;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            border: none;
        }

        .game-over-btn-primary {
            background: linear-gradient(90deg, #9D50BB, #6E48AA);
            color: white;
        }

        .game-over-btn-secondary {
            background: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
        }

        .game-over-btn i {
            margin-right: 8px;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f2d74e;
            border-radius: 50%;
            animation: confetti 5s ease-in-out infinite;
        }

        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }

        @keyframes catScared {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-3px) rotate(1deg); }
        }

        /* Info Icon Tooltip */
        .info-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background-color: #3b82f6;
            color: white;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            position: relative;
            margin-left: 8px;
        }

        .tooltip {
            visibility: hidden;
            position: absolute;
            z-index: 100;
            width: 280px;
            background-color: #333;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 12px;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 8px;
            opacity: 0;
            transition: opacity 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .tooltip::after {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent #333 transparent;
        }

        .info-icon:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        .tooltip-list {
            margin-top: 8px;
            padding-left: 16px;
        }

        .tooltip-list li {
            margin-bottom: 4px;
        }

        /* Child positions */
        .child.position-0 {
            left: 30px;
        }

        .child.position-1 {
            left: 80px;
        }

        .child.position-2 {
            left: 130px;
        }

        .child.position-3 {
            left: 180px;
        }

        /* Wolf positions */
        .wolf.position-0 {
            right: 30px;
        }

        .wolf.position-1 {
            right: 80px;
        }

        .wolf.position-2 {
            right: 130px;
        }

        .wolf.position-3 {
            right: 180px;
        }

        /* Scene title */
        .scene-title {
            position: absolute;
            top: 5px;
            left: 0;
            width: 100%;
            text-align: center;
            font-weight: bold;
            color: #1e40af;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
            z-index: 5;
        }

        /* Game instruction title */
        .game-instruction-title {
            font-size: 18px;
            font-weight: 800;
            color: #1e40af;
            text-align: center;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        /* Help Button positioning */
        .help-button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        /* Thought bubble for wolf */
        .thought-bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            top: -30px;
            right: 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.1);
        }

        .thought-bubble:before {
            content: '';
            position: absolute;
            bottom: -8px;
            right: 8px;
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            border: 1px solid rgba(0,0,0,0.1);
        }

        .thought-bubble:after {
            content: '';
            position: absolute;
            bottom: -15px;
            right: 15px;
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            border: 1px solid rgba(0,0,0,0.1);
        }

        /* Cat icon inside wolf's thought bubble */
        .cat-icon {
            width: 22px;
            height: 22px;
            position: relative;
        }

        .cat-icon-head {
            width: 14px;
            height: 12px;
            background-color: #F09E59;
            border-radius: 50% 50% 40% 40%;
            position: absolute;
            top: 2px;
            left: 4px;
        }

        .cat-icon-ear {
            position: absolute;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 5px solid #F09E59;
        }

        .cat-icon-ear-left {
            top: -2px;
            left: 3px;
            transform: rotate(-30deg);
        }

        .cat-icon-ear-right {
            top: -2px;
            left: 11px;
            transform: rotate(30deg);
        }

        .cat-icon-body {
            width: 16px;
            height: 10px;
            background-color: #F09E59;
            border-radius: 40% 40% 40% 40%;
            position: absolute;
            top: 11px;
            left: 3px;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <div class="container mx-auto">
                <h1 class="game-title">{{ $gameData['title'] }}</h1>
                <p class="game-description">{{ $gameData['description'] }}</p>
                <div class="gradient-border"></div>

                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-title">Skor</div>
                        <div class="stat-value score" id="score">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Benar</div>
                        <div class="stat-value" id="correct-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Tersisa</div>
                        <div class="stat-value" id="remaining-count">{{ count($gameData['words']) }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-title">Kesempatan</div>
                        <div class="stat-value" id="attempts-left">{{ $gameData['max_attempts'] }}</div>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>

                <div class="game-container" id="game-content">
                    <!-- Hangman game content -->
                    <div id="hangman-game">
                        <!-- Instruction title above the drawing -->
                        <div class="game-instruction-title">
                            TOLONG SELAMATKAN KUCING DAN TEBAK KATA!
                        </div>

                        <!-- Hangman drawing -->
                        <div class="hangman-container">
                            <div class="hangman-drawing">
                                <!-- Scenery elements -->
                                <div class="ground"></div>
                                <div class="grass"></div>
                                <div class="cloud cloud-1"></div>
                                <div class="cloud cloud-2"></div>
                                <div class="cloud cloud-3"></div>
                                <div class="sun"></div>
                                <div class="tree">
                                    <div class="tree-top"></div>
                                    <div class="tree-trunk"></div>
                                </div>
                                <div class="flowers">
                                    <div class="flower flower-1">
                                        <div class="flower-stem"></div>
                                    </div>
                                    <div class="flower flower-2">
                                        <div class="flower-stem"></div>
                                    </div>
                                    <div class="flower flower-3">
                                        <div class="flower-stem"></div>
                                    </div>
                                </div>
                                <div class="butterfly butterfly-1">
                                    <div class="butterfly-wing butterfly-wing-left"></div>
                                    <div class="butterfly-body"></div>
                                    <div class="butterfly-wing butterfly-wing-right"></div>
                                </div>
                                <div class="fence">
                                    <div class="fence-post"></div>
                                    <div class="fence-post"></div>
                                    <div class="fence-post"></div>
                                    <div class="fence-post"></div>
                                </div>

                                <!-- Child character -->
                                <div class="child position-0" id="child">
                                    <div class="child-head"></div>
                                    <div class="child-body"></div>
                                    <div class="child-eye child-eye-left"></div>
                                    <div class="child-eye child-eye-right"></div>
                                    <div class="child-smile"></div>
                                    <div class="child-frown" id="child-frown"></div>
                                    <div class="child-arm child-arm-left"></div>
                                    <div class="child-arm child-arm-right"></div>
                                    <div class="child-leg child-leg-left"></div>
                                    <div class="child-leg child-leg-right"></div>
                                </div>

                                <!-- Cat character -->
                                <div class="cat position-0" id="cat">
                                    <div class="speech-bubble">Meow meow</div>
                                    <div class="cat-head">
                                        <div class="cat-ear cat-ear-left"></div>
                                        <div class="cat-ear cat-ear-right"></div>
                                        <div class="cat-eye cat-eye-left"></div>
                                        <div class="cat-eye cat-eye-right"></div>
                                        <div class="cat-nose"></div>
                                    </div>
                                    <div class="cat-body"></div>
                                    <div class="cat-tail"></div>
                                    <div class="cat-leg cat-leg-1"></div>
                                    <div class="cat-leg cat-leg-2"></div>
                                    <div class="cat-leg cat-leg-3"></div>
                                </div>

                                <!-- Wolf character (predator) -->
                                <div class="wolf position-0" id="wolf">
                                    <div class="thought-bubble">
                                        <div class="cat-icon">
                                            <div class="cat-icon-ear cat-icon-ear-left"></div>
                                            <div class="cat-icon-ear cat-icon-ear-right"></div>
                                            <div class="cat-icon-head"></div>
                                            <div class="cat-icon-body"></div>
                                        </div>
                                    </div>
                                    <div class="wolf-head">
                                        <div class="wolf-ear wolf-ear-left"></div>
                                        <div class="wolf-ear wolf-ear-right"></div>
                                        <div class="wolf-eye wolf-eye-left"></div>
                                        <div class="wolf-eye wolf-eye-right"></div>
                                        <div class="wolf-nose"></div>
                                        <div class="wolf-mouth"></div>
                                    </div>
                                    <div class="wolf-body"></div>
                                    <div class="wolf-tail"></div>
                                    <div class="wolf-leg wolf-leg-1"></div>
                                    <div class="wolf-leg wolf-leg-2"></div>
                                    <div class="wolf-leg wolf-leg-3"></div>
                                    <div class="wolf-leg wolf-leg-4"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Word display -->
                        <div class="word-display" id="word-display">
                            <!-- Will be populated with letter boxes -->
                        </div>

                        <!-- Hint -->
                        <div class="hint-container">
                            <div class="hint-title">
                                Petunjuk:
                                <div class="info-icon">
                                    i
                                    <div class="tooltip">
                                        <strong>Cara Bermain:</strong>
                                        <ul class="tooltip-list">
                                            <li>Tebak kata dengan memilih huruf.</li>
                                            <li>Benar = huruf muncul.</li>
                                            <li>Salah = kucing mendekati serigala.</li>
                                            <li>Selamatkan kucing sebelum tertangkap!</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="hint-text"></div>
                        </div>

                        <!-- Help button container (positioned at bottom right) -->
                        <div class="help-button-container">
                            <button id="hint-button" class="hint-button">
                                <i class="fas fa-lightbulb mr-1"></i> Bantuan <span class="hint-count" id="hint-count">2</span>
                            </button>
                        </div>

                        <!-- Replace instructions with empty space since we moved them to tooltip -->
                        <div class="mb-4"></div>

                        <!-- Result message -->
                        <div class="result-message win" id="win-message">
                            Selamat! Kamu berhasil menebak kata <span id="correct-word-win"></span>
                        </div>
                        <div class="result-message lose" id="lose-message">
                            Sayang sekali! Kata yang benar adalah <span id="correct-word-lose"></span>
                        </div>

                        <!-- Definition box -->
                        <div class="definition-box" id="definition-box">
                            <div class="definition-title">Arti Kata:</div>
                            <div id="definition-text"></div>
                        </div>

                        <!-- Letter buttons -->
                        <div class="letter-grid" id="letter-grid">
                            <!-- Will be populated with letter buttons -->
                        </div>

                        <!-- Control buttons -->
                        <div class="control-buttons">
                            <button id="next-btn" class="btn btn-primary" style="display: none;">
                                Lanjut <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Game over container -->
                    <div id="game-over-container" class="game-over-container">
                        <h2 class="game-over-title">Permainan Selesai!</h2>
                        <p class="game-over-message">Kamu telah menyelesaikan semua kata dalam permainan Word Hangman.</p>

                        <div class="game-over-stats">
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-score">0</div>
                                <div class="game-over-stat-label">Skor Akhir</div>
                            </div>
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-correct">0</div>
                                <div class="game-over-stat-label">Kata Benar</div>
                            </div>
                            <div class="game-over-stat">
                                <div class="game-over-stat-value" id="final-time">00:00</div>
                                <div class="game-over-stat-label">Waktu</div>
                            </div>
                        </div>

                        <div class="game-over-buttons">
                            <button id="play-again-btn" class="game-over-btn game-over-btn-secondary">
                                <i class="fas fa-redo"></i> Main Lagi
                            </button>
                            <a href="{{ route('permainan.index') }}" class="game-over-btn game-over-btn-primary">
                                <i class="fas fa-home"></i> Kembali ke Menu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Game variables
            const gameData = @json($gameData['words']);
            const maxAttempts = 5; // Fixed to 5 attempts regardless of server configuration
            const maxHints = 2; // Maximum number of hints per word (changed from 3 to 2)
            let currentWordIndex = 0;
            let currentWord = '';
            let guessedLetters = [];
            let correctLetters = [];
            let wrongAttempts = 0;
            let hintsRemaining = maxHints;
            let score = 0;
            let correctWords = 0;
            let isGameOver = false;
            let timer;
            let seconds = 0;

            // DOM elements
            const scoreElement = document.getElementById('score');
            const correctCountElement = document.getElementById('correct-count');
            const remainingCountElement = document.getElementById('remaining-count');
            const attemptsLeftElement = document.getElementById('attempts-left');
            const progressBar = document.getElementById('progress-bar');
            const wordDisplay = document.getElementById('word-display');
            const letterGrid = document.getElementById('letter-grid');
            const hintText = document.getElementById('hint-text');
            const hintButton = document.getElementById('hint-button');
            const hintCountDisplay = document.getElementById('hint-count');
            const definitionText = document.getElementById('definition-text');
            const definitionBox = document.getElementById('definition-box');
            const winMessage = document.getElementById('win-message');
            const loseMessage = document.getElementById('lose-message');
            const correctWordWin = document.getElementById('correct-word-win');
            const correctWordLose = document.getElementById('correct-word-lose');
            const nextButton = document.getElementById('next-btn');
            const gameContainer = document.getElementById('hangman-game');
            const gameOverContainer = document.getElementById('game-over-container');

            // Final stats
            const finalScore = document.getElementById('final-score');
            const finalCorrect = document.getElementById('final-correct');
            const finalTime = document.getElementById('final-time');

            // Start the game
            initGame();

            function initGame() {
                // Shuffle the words
                shuffleArray(gameData);

                // Start timer
                startTimer();

                // Load first word
                loadWord(currentWordIndex);

                // Create letter buttons (A-Z)
                createLetterButtons();

                // Update progress bar
                updateProgressBar();

                // Make game easier by giving one letter for free
                revealOneLetterForFree();

                // Add hint button functionality
                setupHintButton();
            }

            function setupHintButton() {
                // Reset hints remaining
                hintsRemaining = maxHints;
                hintCountDisplay.textContent = hintsRemaining;

                // Enable hint button
                hintButton.disabled = false;

                // Add click event
                hintButton.onclick = useHint;
            }

            function useHint() {
                if (hintsRemaining <= 0 || isGameOver) return;

                // Get unguessed letters
                const unguessedLetters = [];
                for (let i = 0; i < currentWord.length; i++) {
                    const letter = currentWord[i].toUpperCase();
                    if (!guessedLetters.includes(letter)) {
                        unguessedLetters.push(letter);
                    }
                }

                // If no unguessed letters, do nothing
                if (unguessedLetters.length === 0) return;

                // Pick a random unguessed letter
                const randomIndex = Math.floor(Math.random() * unguessedLetters.length);
                const letterToReveal = unguessedLetters[randomIndex];

                // Find and click the button for this letter
                const letterButton = document.querySelector(`.letter-btn[data-letter="${letterToReveal}"]`);
                if (letterButton && !letterButton.classList.contains('correct') && !letterButton.classList.contains('incorrect')) {
                    letterButton.click();
                }

                // Decrease hint count
                hintsRemaining--;
                hintCountDisplay.textContent = hintsRemaining;

                // Disable button if no hints left
                if (hintsRemaining <= 0) {
                    hintButton.disabled = true;
                }
            }

            function loadWord(index) {
                // Reset game state for new word
                currentWord = gameData[index].word;
                guessedLetters = [];
                correctLetters = [];
                wrongAttempts = 0;
                hintsRemaining = maxHints;

                // Reset UI
                resetUI();

                // Set hint text - make sure it's shown automatically
                hintText.textContent = gameData[index].hint;
                hintText.classList.add('font-bold');

                // Create word display
                createWordDisplay();

                // Reset hangman figure
                resetHangman();

                // Update attempts - Fixed to 5 attempts
                attemptsLeftElement.textContent = maxAttempts;

                // Reset hint button
                hintCountDisplay.textContent = hintsRemaining;
                hintButton.disabled = false;

                // Give a free letter to make game easier
                setTimeout(revealOneLetterForFree, 300);
            }

            function createWordDisplay() {
                // Clear the word display
                wordDisplay.innerHTML = '';

                // Create a letter box for each letter in the word
                for (let i = 0; i < currentWord.length; i++) {
                    const letter = currentWord[i];
                    const letterBox = document.createElement('div');
                    letterBox.classList.add('letter-box');

                    // If letter has been guessed, show it
                    if (guessedLetters.includes(letter)) {
                        letterBox.textContent = letter;
                        correctLetters.push(letter);
                    } else {
                        letterBox.textContent = '';
                    }

                    wordDisplay.appendChild(letterBox);
                }
            }

            function updateWordDisplay() {
                const letterBoxes = wordDisplay.querySelectorAll('.letter-box');

                // Update each letter box
                for (let i = 0; i < currentWord.length; i++) {
                    const letter = currentWord[i];
                    if (guessedLetters.includes(letter)) {
                        letterBoxes[i].textContent = letter;
                    }
                }

                // Check if all letters have been guessed
                if (isWordComplete()) {
                    wordCompleted();
                }
            }

            function isWordComplete() {
                // Check if every letter in the word has been guessed
                return [...currentWord].every(letter => guessedLetters.includes(letter));
            }

            function createLetterButtons() {
                // Clear the letter grid
                letterGrid.innerHTML = '';

                // Create a button for each letter of the alphabet
                for (let i = 65; i <= 90; i++) {
                    const letter = String.fromCharCode(i);
                    const button = document.createElement('button');
                    button.classList.add('letter-btn');
                    button.textContent = letter;
                    button.dataset.letter = letter;
                    button.addEventListener('click', () => handleLetterClick(letter, button));
                    letterGrid.appendChild(button);
                }
            }

            function resetLetterButtons() {
                // Reset all letter buttons to default state
                const buttons = letterGrid.querySelectorAll('.letter-btn');
                buttons.forEach(button => {
                    button.classList.remove('correct', 'incorrect', 'disabled');
                    button.disabled = false;
                });
            }

            function handleLetterClick(letter, button) {
                // If game is over, do nothing
                if (isGameOver) return;

                // Disable the button to prevent multiple clicks
                button.disabled = true;
                button.classList.add('disabled');

                // Check if the letter is in the word
                if (currentWord.includes(letter)) {
                    // Correct guess
                    button.classList.remove('disabled');
                    button.classList.add('correct');
                    guessedLetters.push(letter);
                    updateWordDisplay();

                    // Add points for correct letter - MAKE GAME EASIER: more points
                    score += 3;
                    scoreElement.textContent = score;

                    // Move child closer to cat
                    moveChildCloser();
                } else {
                    // Incorrect guess
                    button.classList.remove('disabled');
                    button.classList.add('incorrect');
                    wrongAttempts++;

                    // Update attempts left counter
                    attemptsLeftElement.textContent = maxAttempts - wrongAttempts;

                    // Move wolf closer to cat
                    moveWolfCloser(wrongAttempts - 1);

                    // Check if game is lost - using fixed max attempts
                    if (wrongAttempts >= maxAttempts) {
                        wordFailed();
                    }
                }
            }

            // New function to move child closer to cat
            function moveChildCloser() {
                const child = document.getElementById('child');
                if (child) {
                    // Determine current position
                    let currentPosition = 0;
                    for (let i = 0; i <= 3; i++) {
                        if (child.classList.contains(`position-${i}`)) {
                            currentPosition = i;
                            break;
                        }
                    }

                    // Only move if not at position 3 yet
                    if (currentPosition < 3) {
                        // Remove current position class
                        child.classList.remove(`position-${currentPosition}`);
                        // Add new position class
                        child.classList.add(`position-${currentPosition + 1}`);
                    }
                }
            }

            // Renamed and modified function to move wolf closer
            function moveWolfCloser(index) {
                const wolf = document.getElementById('wolf');
                if (wolf) {
                    // Remove current position class
                    for (let i = 0; i <= 3; i++) {
                        wolf.classList.remove(`position-${i}`);
                    }

                    // Add new position class based on wrong attempts
                    // Map 0-5 wrong attempts to 0-3 positions
                    const adjustedIndex = Math.min(Math.floor(index * 0.75), 3);
                    wolf.classList.add(`position-${adjustedIndex}`);

                    // Show frown face when wolf is close to cat
                    if (adjustedIndex >= 2) {
                        const smile = document.querySelector('.child-smile');
                        const frown = document.getElementById('child-frown');
                        if (smile && frown) {
                            smile.style.display = 'none';
                            frown.style.display = 'block';
                        }
                    }
                }
            }

            function resetHangman() {
                // Reset child position
                const child = document.getElementById('child');
                if (child) {
                    // Remove all position classes
                    for (let i = 0; i <= 3; i++) {
                        child.classList.remove(`position-${i}`);
                    }
                    // Set to starting position
                    child.classList.add('position-0');
                    // Clear any inline styles that might have been applied
                    child.style.left = '';
                    child.style.transform = '';
                    child.style.transition = '';
                }

                // Reset cat position
                const cat = document.getElementById('cat');
                if (cat) {
                    // No need to move cat, it's centered
                    // But clear any inline styles that might have been applied
                    cat.style.left = '';
                    cat.style.transform = 'translateX(-50%)';
                    cat.style.transition = '';
                }

                // Reset wolf position
                const wolf = document.getElementById('wolf');
                if (wolf) {
                    // Remove all position classes
                    for (let i = 0; i <= 3; i++) {
                        wolf.classList.remove(`position-${i}`);
                    }
                    // Set to starting position
                    wolf.classList.add('position-0');
                    // Clear any inline styles that might have been applied
                    wolf.style.right = '';
                    wolf.style.transform = '';
                    wolf.style.transition = '';
                }

                // Reset child expression
                const smile = document.querySelector('.child-smile');
                const frown = document.getElementById('child-frown');
                if (smile && frown) {
                    smile.style.display = 'block';
                    frown.style.display = 'none';
                }
            }

            function wordFailed() {
                // Disable all letter buttons
                disableAllButtons();

                // Show lose message
                correctWordLose.textContent = currentWord;
                loseMessage.style.display = 'block';

                // Show definition
                definitionText.textContent = gameData[currentWordIndex].definition;
                definitionBox.style.display = 'block';

                // Move wolf to capture cat when game is lost
                const wolf = document.getElementById('wolf');
                if (wolf) {
                    wolf.style.right = '50%';
                    wolf.style.transform = 'translateX(50%)';
                    wolf.style.transition = 'right 0.5s ease-in-out, transform 0.5s ease-in-out';
                }

                // Show next button if there are more words
                if (currentWordIndex < gameData.length - 1) {
                    nextButton.style.display = 'block';
                    nextButton.onclick = goToNextWord;
                } else {
                    endGame();
                }

                // Update progress bar
                updateProgressBar();
            }

            function wordCompleted() {
                // Disable all letter buttons
                disableAllButtons();

                // Show win message
                correctWordWin.textContent = currentWord;
                winMessage.style.display = 'block';

                // Show definition
                definitionText.textContent = gameData[currentWordIndex].definition;
                definitionBox.style.display = 'block';

                // Move child to reach cat when word is completed
                const child = document.getElementById('child');
                if (child) {
                    child.style.left = '50%';
                    child.style.transform = 'translateX(-50%)';
                    child.style.transition = 'left 0.5s ease-in-out, transform 0.5s ease-in-out';
                }

                // Add points for completing the word
                score += 10;
                correctWords++;

                // Update UI
                scoreElement.textContent = score;
                correctCountElement.textContent = correctWords;
                remainingCountElement.textContent = gameData.length - (currentWordIndex + 1);

                // Show next button if there are more words
                if (currentWordIndex < gameData.length - 1) {
                    nextButton.style.display = 'block';
                    nextButton.onclick = goToNextWord;
                } else {
                    endGame();
                }

                // Update progress bar
                updateProgressBar();
            }

            function disableAllButtons() {
                // Disable all letter buttons
                const buttons = letterGrid.querySelectorAll('.letter-btn');
                buttons.forEach(button => {
                    if (!button.classList.contains('correct') && !button.classList.contains('incorrect')) {
                        button.classList.add('disabled');
                        button.disabled = true;
                    }
                });
            }

            function goToNextWord() {
                // Make sure to fully reset the scene before loading the next word
                resetHangman();

                // Move to next word
                currentWordIndex++;
                loadWord(currentWordIndex);
            }

            function resetUI() {
                // Reset messages
                winMessage.style.display = 'none';
                loseMessage.style.display = 'none';

                // Reset definition box
                definitionBox.style.display = 'none';

                // Reset letter buttons
                resetLetterButtons();

                // Reset hint button
                hintButton.disabled = false;
                hintCountDisplay.textContent = maxHints;

                // Hide next button
                nextButton.style.display = 'none';
            }

            function endGame() {
                isGameOver = true;
                clearInterval(timer);

                // Save game data to server
                saveGameResult();

                // Update final stats
                finalScore.textContent = score;
                finalCorrect.textContent = correctWords;
                finalTime.textContent = formatTime(seconds);

                // Show game over container
                setTimeout(() => {
                    gameContainer.style.display = 'none';
                    gameOverContainer.style.display = 'block';
                    createConfetti();

                    // Setup play again button
                    document.getElementById('play-again-btn').addEventListener('click', function() {
                        window.location.reload();
                    });
                }, 2000);
            }

            function saveGameResult() {
                // Send score to server
                fetch('{{ route("permainan.complete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        game_slug: '{{ $gameData['slug'] }}',
                        score: score,
                        time_taken: seconds
                    })
                });
            }

            function startTimer() {
                timer = setInterval(() => {
                    seconds++;
                    // No need to update a timer element in this game
                }, 1000);
            }

            function formatTime(totalSeconds) {
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            function updateProgressBar() {
                const progress = ((currentWordIndex + 1) / gameData.length) * 100;
                progressBar.style.width = `${progress}%`;
            }

            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            function createConfetti() {
                const container = document.querySelector('.main-content');
                for (let i = 0; i < 50; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = `${Math.random() * 100}%`;
                    confetti.style.animationDuration = `${Math.random() * 3 + 2}s`;
                    confetti.style.animationDelay = `${Math.random() * 5}s`;
                    confetti.style.backgroundColor = getRandomColor();
                    container.appendChild(confetti);

                    // Remove confetti after animation
                    setTimeout(() => {
                        confetti.remove();
                    }, 8000);
                }
            }

            function getRandomColor() {
                const colors = ['#f2d74e', '#95d94c', '#f25252', '#5283f2', '#ce52f2', '#f2a852'];
                return colors[Math.floor(Math.random() * colors.length)];
            }

            function revealOneLetterForFree() {
                // Only reveal if word has at least 4 letters
                if (currentWord.length >= 4) {
                    // Choose a random letter from the word
                    const randomIndex = Math.floor(Math.random() * currentWord.length);
                    const letter = currentWord[randomIndex].toUpperCase();

                    // Simulate clicking the letter
                    const letterButton = document.querySelector(`.letter-btn[data-letter="${letter}"]`);
                    if (letterButton && !guessedLetters.includes(letter)) {
                        guessedLetters.push(letter);
                        letterButton.classList.add('correct');
                        letterButton.disabled = true;
                        updateWordDisplay();

                        // Add points for correct letter (but fewer than normal guessing)
                        score += 1;
                        scoreElement.textContent = score;
                    }
                }
            }
        });
    </script>
</body>
</html>
