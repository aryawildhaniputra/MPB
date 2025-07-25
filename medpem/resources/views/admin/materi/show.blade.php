<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $materi->title }} - Materi Belajar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #151b2e;
            color: #ffffff;
            background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4d6.svg');
            background-size: 120px;
            background-position: top right;
            background-repeat: no-repeat;
            background-blend-mode: soft-light;
            background-opacity: 0.05;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 90px;
            padding-bottom: 2rem;
            min-height: calc(100vh - 70px);
            width: calc(100% - 250px);
            transition: all 0.3s ease;
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #4f46e5;
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
            background: #4f46e5;
            margin-bottom: 2rem;
            border-radius: 2px;
            margin-left: 0;
            margin-right: auto;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #2563EB;
            color: #FFFFFF;
            font-size: 0.9rem;
            padding: 5px 15px;
            border-radius: 6px;
            margin-left: 10px;
            font-weight: 600;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.3px;
        }

        .progress-container {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .progress-bar {
            height: 14px;
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
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 2rem;
            padding-top: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            color: #1e293b;
            position: relative;
            border: 2px solid #3B82F6;
            animation: slideUp 0.8s ease-out;
            animation-delay: 0.3s;
            animation-fill-mode: both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-container::before {
            content: '';
            display: none;
        }

        .content-icon {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2rem;
            background: linear-gradient(45deg, #3B82F6, #60A5FA);
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
            color: white;
        }

        .materi-content {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            line-height: 1.8;
            font-size: 1.1rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            max-height: 600px;
            overflow-y: auto;
            position: relative;
        }

        .materi-content::-webkit-scrollbar {
            width: 12px;
        }

        .materi-content::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .materi-content::-webkit-scrollbar-thumb {
            background: #3B82F6;
            border-radius: 10px;
            border: 3px solid #f1f5f9;
        }

        .materi-content::-webkit-scrollbar-thumb:hover {
            background: #2563EB;
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
            color: #1e40af;
        }

        .materi-content h1 { font-size: 1.8rem; }
        .materi-content h2 { font-size: 1.6rem; }
        .materi-content h3 { font-size: 1.4rem; }
        .materi-content h4 { font-size: 1.2rem; }

        .materi-content ul,
        .materi-content ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }

        .materi-content ul { list-style-type: disc; }
        .materi-content ol { list-style-type: decimal; }

        .materi-content a {
            color: #2563eb;
            text-decoration: underline;
        }

        .materi-content img {
            max-width: 100%;
            height: auto;
            margin: 1rem 0;
            border-radius: 8px;
        }

        .materi-content table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1rem;
        }

        .materi-content table th,
        .materi-content table td {
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
        }

        .materi-content table th {
            background-color: #f1f5f9;
            font-weight: bold;
        }

        .materi-content .youtube-embed,
        .materi-content .document-embed,
        .materi-content .presentation-embed {
            margin-bottom: 1.5rem;
        }

        .button {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
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
            background-color: #2563EB;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .completed-button:hover {
            background-color: #1D4ED8;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
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
            font-size: 1.5rem;
            margin-left: 8px;
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.3;
            font-size: 2.5rem;
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

        .reading-guide {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #3B82F6;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 100;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .reading-guide.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .progress-emoji {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        /* Success notification */
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            transition: all 0.5s ease;
            transform: translateX(100px);
        }

        .success-notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .success-notification .icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .success-notification .message {
            font-weight: bold;
            font-size: 1rem;
        }

        /* Info panel for teachers */
        .teacher-info-panel {
            background: rgba(37, 99, 235, 0.1);
            border: 1px solid #3B82F6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .teacher-info-panel h3 {
            font-size: 1.1rem;
            font-weight: bold;
            color: #3B82F6;
            margin-bottom: 10px;
        }

        .teacher-info-panel p {
            font-size: 0.9rem;
            color: #1e293b;
            line-height: 1.5;
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
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #3B82F6, transparent);
            border-radius: 2px;
        }

        .completion-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: white;
            padding: 6px 15px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .completion-badge i {
            margin-right: 8px;
        }

        /* Styles untuk tampilan dokumen yang diupload */
        .document-embed {
            margin: 15px 0;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .document-header {
            padding: 12px 18px;
            display: flex;
            align-items: center;
            background-color: #f8fafc;
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
            margin-right: 12px;
            font-size: 1.6rem;
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
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .document-view {
            background-color: #3b82f6;
            color: white;
        }

        .document-view:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        .document-download {
            background-color: #10b981;
            color: white;
        }

        .document-download:hover {
            background-color: #059669;
            transform: translateY(-2px);
        }

        .document-content {
            padding: 0;
            min-height: 400px;
        }

        .document-content iframe {
            width: 100%;
            height: 600px;
            border: none;
        }

        /* Media query for smaller screens */
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

            .progress-container {
                padding: 1rem;
            }

            .content-container {
                padding: 1.5rem;
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

            .progress-container {
                padding: 0.8rem;
            }

            .content-container {
                padding: 1rem;
            }

            .materi-content {
                padding: 1rem;
                font-size: 1rem;
                max-height: 400px;
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

            .document-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .document-actions {
                width: 100%;
            }

            .document-button {
                flex: 1;
                justify-content: center;
            }

            .document-content iframe {
                height: 350px;
            }
        }

        /* Button responsiveness */
        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn-responsive {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        .btn-responsive:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .button-container {
                flex-direction: column-reverse;
                gap: 0.75rem;
                align-items: stretch;
            }

            .btn-responsive {
                width: 100%;
                padding: 1rem;
                font-size: 1rem;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .button-container {
                gap: 0.5rem;
            }

            .btn-responsive {
                padding: 0.875rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <div class="text-center mb-8">
                <h1 class="content-title">{{ $materi->title }}</h1>
                <p class="subtitle">Detail materi pembelajaran</p>
                <div class="gradient-border"></div>
            </div>

            <div class="button-container mb-6">
                <a href="{{ route('admin.materi.edit', $materi->id) }}" class="btn-responsive bg-blue-500 hover:bg-blue-600 text-white">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                <a href="{{ route('admin.materi.index') }}" class="btn-responsive bg-gray-500 hover:bg-gray-600 text-white">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Deskripsi</h2>
                    <p class="text-gray-600">{{ $materi->description }}</p>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Konten</h2>
                    <div class="prose max-w-none">
                        {!! $materi->content !!}
                    </div>
                </div>

                @if($documents->count() > 0)
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Dokumen Pendukung</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($documents as $document)
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $document->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $document->file_name }}</p>
                                </div>
                            </div>
                            <a href="{{ route('document.serve', $document->id) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- <div class="button-container mt-8">
                    <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-responsive bg-red-500 hover:bg-red-600 text-white">
                            <i class="fas fa-trash mr-2"></i>Hapus Materi
                        </button>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>

</body>
</html>
