<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | SuperAdmin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', 'Nunito', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            overflow-x: hidden;
        }

        .main-content {
            min-height: calc(100vh - 70px);
            margin-left: 250px;
            padding-top: 70px;
            padding-bottom: 2rem;
            transition: all 0.3s;
            width: calc(100% - 250px);
        }

        .content-header {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.8));
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.75rem;
            box-shadow: 0 20px 30px -15px rgba(2, 6, 23, 0.5);
            margin-bottom: 1.5rem;
        }

        .content-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, #dc2626, #ef4444);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #e2e8f0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .search-filter-section {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table-container {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th {
            background: rgba(15, 23, 42, 0.9);
            color: #ffffff;
            font-weight: 600;
            text-align: left;
            padding: 1rem;
            font-size: 0.875rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 0.875rem;
        }

        .user-table tr:hover td {
            background: rgba(15, 23, 42, 0.5);
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .role-superadmin {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        .role-admin {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
            color: white;
        }

        .role-user {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(5, 150, 105, 0.3);
        }

        .form-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            color: white;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-select {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            color: white;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-select option {
            background: #1e293b;
            color: white;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        /* Mobile responsiveness */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 80px;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .stats-grid {
                grid-template-columns: repeat(1, 1fr);
                gap: 0.75rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .search-filter-section {
                padding: 1rem;
            }

            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .user-table {
                min-width: 800px;
                font-size: 0.8rem;
            }

            .user-table th,
            .user-table td {
                padding: 0.75rem 0.5rem;
                white-space: nowrap;
            }

            .action-button {
                padding: 0.4rem 0.8rem;
                font-size: 0.7rem;
                margin-bottom: 0.25rem;
            }
        }

        @media (max-width: 640px) {
            .content-title {
                font-size: 1.5rem;
            }

            .user-table {
                min-width: 700px;
            }

            .action-button {
                padding: 0.35rem 0.6rem;
                font-size: 0.65rem;
            }
        }

        @media (max-width: 480px) {
            .content-title {
                font-size: 1.25rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .search-filter-section {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>
    @include('header')
    @include('components.duplicate-login-modal')
    <div class="flex">
        @include('sidebar')

        <div class="main-content px-4 md:px-6">
            <div class="content-header">
                <h1 class="content-title">
                    <i class="fas fa-users-cog mr-3"></i>
                    User Management
                </h1>
                <p class="text-gray-300">
                    Kelola semua pengguna sistem termasuk admin dan siswa. SuperAdmin memiliki kontrol penuh atas manajemen user.
                </p>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $userStats['total_users'] }}</div>
                    <div class="stat-label">Total Pengguna</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $userStats['total_admins'] }}</div>
                    <div class="stat-label">Administrator</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $userStats['total_students'] }}</div>
                    <div class="stat-label">Siswa</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $userStats['active_this_month'] }}</div>
                    <div class="stat-label">Aktif Bulan Ini</div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="search-filter-section">
                <form method="GET" action="{{ route('superadmin.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Cari Pengguna</label>
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Nama atau username..."
                               class="form-input w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                        <select name="role" class="form-select w-full">
                            <option value="all" {{ $role == 'all' ? 'selected' : '' }}>Semua Role</option>
                            <option value="superadmin" {{ $role == 'superadmin' ? 'selected' : '' }}>SuperAdmin</option>
                            <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $role == 'user' ? 'selected' : '' }}>User/Siswa</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select name="status" class="form-select w-full">
                            <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="action-button btn-primary mr-2">
                            <i class="fas fa-search mr-2"></i>Filter
                        </button>
                        <a href="{{ route('superadmin.users.index') }}" class="action-button btn-secondary">
                            <i class="fas fa-refresh"></i>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3 mb-6">
                <a href="{{ route('superadmin.users.create') }}" class="action-button btn-success">
                    <i class="fas fa-user-plus mr-2"></i>Tambah User Baru
                </a>
                <a href="{{ route('superadmin.users.export') }}" class="action-button btn-primary">
                    <i class="fas fa-file-export mr-2"></i>Export Data
                </a>
            </div>

            <!-- Users Table -->
            <div class="table-container">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th>Aktivitas Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-sm mr-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold">{{ $user->name }}</div>
                                        @if($user->role === 'superadmin')
                                        <div class="text-xs text-red-400">
                                            <i class="fas fa-crown mr-1"></i>Master Access
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    @if($user->role === 'superadmin')
                                        <i class="fas fa-crown mr-1"></i>SuperAdmin
                                    @elseif($user->role === 'admin')
                                        <i class="fas fa-user-shield mr-1"></i>Admin
                                    @else
                                        <i class="fas fa-user mr-1"></i>User
                                    @endif
                                </span>
                            </td>
                            <td>
                                @php
                                    $isActive = $user->last_activity && $user->last_activity >= \Carbon\Carbon::now()->subMonth();
                                @endphp
                                <span class="status-badge {{ $isActive ? 'status-active' : 'status-inactive' }}">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                @if($user->last_activity)
                                    {{ $user->last_activity->format('d M Y, H:i') }}
                                @else
                                    <span class="text-gray-500">Belum ada aktivitas</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-wrap gap-1">
                                    <a href="{{ route('superadmin.users.edit', $user) }}"
                                       class="action-button btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->role !== 'superadmin')
                                    <form action="{{ route('superadmin.users.delete', $user) }}"
                                          method="POST"
                                          style="display: inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-button btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span class="action-button" style="background: #64748b; cursor: not-allowed;">
                                        <i class="fas fa-shield-alt"></i>
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-8">
                                <div class="text-gray-400">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p>Tidak ada pengguna yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="pagination-container">
                {{ $users->links() }}
            </div>
            @endif

            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="fixed top-20 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="fixed top-20 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-hide notifications
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.fixed.top-20');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100px)';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>
</html>
