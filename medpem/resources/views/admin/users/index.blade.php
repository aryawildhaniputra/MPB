<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Media Pembelajaran</title>
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
            z-index: 1;
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 160px;
            }
        }

        .content-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1rem;
            background: #1EC38B;
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

        .user-table {
            background-color: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin-top: 1.5rem;
            width: 100%;
        }

        .table-header {
            background-color: #1e293b;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }

        .table-header th {
            padding: 1rem;
            text-align: left;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table-cell {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .role-badge.superadmin {
            background-color: #f0e7ff;
            color: #7e22ce;
        }

        .role-badge.admin {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .role-badge.user {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            margin: 0 0.15rem;
        }

        .action-button.view {
            color: #6366f1;
            background-color: #eef2ff;
        }

        .action-button.view:hover {
            background-color: #6366f1;
            color: white;
        }

        .action-button.edit {
            color: #2563eb;
            background-color: #dbeafe;
        }

        .action-button.edit:hover {
            background-color: #2563eb;
            color: white;
        }

        .action-button.delete {
            color: #dc2626;
            background-color: #fee2e2;
            border: none;
        }

        .action-button.delete:hover {
            background-color: #dc2626;
            color: white;
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            background-color: #4f46e5;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
        }

        .add-button:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(79, 70, 229, 0.3);
        }

        .pagination-wrapper {
            display: inline-flex;
            overflow: hidden;
        }

        .pagination-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .pagination-button.active {
            color: #4f46e5;
            cursor: pointer;
        }

        .pagination-button.active:hover {
            background-color: #f5f3ff;
        }

        .pagination-button.disabled {
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .modal-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            border-radius: 1rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
            overflow: hidden;
        }

        .modal-backdrop.active .modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .modal-header {
            padding: 1.25rem;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }

        .modal-icon {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fee2e2;
            color: #dc2626;
            border-radius: 50%;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .modal-body {
            padding: 1.5rem;
            color: #1e293b;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .modal-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .modal-button.cancel {
            background-color: #e2e8f0;
            color: #475569;
        }

        .modal-button.cancel:hover {
            background-color: #cbd5e1;
        }

        .modal-button.confirm {
            background-color: #dc2626;
            color: white;
        }

        .modal-button.confirm:hover {
            background-color: #b91c1c;
        }

        .action-cell {
            min-width: 8.5rem; /* Set minimum width for action column */
            text-align: right;
        }

        .action-buttons-container {
            display: inline-flex;
            align-items: center;
            justify-content: flex-end;
        }

        .number-cell {
            font-weight: 600;
            text-align: center;
            color: #475569;
            width: 5%;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-6">
            <div class="container mx-auto">
                <h1 class="content-title">Manajemen Pengguna</h1>
                <div class="gradient-border"></div>

                <!-- Alert for success/error messages -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-6 shadow">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    </div>
                @endif

                <!-- Control buttons -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Daftar Pengguna</h2>
                    <a href="{{ route('admin.users.create') }}" class="add-button">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Pengguna
                    </a>
                </div>

                <!-- Users table -->
                <div class="user-table">
                    <table class="min-w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="px-4 py-4 text-center" style="width: 5%">No</th>
                                <th class="px-6 py-4" style="width: 18%">Nama</th>
                                <th class="px-6 py-4" style="width: 18%">Username</th>
                                <th class="px-6 py-4" style="width: 14%">Peran</th>
                                <th class="px-6 py-4" style="width: 14%">Total Poin</th>
                                <th class="px-6 py-4" style="width: 14%">Tgl Dibuat</th>
                                <th class="px-6 py-4 text-right action-cell" style="width: 17%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr class="table-row">
                                <td class="table-cell number-cell">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="table-cell font-medium">
                                    {{ $user->name }}
                                </td>
                                <td class="table-cell">
                                    {{ $user->username }}
                                </td>
                                <td class="table-cell">
                                    <span class="role-badge {{ $user->role }}">
                                        <i class="fas {{ $user->role === 'superadmin' ? 'fa-crown' : ($user->role === 'admin' ? 'fa-user-shield' : 'fa-user') }} mr-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="table-cell">
                                    <span class="flex items-center">
                                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                                        {{ $user->total_points ?? 0 }}
                                    </span>
                                </td>
                                <td class="table-cell">
                                    <span class="flex items-center">
                                        <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                                        {{ $user->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="table-cell text-right action-cell">
                                    <div class="action-buttons-container">
                                        <!-- View button -->
                                        {{-- <a href="{{ route('admin.users.show', $user->id) }}" class="action-button view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}

                                        <!-- Edit button -->
                                        @if(Auth::user()->role === 'superadmin' || (Auth::user()->role === 'admin' && $user->role === 'user'))
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="action-button edit" title="Edit Pengguna">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif

                                        <!-- Delete button -->
                                        @if((Auth::user()->role === 'superadmin' || (Auth::user()->role === 'admin' && $user->role === 'user')) && Auth::user()->id !== $user->id)
                                        <button type="button" class="action-button delete"
                                                title="Hapus Pengguna"
                                                onclick="showDeleteModal('{{ $user->name }}', {{ $user->id }})"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination links -->
                <div class="mt-6 flex justify-center">
                    <div class="pagination-wrapper bg-white rounded-lg shadow-md">
                        <div class="flex items-center px-4 py-3 border-t border-gray-200">
                            @if ($users->onFirstPage())
                                <span class="pagination-button disabled">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" class="pagination-button active">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </a>
                            @endif

                            <div class="px-4 text-gray-700">
                                <span class="font-medium">{{ $users->firstItem() ?? 0 }}</span> -
                                <span class="font-medium">{{ $users->lastItem() ?? 0 }}</span> dari
                                <span class="font-medium">{{ $users->total() }}</span> pengguna
                            </div>

                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" class="pagination-button active">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </a>
                            @else
                                <span class="pagination-button disabled">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-backdrop">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Konfirmasi Hapus Pengguna</h3>
                    <p class="text-sm text-gray-600">Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>
            <div class="modal-body">
                <p class="text-gray-800">Apakah Anda yakin ingin menghapus pengguna <span id="userName" class="font-semibold"></span>?</p>
                <p class="text-gray-600 text-sm mt-2">Semua data terkait pengguna ini akan dihapus secara permanen.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-button cancel" onclick="hideDeleteModal()">
                    Batal
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-button confirm">
                        <i class="fas fa-trash mr-1"></i> Hapus Pengguna
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(name, id) {
            // Set the user name in the modal
            document.getElementById('userName').textContent = name;

            // Set the form action to the correct route
            document.getElementById('deleteForm').action = "{{ url('admin/users') }}/" + id;

            // Show the modal
            document.getElementById('deleteModal').classList.add('active');

            // Prevent body scrolling
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            // Hide the modal
            document.getElementById('deleteModal').classList.remove('active');

            // Allow body scrolling again
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the modal content
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteModal').classList.contains('active')) {
                hideDeleteModal();
            }
        });
    </script>
</body>
</html>
