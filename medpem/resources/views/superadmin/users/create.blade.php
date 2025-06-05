<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru | SuperAdmin</title>
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

        .role-description {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 0.5rem;
            border-left: 3px solid #ef4444;
        }

        .role-description.hidden {
            display: none;
        }

        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 4px;
            background: rgba(75, 85, 99, 0.3);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            width: 0%;
        }

        .strength-weak {
            background: #f87171;
            width: 25%;
        }

        .strength-fair {
            background: #fbbf24;
            width: 50%;
        }

        .strength-good {
            background: #34d399;
            width: 75%;
        }

        .strength-strong {
            background: #10b981;
            width: 100%;
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
                    <i class="fas fa-user-plus mr-3"></i>
                    Tambah User Baru
                </h1>
                <p class="text-gray-300">
                    Buat akun baru untuk admin atau siswa. Pastikan untuk memilih role yang tepat dan memberikan password yang kuat.
                </p>
            </div>

            <div class="form-container">
                <form action="{{ route('superadmin.users.store') }}" method="POST" id="createUserForm">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user mr-2"></i>Nama Lengkap
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
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
                                   value="{{ old('username') }}"
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
                            <select id="role"
                                    name="role"
                                    class="form-select @error('role') border-red-500 @enderror"
                                    required
                                    onchange="showRoleDescription(this.value)">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User/Siswa</option>
                            </select>
                            @error('role')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            <!-- Role Descriptions -->
                            <div id="admin-desc" class="role-description hidden">
                                <h4 class="font-semibold text-purple-300 mb-2">
                                    <i class="fas fa-user-shield mr-2"></i>Administrator
                                </h4>
                                <p class="text-sm text-gray-300">
                                    Admin dapat mengelola materi pembelajaran, melihat progress siswa, dan mengakses dashboard admin.
                                    Admin tidak dapat mengelola user lain atau mengakses fungsi superadmin.
                                </p>
                            </div>

                            <div id="user-desc" class="role-description hidden">
                                <h4 class="font-semibold text-green-300 mb-2">
                                    <i class="fas fa-graduation-cap mr-2"></i>User/Siswa
                                </h4>
                                <p class="text-sm text-gray-300">
                                    Siswa dapat mengakses materi pembelajaran, mengerjakan latihan, melihat progress pribadi,
                                    dan berpartisipasi dalam leaderboard.
                                </p>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock mr-2"></i>Password
                            </label>
                            <div class="relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-input @error('password') border-red-500 @enderror pr-12"
                                       placeholder="Minimum 8 karakter"
                                       required
                                       onkeyup="checkPasswordStrength(this.value)">
                                <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white"
                                        onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            <div class="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-fill" id="strength-fill"></div>
                                </div>
                                <div class="text-xs text-gray-400" id="strength-text">Password strength will appear here</div>
                            </div>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="form-group md:col-span-2">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                            </label>
                            <div class="relative">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-input @error('password_confirmation') border-red-500 @enderror pr-12"
                                       placeholder="Ulangi password"
                                       required>
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
                            <i class="fas fa-save mr-2"></i>Buat User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRoleDescription(role) {
            // Hide all descriptions
            document.getElementById('admin-desc').classList.add('hidden');
            document.getElementById('user-desc').classList.add('hidden');

            // Show selected role description
            if (role) {
                document.getElementById(role + '-desc').classList.remove('hidden');
            }
        }

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

        function checkPasswordStrength(password) {
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');

            let strength = 0;
            let message = '';

            // Length check
            if (password.length >= 8) strength += 1;

            // Lowercase check
            if (/[a-z]/.test(password)) strength += 1;

            // Uppercase check
            if (/[A-Z]/.test(password)) strength += 1;

            // Number check
            if (/\d/.test(password)) strength += 1;

            // Special character check
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            // Reset classes
            strengthFill.classList.remove('strength-weak', 'strength-fair', 'strength-good', 'strength-strong');

            switch (strength) {
                case 0:
                case 1:
                    strengthFill.classList.add('strength-weak');
                    message = 'Password sangat lemah';
                    break;
                case 2:
                    strengthFill.classList.add('strength-fair');
                    message = 'Password lemah';
                    break;
                case 3:
                case 4:
                    strengthFill.classList.add('strength-good');
                    message = 'Password cukup kuat';
                    break;
                case 5:
                    strengthFill.classList.add('strength-strong');
                    message = 'Password sangat kuat';
                    break;
            }

            strengthText.textContent = message;
        }

        // Form validation
        document.getElementById('createUserForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

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
        });

        // Show role description for old input on reload
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            if (roleSelect.value) {
                showRoleDescription(roleSelect.value);
            }
        });
    </script>
</body>
</html>
