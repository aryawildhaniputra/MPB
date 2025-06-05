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

        /* Header styling - simplified and consistent */
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

        /* Mobile styling */
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

            .content-container {
                padding: 1.5rem !important;
            }

            .materi-content {
                font-size: 1rem !important;
                padding: 1rem !important;
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

            .content-container {
                padding: 1rem !important;
            }

            .materi-content {
                padding: 0.8rem !important;
                font-size: 0.9rem !important;
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
        }

        /* Button responsiveness */
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-responsive:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .button-container {
                flex-direction: column;
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

        .btn-back {
            background-color: #6B7280;
            color: white;
        }

        .btn-back:hover {
            background-color: #4B5563;
        }

        .btn-complete {
            background-color: #10B981;
            color: white;
        }

        .btn-complete:hover {
            background-color: #059669;
        }

        .btn-completed {
            background-color: #34D399;
            color: white;
            cursor: default;
        }

        /* Simplified progress container */
        .progress-container {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        @media (max-width: 768px) {
            .progress-container {
                padding: 1rem;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .progress-container {
                padding: 0.8rem;
                margin-bottom: 1rem;
            }
        }

        /* Simplified content container */
        .content-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            color: #1e293b;
            position: relative;
            border: 2px solid #4f46e5;
        }

        .materi-content {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            line-height: 1.8;
            font-size: 1.1rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .materi-content::-webkit-scrollbar {
            width: 12px;
        }

        .materi-content::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .materi-content::-webkit-scrollbar-thumb {
            background: #4f46e5;
            border-radius: 10px;
            border: 3px solid #f1f5f9;
        }

        .materi-content::-webkit-scrollbar-thumb:hover {
            background: #3730a3;
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
            color: #4f46e5;
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
            color: #4f46e5;
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

        /* Success notification */
        .success-notification {
            position: fixed;
            top: 70px;
            left: 50%;
            transform: translateX(-50%) translateY(-100%);
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            z-index: 999;
            opacity: 0;
            transition: all 0.5s ease;
            width: 90%;
            max-width: 500px;
        }

        .success-notification.show {
            transform: translateX(-50%) translateY(10px);
            opacity: 1;
        }

        @media (max-width: 640px) {
            .success-notification {
                width: 95%;
                padding: 12px 15px;
            }

            .success-notification .icon {
                font-size: 1.25rem;
                margin-right: 10px;
            }

            .success-notification .message {
                font-size: 0.9rem;
            }
        }

        .success-notification .icon {
            font-size: 2rem;
            margin-right: 15px;
        }

        .success-notification .message {
            font-weight: bold;
            font-size: 1.1rem;
            line-height: 1.4;
        }

        /* Completion badge */
        .completion-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .completion-badge i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .completion-badge {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .completion-badge {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
            }
        }

        /* Loader overlay */
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

        /* Document embed styles */
        .document-embed {
            margin: 15px 0;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .document-header {
            padding: 12px 18px;
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
            margin-right: 12px;
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

        @media (max-width: 768px) {
            .document-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                padding: 10px 15px;
            }

            .document-actions {
                width: 100%;
            }

            .document-button {
                flex: 1;
                justify-content: center;
                padding: 6px 12px;
                font-size: 0.8rem;
            }

            .document-content iframe {
                height: 350px;
            }
        }

        @media (max-width: 480px) {
            .document-header {
                padding: 8px 12px;
            }

            .document-button {
                padding: 5px 10px;
                font-size: 0.75rem;
            }

            .document-content iframe {
                height: 300px;
            }
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
            background: linear-gradient(90deg, #4f46e5, transparent);
            border-radius: 2px;
        }
    </style>
</head>
<body>
    @include('header')

    <!-- Success notification -->
    <div id="successNotification" class="success-notification">
        <span class="icon">🎉</span>
        <span class="message">HEBAT! Kamu telah menyelesaikan materi ini!<br><span class="text-sm font-normal">Lanjutkan ke materi berikutnya untuk terus belajar.</span></span>
    </div>

    <div class="flex">
        @include('sidebar')

        <div class="main-content px-6">
            <div class="max-w-5xl mx-auto">
                <!-- Simplified Header -->
                <div class="text-center mb-8">
                    <h1 class="content-title">{{ $materi->title }}</h1>
                    <p class="subtitle">Belajar dengan menyenangkan</p>
                    <div class="gradient-border"></div>
                </div>

                @auth
                @if($userProgress >= 100)
                <div class="completion-badge">
                    <i class="fas fa-check-circle"></i> Materi Sudah Dipahami
                </div>
                @endif
                @endauth

                <div class="content-container">
                    <div class="mt-6">
                        <h2 class="text-2xl font-bold text-indigo-800 mb-4 section-header">Penjelasan Singkat</h2>
                        <p class="text-gray-700 mb-6 text-lg">{{ $materi->description }}</p>

                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <p class="text-blue-800 mb-0">💡 <strong>Tips:</strong> Bacalah dengan teliti dan pelan-pelan. Kamu juga bisa minta bantuan guru atau orang tua jika ada yang tidak kamu mengerti. Selamat belajar, Sobat Pintar! 😊</p>
                        </div>

                        <h2 class="text-2xl font-bold text-indigo-800 mb-4 mt-8 section-header">Materinya</h2>
                        <div id="materi-content" class="materi-content">
                            {!! $materi->content !!}
                        </div>
                    </div>
                </div>

                <div class="content-container">
                    <div class="mt-6">
                        <h2 class="text-2xl font-bold text-indigo-800 mb-4 section-header">Dokumen Pendukung</h2>
                        <p class="text-gray-700 mb-4 text-lg">Dokumen dan file pendukung untuk membantu pembelajaran kamu.</p>

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

                <!-- Responsive Button Container -->
                <div class="button-container">
                    <a href="{{ route('user.materi.index') }}" class="btn-responsive btn-back">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    @auth
                    @if($userProgress < 100)
                    <button id="mark-completed" class="btn-responsive btn-complete">
                        <i class="fas fa-check-circle mr-2"></i> Sudah Paham!
                    </button>
                    @else
                    <div class="btn-responsive btn-completed">
                        <i class="fas fa-trophy mr-2 text-yellow-400"></i> Materi ini sudah kamu kuasai!
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Loading overlay -->
    <div id="loaderOverlay" class="loader-overlay">
        <div class="loader"></div>
        <div class="loader-text">Sedang menyimpan...</div>
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


