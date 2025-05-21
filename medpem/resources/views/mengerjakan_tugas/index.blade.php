<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengerjakan Tugas | Media Pembelajaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F3F4F6;
            color: #374151;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 160px !important;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 180px !important;
            }
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: linear-gradient(90deg, #B81C7C 0%, #7028E4 50%, #4846DB 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 3px 3px 10px rgba(0,0,0,0.3);
            position: relative;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
        }

        .subtitle {
            text-align: center;
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: #94A3B8;
        }

        .gradient-border {
            height: 4px;
            width: 100%;
            max-width: none;
            background: linear-gradient(90deg, #B81C7C 0%, #7028E4 50%, #4846DB 100%);
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>
<body>
    @include('header')
    <div class="flex">
    @include('sidebar')

        <div class="main-content p-6 relative" style="padding-top: 160px !important;">
            <div class="container mx-auto">
                <div class="text-center mb-8 px-6">
                    <h1 class="content-title">
                        MENGERJAKAN TUGAS <i class="fas fa-tasks ml-3 text-white"></i>
                    </h1>
                    <p class="subtitle">Mari belajar hal-hal seru dan menarik bersama!</p>
</div>
                <div class="gradient-border"></div>

                <!-- Page content goes here -->
                <div class="mt-8 bg-white rounded-xl shadow-md p-8">
                    <p class="text-gray-700 text-center text-lg">Anda sedang berada di menu Mengerjakan Tugas.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
