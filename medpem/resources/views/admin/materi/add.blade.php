<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi Baru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- TinyMCE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.3/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            background-color: #151b2e;
            color: #ffffff;
            /* background-image: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f31f.svg'),
                            url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4dd.svg'); */
            background-size: 80px, 120px;
            background-position: top left, bottom right;
            background-repeat: repeat, no-repeat;
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

            .form-container {
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

            .form-container {
                padding: 1rem;
            }

            .input-group {
                margin-bottom: 1.2rem;
            }

            .form-input, .form-textarea {
                padding: 0.6rem;
                font-size: 0.9rem;
            }

            .action-button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
                width: 100%;
                margin-bottom: 0.5rem;
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

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            color: #1e293b;
            position: relative;
            animation: fadeIn 0.8s ease-out;
            border: 2px solid rgba(103, 232, 249, 0.5);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-label {
            display: block;
            color: #4B5563;
            font-weight: bold;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            position: relative;
            padding-left: 30px;
        }

        .input-label::before {
            content: attr(data-icon);
            position: absolute;
            left: 0;
            top: -2px;
            font-size: 1.4rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            background-color: #F9FAFB;
            transition: all 0.3s ease;
            font-size: 1rem;
            color: #1F2937;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-input:focus {
            border-color: #60A5FA;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.3);
            outline: none;
            transform: translateY(-2px);
        }

        .form-textarea {
            width: 100%;
            min-height: 120px;
            padding: 0.75rem 1rem;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            resize: vertical;
            background-color: #F9FAFB;
            transition: all 0.3s ease;
            font-size: 1rem;
            color: #1F2937;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-textarea:focus {
            border-color: #60A5FA;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.3);
            outline: none;
            transform: translateY(-2px);
        }

        .content-textarea {
            font-family: 'Consolas', monospace;
            min-height: 350px;
            line-height: 1.6;
        }

        .action-button {
            border-radius: 30px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .upload-button {
            background: linear-gradient(to right, #3B82F6, #60A5FA);
            color: white;
        }

        .upload-button:hover {
            background: linear-gradient(to right, #2563EB, #3B82F6);
        }

        .paste-button {
            background: linear-gradient(to right, #10B981, #34D399);
            color: white;
        }

        .paste-button:hover {
            background: linear-gradient(to right, #059669, #10B981);
        }

        .submit-button {
            background: linear-gradient(to right, #58CC02, #4CAF50);
            color: white;
            padding: 0.875rem 2rem;
            font-size: 1.1rem;
        }

        .submit-button:hover {
            background: linear-gradient(to right, #4CAF50, #3E8E41);
        }

        .button-icon {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .file-message {
            display: none;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            background-color: #F0F9FF;
            border: 1px solid #BAE6FD;
            color: #0369A1;
        }

        .file-message.shown {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        .content-helper {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .helper-button {
            padding: 0.5rem 1rem;
            background-color: #EFF6FF;
            border: 1px solid #DBEAFE;
            border-radius: 20px;
            font-size: 0.875rem;
            color: #2563EB;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .helper-button:hover {
            background-color: #DBEAFE;
            transform: translateY(-2px);
        }

        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.6;
            font-size: 3rem;
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

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .form-section {
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            position: relative;
        }

        .form-section-title {
            position: absolute;
            top: -15px;
            left: 20px;
            background-color: #93c5fd;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.875rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .help-text {
            font-size: 0.875rem;
            color: #6B7280;
            margin-top: 0.5rem;
        }

        /* TinyMCE customizations */
        .tox-tinymce {
            border-radius: 10px !important;
            overflow: hidden !important;
            border: 2px solid #E5E7EB !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
        }

        .tox .tox-statusbar {
            border-top: 1px solid #E5E7EB !important;
        }

        .tox .tox-toolbar, .tox .tox-toolbar__overflow, .tox .tox-toolbar__primary {
            border-bottom: 1px solid #E5E7EB !important;
            background: #F9FAFB !important;
        }

        .media-preview {
            margin-top: 1rem;
            padding: 1rem;
            border: 1px dashed #60A5FA;
            border-radius: 10px;
            background-color: #F0F9FF;
            display: none;
        }

        .media-preview.shown {
            display: block;
        }

        .media-preview-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #2563EB;
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
        @media (max-width: 640px) {
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

        .modal-open .duolingo-header {
            pointer-events: none !important;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <div class="text-center mb-8">
                <h1 class="content-title">Tambah Materi Baru</h1>
                <p class="subtitle">Buat materi pembelajaran baru</p>
                <div class="gradient-border"></div>
            </div>

            <div class="button-container mb-6">
                <a href="{{ route('admin.materi.index') }}" class="btn-responsive bg-gray-500 hover:bg-gray-600 text-white">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

            @include('components.notification')

            <form action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg p-6 shadow-lg">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Materi</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Konten</label>
                    <textarea name="content" id="content" rows="10"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Dokumen Pendukung</label>
                    <div id="document-upload-container">
                        <div class="document-upload-row mb-4">
                            <div class="flex items-center space-x-4">
                                <input type="text" name="document_titles[]" placeholder="Judul Dokumen"
                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline flex-1 @error('document_titles.*') border-red-500 @enderror">
                                <input type="file" name="documents[]" accept=".pdf"
                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline flex-1 @error('documents.*') border-red-500 @enderror">
                            </div>
                            @error('document_titles.*')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                            @error('documents.*')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="button" id="add-document" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fas fa-plus mr-2"></i>Tambah Dokumen
                    </button>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn-responsive bg-green-500 hover:bg-green-700 text-white">
                        <i class="fas fa-save mr-2"></i>Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden" style="z-index: 10000;">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-green-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2" id="successTitle">Berhasil!</h3>
                <p class="text-gray-600 mb-6" id="successMessage">Operasi berhasil dilakukan.</p>
                <button type="button" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors" onclick="closeModal('successModal')">
                    OK
                </button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden" style="z-index: 10000;">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-times text-red-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Gagal!</h3>
                <p class="text-gray-600 mb-6" id="errorMessage">Terjadi kesalahan saat melakukan operasi.</p>
                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors" onclick="closeModal('errorModal')">
                    OK
                </button>
            </div>
        </div>
    </div>

    <!-- Unsaved Changes Modal -->
    <div id="unsavedChangesModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden" style="z-index: 10000;">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-3">Perubahan Belum Disimpan</h3>
                <p class="text-gray-600 mb-6">Anda memiliki perubahan yang belum disimpan. Apakah Anda ingin tetap meninggalkan halaman ini?</p>
                <div class="flex justify-center space-x-4">
                    <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors" id="stayButton">
                        Tetap di Halaman Ini
                    </button>
                    <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors" id="leaveButton">
                        Tinggalkan Halaman
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount emoticons directionality template',
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | image media link file template emoticons | help',
            height: 500,
            menubar: true,
            branding: false,
            promotion: false,
            image_advtab: true,
            automatic_uploads: true,
            templates: [
                {
                    title: 'Dokumen PDF',
                    description: 'Template untuk dokumen PDF',
                    content: '<div class="document-embed document-pdf">' +
                            '<div class="document-header">' +
                                '<div class="document-title"><i class="fas fa-file-pdf document-icon"></i> Dokumen PDF</div>' +
                                '<div class="document-actions">' +
                                    '<a href="#" target="_blank" class="document-button document-view"><i class="fas fa-eye"></i> Lihat</a>' +
                                    '<a href="#" class="document-button document-download"><i class="fas fa-download"></i> Unduh</a>' +
                                '</div>' +
                            '</div>' +
                            '<div class="document-content">' +
                                '<iframe src="#" frameborder="0"></iframe>' +
                            '</div>' +
                        '</div>'
                }
            ],
            file_picker_callback: function (callback, value, meta) {
                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    // Create file input and set configuration
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', '.pdf');

                    input.onchange = function() {
                        const file = this.files[0];

                        // Create form data for upload
                        const formData = new FormData();
                        formData.append('file', file);
                        formData.append('_token', '{{ csrf_token() }}');

                        // Upload file to server
                        fetch('{{ route('document.upload') }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.location) {
                                // Determine document type and create appropriate embed
                                const fileExt = data.name.split('.').pop().toLowerCase();

                                if (fileExt === 'pdf') {
                                    // Create PDF template
                                    const embedCode = `<div class="document-embed document-pdf">
                                        <div class="document-header">
                                            <div class="document-title"><i class="fas fa-file-pdf document-icon"></i> ${data.name}</div>
                                            <div class="document-actions">
                                                <a href="${data.location}" target="_blank" class="document-button document-view"><i class="fas fa-eye"></i> Lihat</a>
                                                <a href="${data.location}" download class="document-button document-download"><i class="fas fa-download"></i> Unduh</a>
                                            </div>
                                        </div>
                                        <div class="document-content">
                                            <iframe src="${data.location}" frameborder="0" width="100%" height="500px"></iframe>
                                        </div>
                                    </div>`;

                                    // Insert document at cursor position or at end of editor
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, embedCode);

                                    // Show success message
                                    alert(`Dokumen ${data.name} berhasil diupload dan ditambahkan ke materi.`);
                                } else {
                                    alert('Jenis file tidak didukung. Silakan upload file PDF.');
                                }
                            } else {
                                console.error('Upload error:', data.error);
                                alert('Gagal mengupload file: ' + (data.error || 'Terjadi kesalahan'));
                            }
                        })
                        .catch(error => {
                            console.error('Upload error:', error);
                            alert('Gagal mengupload file: Terjadi kesalahan');
                        });
                    };

                    input.click();
                }

                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.onchange = function () {
                        const file = this.files[0];

                const reader = new FileReader();
                        reader.onload = function () {
                            callback(reader.result, {
                                alt: file.name
                            });
                };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                }

                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'image.jpg'
                    });
                }
            },
            setup: function(editor) {
                let editorInitialized = false;
                editor.on('init', function() {
                    setTimeout(function() {
                        editorInitialized = true;
                    }, 500);
                });
                editor.on('change', function() {
                    editor.save();
                    if (editorInitialized) {
                        formChanged = true;
                    }
                });
            },
            content_style: 'body { font-family: Nunito, sans-serif; font-size: 16px; }',
            extended_valid_elements: 'a[href|target=_blank|rel=noopener|class|style]',
            convert_urls: false,
        });

        // Form change tracking variables
        let formChanged = false;
        const form = document.querySelector('form');

        // Modal functions
        function showModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).offsetHeight;
            document.body.classList.add('modal-open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function showSuccessModal(title, message) {
            document.getElementById('successTitle').textContent = title;
            document.getElementById('successMessage').textContent = message;
            showModal('successModal');
        }

        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            showModal('errorModal');
        }

        function showUnsavedChangesModal(callbackStay, callbackLeave) {
            document.getElementById('stayButton').onclick = function() {
                closeModal('unsavedChangesModal');
                if (typeof callbackStay === 'function') {
                    callbackStay();
                }
            };
            document.getElementById('leaveButton').onclick = function() {
                closeModal('unsavedChangesModal');
                formChanged = false; // Reset to prevent further prompts
                if (typeof callbackLeave === 'function') {
                    callbackLeave();
                }
            };
            showModal('unsavedChangesModal');
        }

        // Track form changes
        document.addEventListener('DOMContentLoaded', function() {
            // Explicitly set formChanged to false when the page loads
            formChanged = false;

            // Track changes in form inputs
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(function(input) {
                // For text inputs and textareas, use input event for immediate tracking
                if (input.type === 'text' || input.type === 'textarea') {
                    input.addEventListener('input', function() {
                        // Only mark as changed if the input has a value
                        if (this.value.trim() !== '') {
                            formChanged = true;
                        }
                    });
            } else {
                    // For other inputs (checkboxes, radios, select), use change event
                    input.addEventListener('change', function() {
                        // For file inputs, only mark as changed if a file is selected
                        if (this.type === 'file') {
                            if (this.files && this.files.length > 0) {
                                formChanged = true;
                            }
                        } else {
                            formChanged = true;
                        }
                    });
            }
        });

            // Check for unsaved changes when clicking on links
            document.querySelectorAll('a:not([target="_blank"])').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    if (formChanged) {
                        // Immediately prevent default navigation and show modal first
                        e.preventDefault();
                        const href = this.getAttribute('href');

                        // Show the modal immediately, then handle navigation after user decision
                        document.getElementById('unsavedChangesModal').classList.remove('hidden');

                        // Setup handlers after modal is shown
                        document.getElementById('stayButton').onclick = function() {
                            document.getElementById('unsavedChangesModal').classList.add('hidden');
                        };

                        document.getElementById('leaveButton').onclick = function() {
                            document.getElementById('unsavedChangesModal').classList.add('hidden');
                            formChanged = false; // Reset to prevent further prompts
                            // Navigate only after user clicks the leave button
                            window.location.href = href;
                        };
                    }
                });
            });

            // Reset form changed flag when form is submitted
            if (form) {
                form.addEventListener('submit', function() {
                    formChanged = false;
                });
            }

            // Info modal functionality
            const showUploadInfoBtn = document.getElementById('showUploadInfoBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const uploadInfoModal = document.getElementById('uploadInfoModal');

            if (showUploadInfoBtn && uploadInfoModal) {
                showUploadInfoBtn.addEventListener('click', function() {
                    uploadInfoModal.classList.remove('hidden');
                });
            }

            if (closeModalBtn && uploadInfoModal) {
                closeModalBtn.addEventListener('click', function() {
                    uploadInfoModal.classList.add('hidden');
                });

                // Close modal when clicking outside the content
                uploadInfoModal.addEventListener('click', function(e) {
                    if (e.target === uploadInfoModal) {
                        uploadInfoModal.classList.add('hidden');
                    }
                });
                }

            // Add more document upload fields
            const addMoreDocBtn = document.getElementById('addMoreDocBtn');
            const documentUploadsContainer = document.getElementById('document-uploads');

            if (addMoreDocBtn && documentUploadsContainer) {
                addMoreDocBtn.addEventListener('click', function() {
                    const newDocItem = document.createElement('div');
                    newDocItem.className = 'document-upload-item bg-gray-50 p-4 rounded-lg border-2 border-gray-200 mt-4';
                    newDocItem.innerHTML = `
                        <div class="flex items-center mb-2 justify-between">
                            <div class="flex-1 flex">
                                <select class="form-input mr-2" style="width: 150px;" name="document_types[]">
                                    <option value="pdf">PDF</option>
                                </select>
                                <input type="file" name="documents[]" class="form-input flex-1" accept=".pdf">
                            </div>
                            <button type="button" class="remove-doc-btn text-red-500 hover:text-red-700 ml-2">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                        <input type="text" name="document_titles[]" class="form-input w-full mt-2" placeholder="Judul Dokumen (opsional)">
                    `;

                    documentUploadsContainer.appendChild(newDocItem);

                    // Add event listener to the remove button
                    const removeBtn = newDocItem.querySelector('.remove-doc-btn');
                    if (removeBtn) {
                        removeBtn.addEventListener('click', function() {
                            newDocItem.remove();
                        });
                    }

                    // Mark form as changed when adding a new document field
                    formChanged = true;
            });
            }
        });
    </script>
</body>
</html>
