<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $materi->title }} - Materi Belajar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background-color: #151b2e;
            color: #ffffff;
            background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4d6.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f9e0.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4da.svg');
            background-size: 80px, 120px, 70px, 100px;
            background-position: top 20px left 20px, top right 20px, bottom left 40px, bottom right 40px;
            background-repeat: no-repeat;
            background-blend-mode: soft-light;
            background-opacity: 0.3;
            overflow-x: hidden;
        }

        /* Fix untuk header dropdown */
        .header-dropdown-container {
            z-index: 1000;
        }

        #userDropdownDiv {
            z-index: 1001;
        }

        /* Fix untuk main content */
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

        /* Pastikan header tidak memiliki garis */
        .duolingo-header {
            border-bottom: none !important;
            box-shadow: none !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 90px;
            }
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

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
            background: #7028E4;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            padding: 0.5rem 2rem;
            border-radius: 8px;
            display: inline-block;
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

        .progress-container {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.7), rgba(17, 24, 39, 0.7));
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border: 4px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        .progress-container::before {
            content: '';
            position: absolute;
            top: -10px;
            right: -10px;
            width: 80px;
            height: 80px;
            background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f680.svg');
            background-size: contain;
            background-repeat: no-repeat;
            transform: rotate(15deg);
            opacity: 0.2;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .progress-bar {
            height: 18px;
            border-radius: 10px;
            transition: width 1s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                        rgba(255,255,255,0.15) 25%,
                        rgba(255,255,255,0.3) 50%,
                        rgba(255,255,255,0.15) 75%);
            width: 50%;
            animation: progressShine 2s infinite linear;
        }

        @keyframes progressShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .content-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2.5rem;
            padding-top: 3rem;
            margin-bottom: 2rem;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            color: #1e293b;
            position: relative;
            border: 4px solid #38B2AC;
            animation: slideUp 0.8s ease-out;
            animation-delay: 0.3s;
            animation-fill-mode: both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-container::after {
            content: '';
            position: absolute;
            bottom: -15px;
            right: -15px;
            width: 90px;
            height: 90px;
            background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f9d0.svg');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.7;
            transform: rotate(10deg);
            z-index: 1;
        }

        .content-icon {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 3rem;
            background: linear-gradient(45deg, #38B2AC, #4FD1C5);
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 2;
            border: 3px solid white;
        }

        .materi-content {
            background-color: #f8fafc;
            background-image:
                radial-gradient(rgba(56, 178, 172, 0.1) 3px, transparent 3px),
                radial-gradient(rgba(56, 178, 172, 0.1) 3px, transparent 3px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
            border-radius: 16px;
            padding: 1.8rem;
            line-height: 1.9;
            font-size: 1.2rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 2px dashed #38B2AC;
            max-height: 600px;
            overflow-y: auto;
            position: relative;
        }

        .materi-content::-webkit-scrollbar {
            width: 14px;
        }

        .materi-content::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .materi-content::-webkit-scrollbar-thumb {
            background: #38B2AC;
            border-radius: 10px;
            border: 3px solid #f1f5f9;
        }

        .materi-content::-webkit-scrollbar-thumb:hover {
            background: #2C9A94;
        }

        /* Rich content styling */
        .materi-content p {
            margin-bottom: 1rem;
        }

        .materi-content h1,
        .materi-content h2,
        .materi-content h3,
        .materi-content h4,
        .materi-content h5,
        .materi-content h6 {
            font-weight: bold;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #2C7A7B;
        }

        .materi-content h1 { font-size: 2rem; }
        .materi-content h2 { font-size: 1.8rem; }
        .materi-content h3 { font-size: 1.6rem; }
        .materi-content h4 { font-size: 1.4rem; }

        .materi-content ul,
        .materi-content ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }

        .materi-content ul { list-style-type: disc; }
        .materi-content ol { list-style-type: decimal; }

        .materi-content a {
            color: #38B2AC;
            text-decoration: underline;
            font-weight: bold;
        }

        .materi-content img {
            max-width: 100%;
            height: auto;
            margin: 1rem 0;
            border-radius: 12px;
            border: 3px solid #38B2AC;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .materi-content table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1.5rem;
            border: 2px solid #38B2AC;
            border-radius: 8px;
            overflow: hidden;
        }

        .materi-content table th,
        .materi-content table td {
            border: 1px solid #B2F5EA;
            padding: 0.75rem;
        }

        .materi-content table th {
            background-color: #38B2AC;
            color: white;
            font-weight: bold;
        }

        .materi-content table tr:nth-child(even) {
            background-color: #E6FFFA;
        }

        .materi-content table tr:hover {
            background-color: #B2F5EA;
        }

        .materi-content .youtube-embed,
        .materi-content .document-embed,
        .materi-content .presentation-embed {
            margin: 1.5rem 0;
            border: 3px solid #38B2AC;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .button {
            padding: 14px 28px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .back-button {
            background-color: #6B7280;
            color: white;
        }

        .back-button:hover {
            background-color: #4B5563;
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .completed-button {
            background-color: #58CC02;
            color: white;
            position: relative;
            overflow: hidden;
            font-size: 1.2rem;
        }

        .completed-button:hover {
            background-color: #4CAF50;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(88, 204, 2, 0.3);
        }

        .completed-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .completed-button:hover::before {
            left: 100%;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .float {
            animation: floating 6s infinite;
            display: inline-block;
            font-size: 2.5rem;
            margin-left: 10px;
            filter: drop-shadow(0 2px 2px rgba(0,0,0,0.3));
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.7;
            font-size: 3.5rem;
            filter: drop-shadow(0 3px 3px rgba(0,0,0,0.2));
        }

        .decoration-1 {
            top: 100px;
            right: 10%;
            animation: floating 8s infinite;
        }

        .decoration-2 {
            bottom: 15%;
            left: 7%;
            animation: floating 10s infinite 1s;
        }

        .decoration-3 {
            top: 40%;
            left: 3%;
            font-size: 2.5rem;
            animation: floating 7s infinite 0.5s;
        }

        .decoration-4 {
            bottom: 30%;
            right: 5%;
            font-size: 2.5rem;
            animation: floating 9s infinite 1.5s;
        }

        .reading-guide {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, #38B2AC, #4FD1C5);
            color: white;
            padding: 15px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 100;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
            font-weight: bold;
            display: flex;
            align-items: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
            font-size: 1.1rem;
        }

        .reading-guide.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .progress-emoji {
            font-size: 2rem;
            margin-right: 12px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Success notification */
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            transform: translateX(100px);
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            transition: all 0.5s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            max-width: 90%;
            animation: pulse 2s infinite;
        }

        .success-notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        @media (max-width: 640px) {
            .success-notification {
                padding: 15px 20px;
                top: 10px;
                right: 10px;
                max-width: calc(100% - 20px);
            }

            .success-notification .icon {
                font-size: 1.5rem;
            }

            .success-notification .message {
                font-size: 1rem;
            }
        }

        .success-notification .icon {
            font-size: 2.5rem;
            margin-right: 15px;
            animation: bounce 2s infinite;
        }

        .success-notification .message {
            font-weight: bold;
            font-size: 1.2rem;
            line-height: 1.4;
        }

        /* Reading tracking animation */
        .reading-tracker {
            position: absolute;
            right: -40px;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .tracker-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: rgba(56, 178, 172, 0.3);
            transition: all 0.3s ease;
        }

        .tracker-dot.active {
            background-color: #38B2AC;
            box-shadow: 0 0 10px #38B2AC;
            transform: scale(1.3);
        }

        /* Section headers */
        .section-header {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #38B2AC, transparent);
            border-radius: 2px;
        }

        /* Fun quote box */
        .fun-fact-box {
            background-color: rgba(56, 178, 172, 0.1);
            border: 2px dashed #38B2AC;
            border-radius: 15px;
            padding: 15px;
            margin: 20px 0;
            position: relative;
            font-size: 1rem;
        }

        .fun-fact-box::before {
            content: '💡 Tips Seru!';
            position: absolute;
            top: -12px;
            left: 20px;
            background-color: #38B2AC;
            color: white;
            padding: 2px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .completion-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 6px 15px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 1.5rem;
        }

        .completion-badge i {
            margin-right: 8px;
            font-size: 1.2rem;
        }

        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loader-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .loader {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 8px solid rgba(255, 255, 255, 0.1);
            border-top-color: #10B981;
            animation: spin 1s infinite linear;
        }

        .loader-text {
            position: absolute;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 100px;
            text-align: center;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Styles untuk tampilan dokumen yang diupload */
        .document-embed {
            margin: 15px 0;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .document-header {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            background-color: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
        }

        .document-title {
            display: flex;
            align-items: center;
            font-weight: 600;
            font-size: 1.1rem;
            color: #334155;
            flex-grow: 1;
        }

        .document-icon {
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .document-pdf .document-icon {
            color: #ef4444;
        }

        .document-word .document-icon {
            color: #3b82f6;
        }

        .document-powerpoint .document-icon {
            color: #f97316;
        }

        .document-actions {
            display: flex;
            gap: 10px;
        }

        .document-button {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .document-view {
            background-color: #3b82f6;
            color: white;
        }

        .document-view:hover {
            background-color: #2563eb;
        }

        .document-download {
            background-color: #10b981;
            color: white;
        }

        .document-download:hover {
            background-color: #059669;
        }

        .document-content {
            padding: 0;
            min-height: 400px;
        }

        .document-content iframe {
            width: 100%;
            height: 500px;
            border: none;
        }

        /* Media query for smaller screens */
        @media (max-width: 640px) {
            .document-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .document-actions {
                width: 100%;
            }

            .document-button {
                flex: 1;
                justify-content: center;
            }

            .document-content iframe {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content px-6">
            <!-- Decorative elements -->
            <div class="decoration decoration-1"></div>
            <div class="decoration decoration-2">🎓</div>
            <div class="decoration decoration-3">✏️</div>
            <div class="decoration decoration-4">🔍</div>

            <div class="max-w-5xl mx-auto">
                <h1 class="page-title">{{ $materi->title }} <i class="fas fa-book ml-3 text-white"></i></h1>
                {{-- <p class="subtitle">Belajar dengan menyenangkan</p> --}}
                <div class="gradient-border"></div>

                @auth
                @if($userProgress >= 100)
                <div class="completion-badge">
                    <i class="fas fa-check-circle"></i> Materi Sudah Dipahami
                </div>
                @endif
                @endauth

                <div class="content-container">
                    <span class="content-icon">📝</span>
                    <div class="mt-6">
                        <h2 class="text-3xl font-bold text-indigo-800 mb-4 section-header">Penjelasan Singkat</h2>
                        <p class="text-gray-700 mb-8 text-xl">{{ $materi->description }}</p>

                        <div class="fun-fact-box">
                            <p class="mb-0">Bacalah dengan teliti dan pelan-pelan. Kamu juga bisa minta bantuan guru atau orang tua jika ada yang tidak kamu mengerti. Selamat belajar, Sobat Pintar! 😊</p>
                        </div>

                        <h2 class="text-3xl font-bold text-indigo-800 mb-4 mt-8 section-header">Materinya</h2>
                        <div id="materi-content" class="materi-content">
                            {!! $materi->content !!}
                        </div>
                    </div>
                </div>

                <div class="content-container">
                    <span class="content-icon">📄</span>
                    <div class="mt-6">
                        <h2 class="text-3xl font-bold text-indigo-800 mb-4 section-header">Dokumen Pendukung</h2>
                        <p class="text-gray-700 mb-4 text-xl">Dokumen dan file pendukung untuk membantu pembelajaran kamu.</p>

                        <div id="documents-container" class="documents-container">
                            <!-- Display documents directly from the database -->
                            @if(isset($documents) && count($documents) > 0)
                                @foreach($documents as $document)
                                <div class="document-embed document-{{ $document->document_type }} mb-6">
                                    <div class="document-header">
                                        <div class="document-title">
                                            @if($document->document_type == 'pdf')
                                                <i class="fas fa-file-pdf document-icon"></i>
                                            @elseif($document->document_type == 'word')
                                                <i class="fas fa-file-word document-icon"></i>
                                            @elseif($document->document_type == 'powerpoint')
                                                <i class="fas fa-file-powerpoint document-icon"></i>
                                            @else
                                                <i class="fas fa-file document-icon"></i>
                                            @endif
                                            {{ $document->title ?: 'Dokumen' }}
                                        </div>
                                        <div class="document-actions">
                                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="document-button document-view">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="{{ asset('storage/' . $document->file_path) }}" download class="document-button document-download">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        </div>
                                    </div>
                                    <div class="document-content">
                                        <iframe src="{{ asset('storage/' . $document->file_path) }}" frameborder="0" width="100%" height="500px"></iframe>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Will be populated by JavaScript if there are embedded documents in the content -->
                                <div id="no-documents-message" class="text-center p-10 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                                    <div class="text-4xl mb-4">📑</div>
                                    <p class="text-gray-500">Tidak ada dokumen pendukung untuk materi ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('user.materi.index') }}" class="button back-button">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    @auth
                    @if($userProgress < 100)
                    <button id="mark-completed" class="button completed-button">
                        <i class="fas fa-check-circle mr-2"></i> Sudah Paham!
                    </button>
                    @else
                    <div class="text-green-400 font-bold flex items-center text-xl bg-green-900 bg-opacity-30 px-4 py-2 rounded-xl">
                        <i class="fas fa-trophy mr-3 text-yellow-400 text-2xl"></i> Materi ini sudah kamu kuasai!
                    </div>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Success notification -->
            <div id="successNotification" class="success-notification">
                <span class="icon">🎉</span>
                <span class="message">HEBAT! Kamu telah menyelesaikan materi ini!<br><span class="text-sm font-normal">Lanjutkan ke materi berikutnya untuk terus belajar.</span></span>
            </div>

            <!-- Loading overlay -->
            <div id="loaderOverlay" class="loader-overlay">
                <div class="loader"></div>
                <div class="loader-text">Sedang menyimpan...</div>
            </div>
        </div>
    </div>

    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const materiId = {{ $materi->id }};
            const contentElement = document.getElementById('materi-content');
            const markCompletedButton = document.getElementById('mark-completed');
            const loaderOverlay = document.getElementById('loaderOverlay');

            // Extract and move document embeds to Dokumen Pendukung section
            const documentsContainer = document.getElementById('documents-container');
            const documentEmbeds = contentElement.querySelectorAll('.document-embed');
            const noDocumentsMessage = document.getElementById('no-documents-message');

            // Function to show/hide document section based on content
            function updateDocumentSection() {
                const documentsSection = documentsContainer.closest('.content-container');
                if (documentsSection) {
                    if (documentsContainer.children.length > 0 && !documentsContainer.querySelector('#no-documents-message')) {
                        documentsSection.style.display = 'block';
                        // If there are documents added dynamically, remove the no-documents message
                        if (noDocumentsMessage) {
                            noDocumentsMessage.remove();
                        }
                    } else if (documentsContainer.children.length === 1 && documentsContainer.querySelector('#no-documents-message')) {
                        // If only the no-documents message remains
                        documentsSection.style.display = 'none';
                    } else {
                        documentsSection.style.display = 'block';
                    }
                }
            }

            // Check if we already have server-rendered documents
            const hasServerDocuments = documentsContainer.querySelectorAll('.document-embed').length > 0;

            // Only extract from content if no server documents are available
            if (!hasServerDocuments && documentEmbeds.length > 0) {
                // Move all document embeds to the documents container
                documentEmbeds.forEach(embed => {
                    // Clone the embed before removing it from the original location
                    const embedClone = embed.cloneNode(true);

                    // Make sure all iframe elements have appropriate dimensions
                    const iframe = embedClone.querySelector('iframe');
                    if (iframe) {
                        iframe.setAttribute('width', '100%');
                        iframe.setAttribute('height', '500px');

                        // For Word/PowerPoint documents, use Google Docs Viewer
                        const embedClass = embedClone.className || '';
                        if (embedClass.includes('document-word') || embedClass.includes('document-powerpoint')) {
                            const downloadLink = embedClone.querySelector('.document-download');
                            if (downloadLink) {
                                const fileUrl = downloadLink.getAttribute('href');
                                if (fileUrl) {
                                    const fullUrl = window.location.protocol + '//' + window.location.host + fileUrl.replace(/^(?:\/\/|[^/]+)*\//, '/');
                                    const encodedUrl = encodeURIComponent(fullUrl);
                                    iframe.setAttribute('src', `https://docs.google.com/viewer?url=${encodedUrl}&embedded=true`);
                                }
                            }
                        }
                    }

                    // Update links to ensure they work
                    const links = embedClone.querySelectorAll('a');
                    links.forEach(link => {
                        if (link.classList.contains('document-download')) {
                            link.setAttribute('download', '');
                        }
                    });

                    documentsContainer.appendChild(embedClone);
                    embed.remove();
                });

                // Remove the no-documents message if we added documents
                if (noDocumentsMessage) {
                    noDocumentsMessage.remove();
                }

                updateDocumentSection();
            } else if (!hasServerDocuments) {
                // Check for any PDF links that might be embedded documents
                const pdfLinks = contentElement.querySelectorAll('a[href$=".pdf"], a[href$=".doc"], a[href$=".docx"], a[href$=".ppt"], a[href$=".pptx"]');
                if (pdfLinks.length > 0) {
                    pdfLinks.forEach(link => {
                        const href = link.getAttribute('href');
                        const text = link.textContent.trim();
                        const fileExt = href.split('.').pop().toLowerCase();
                        let docType = 'document';
                        let iconClass = 'fa-file';

                        if (fileExt === 'pdf') {
                            docType = 'pdf';
                            iconClass = 'fa-file-pdf';
                        } else if (fileExt === 'doc' || fileExt === 'docx') {
                            docType = 'word';
                            iconClass = 'fa-file-word';
                        } else if (fileExt === 'ppt' || fileExt === 'pptx') {
                            docType = 'powerpoint';
                            iconClass = 'fa-file-powerpoint';
                        }

                        // Create document embed
                        const docEmbed = document.createElement('div');
                        docEmbed.className = `document-embed document-${docType}`;
                        docEmbed.innerHTML = `
                            <div class="document-header">
                                <div class="document-title"><i class="fas ${iconClass} document-icon"></i> ${text || 'Document'}</div>
                                <div class="document-actions">
                                    <a href="${href}" target="_blank" class="document-button document-view"><i class="fas fa-eye"></i> Lihat</a>
                                    <a href="${href}" download class="document-button document-download"><i class="fas fa-download"></i> Unduh</a>
                                </div>
                            </div>
                        `;

                        documentsContainer.appendChild(docEmbed);
                    });

                    // Remove the no-documents message if we added documents
                    if (noDocumentsMessage) {
                        noDocumentsMessage.remove();
                    }

                    updateDocumentSection();
                } else {
                    // Keep the document section with the "no documents" message
                    updateDocumentSection();
                }
            } else {
                // Server-side documents exist, make sure section is visible
                const documentsSection = documentsContainer.closest('.content-container');
                if (documentsSection) {
                    documentsSection.style.display = 'block';
                }
            }

            // Update completion status
            function markAsCompleted() {
                // Show loader
                loaderOverlay.classList.add('show');

                fetch(`/user/materi/${materiId}/progress`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ progress: 100 })
                })
                .then(response => response.json())
                .then(data => {
                    // Hide loader
                    loaderOverlay.classList.remove('show');

                    // Show success notification
                        const notification = document.getElementById('successNotification');
                        notification.classList.add('show');

                    // Check if achievements were unlocked
                    if (data.has_achievements && data.achievements && data.achievements.length > 0) {
                        // Don't show achievements here, they will be shown on the index page
                        window.location.href = '{{ route('user.materi.index') }}';
                    } else {
                        // No achievements, redirect after notification as usual
                    setTimeout(() => {
                            window.location.href = '{{ route('user.materi.index') }}';
                        }, 2000);
                    }
                })
                .catch(error => {
                    // Hide loader even on error
                    loaderOverlay.classList.remove('show');
                    console.error('Error updating completion status:', error);
                });
            }

            // If we have the completed button, add click listener
            if (markCompletedButton) {
                // Mark as completed button
                markCompletedButton.addEventListener('click', function() {
                    markAsCompleted();
                });
            }
        });
    </script>
    @endauth

    {{-- @include('components.achievement-notification') --}}
</body>
</html>


