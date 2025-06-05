<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | SuperAdmin</title>
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

        .form-container {
            background: rgba(30, 41, 59, 0.7);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 30px -15px rgba(2, 6, 23, 0.5);
            backdrop-filter: blur(10px);
        }

        .user-info-card {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #e2e8f0;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
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
            width: 100%;
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

        .error-message {
            color: #f87171;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
        }

        .btn-secondary {
            background: rgba(75, 85, 99, 0.6);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            margin-right: 1rem;
        }

        .btn-secondary:hover {
            background: rgba(75, 85, 99, 0.8);
            transform: translateY(-2px);
        }

        .warning-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-box {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
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

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding-top: 80px;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .form-container {
                padding: 1.5rem;
            }

            .content-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .content-title {
                font-size: 1.25rem;
            }

            .form-container {
                padding: 1rem;
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
                    <i class="fas fa-user-edit mr-3"></i>
                    Edit User
                </h1>
                <p class="text-gray-300">
                    Ubah informasi pengguna. Hati-hati saat mengubah role karena akan mempengaruhi akses pengguna ke sistem.
                </p>
            </div>

            <div class="form-container">
                <!-- User Info Card -->
                <div class="user-info-card">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-white">Informasi User Saat Ini</h3>
                        <span class="role-badge role-{{ $user->role }}">
                            @if($user->role === 'superadmin')
                                <i class="fas fa-crown mr-1"></i>SuperAdmin
                            @elseif($user->role === 'admin')
                                <i class="fas fa-user-shield mr-1"></i>Admin
                            @else
                                <i class="fas fa-user mr-1"></i>User
                            @endif
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <div class="text-gray-400">ID</div>
                            <div class="font-semibold">#{{ $user->id }}</div>
                        </div>
                        <div>
                            <div class="text-gray-400">Bergabung</div>
                            <div class="font-semibold">{{ $user->created_at->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div class="text-gray-400">Login Terakhir</div>
                            <div class="font-semibold">
                                @if($user->last_activity)
                                    {{ $user->last_activity->format('d M Y, H:i') }}
                                @else
                                    Belum pernah login
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($user->role === 'superadmin')
                <div class="warning-box">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-red-300">Peringatan SuperAdmin</h4>
                            <p class="text-sm text-red-200">
                                Anda sedang mengedit akun SuperAdmin. Perubahan pada akun ini dapat mempengaruhi keamanan sistem secara keseluruhan.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('superadmin.users.update', $user) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user mr-2"></i>Nama Lengkap
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="form-input @error('name') border-red-500 @enderror"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username Field -->
                        <div class="form-group">
                            <label for="username" class="form-label">
                                <i class="fas fa-at mr-2"></i>Username
                            </label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ old('username', $user->username) }}"
                                   class="form-input @error('username') border-red-500 @enderror"
                                   placeholder="username123"
                                   required>
                            @error('username')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Field -->
                        <div class="form-group">
                            <label for="role" class="form-label">
                                <i class="fas fa-user-tag mr-2"></i>Role Pengguna
                            </label>
                            @if($user->role === 'superadmin')
                                <input type="hidden" name="role" value="superadmin">
                                <div class="form-input bg-gray-700 cursor-not-allowed">
                                    <i class="fas fa-crown mr-2"></i>SuperAdmin (Tidak dapat diubah)
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    Role SuperAdmin tidak dapat diubah untuk keamanan sistem
                                </div>
                            @else
                                <select id="role"
                                        name="role"
                                        class="form-select @error('role') border-red-500 @enderror"
                                        required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User/Siswa</option>
                                </select>
                                @error('role')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror

                                @if($user->role !== old('role', $user->role))
                                <div class="info-box mt-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                                        <div>
                                            <h4 class="font-semibold text-blue-300">Perubahan Role</h4>
                                            <p class="text-sm text-blue-200">
                                                Mengubah role akan mempengaruhi hak akses pengguna ke sistem. Pastikan Anda memahami konsekuensinya.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock mr-2"></i>Password Baru (Opsional)
                            </label>
                            <div class="relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-input @error('password') border-red-500 @enderror pr-12"
                                       placeholder="Kosongkan jika tidak ingin mengubah">
                                <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white"
                                        onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <div class="text-xs text-gray-400 mt-1">
                                Kosongkan jika tidak ingin mengubah password
                            </div>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="form-group md:col-span-2">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock mr-2"></i>Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-input @error('password_confirmation') border-red-500 @enderror pr-12"
                                       placeholder="Ulangi password baru">
                                <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white"
                                        onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end mt-8">
                        <a href="{{ route('superadmin.users.index') }}" class="btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eye = document.getElementById(fieldId + '-eye');

            if (field.type === 'password') {
                field.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }

        // Form validation
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            // Only validate password if it's being changed
            if (password || confirmPassword) {
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak sama!');
                    return false;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password harus minimal 8 karakter!');
                    return false;
                }
            }
        });

        // Confirm role change for critical roles
        document.getElementById('role')?.addEventListener('change', function() {
            const currentRole = '{{ $user->role }}';
            const newRole = this.value;

            if (currentRole === 'admin' && newRole === 'user') {
                if (!confirm('Anda akan mengubah admin menjadi user biasa. Apakah Anda yakin?')) {
                    this.value = currentRole;
                    return false;
                }
            }

            if (currentRole === 'user' && newRole === 'admin') {
                if (!confirm('Anda akan memberikan akses admin kepada user ini. Apakah Anda yakin?')) {
                    this.value = currentRole;
                    return false;
                }
            }
        });
    </script>
</body>
</html>
