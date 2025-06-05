<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru - Media Pembelajaran</title>
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

            .form-card {
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

            .form-card {
                padding: 1rem;
            }

            .form-group {
                margin-bottom: 1.2rem;
            }

            .form-input {
                padding: 0.6rem;
                font-size: 0.8rem;
            }

            .btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
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

        .form-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2d3748;
        }

        @media (max-width: 768px) {
            .form-label {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .form-label {
                font-size: 0.85rem;
                margin-bottom: 0.3rem;
            }
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #2d3748;
            background-color: #f8fafc;
            transition: all 0.15s ease-in-out;
        }

        @media (max-width: 768px) {
            .form-input {
                padding: 0.65rem;
                font-size: 0.8rem;
            }
        }

        .form-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .form-error {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #e53e3e;
        }

        @media (max-width: 768px) {
            .form-error {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .form-error {
                font-size: 0.75rem;
            }
        }

        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            transition: all 0.15s ease-in-out;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .btn {
                padding: 0.65rem 1.3rem;
                font-size: 0.9rem;
            }
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-danger {
            background-color: #f56565;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #e53e3e;
        }
    </style>
</head>
<body>
    @include('header')

    <div class="flex">
        @include('sidebar')

        <div class="main-content p-4 md:p-6">
            <div class="container mx-auto max-w-3xl px-2 md:px-0">
                <h1 class="content-title">Tambah Pengguna</h1>
                <div class="subtitle">Buat akun pengguna baru</div>
                <div class="gradient-border"></div>

                <!-- Back button -->
                <div class="mb-4 md:mb-6">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center text-blue-400 hover:text-blue-600 transition text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar pengguna
                    </a>
                </div>

                <!-- Create user form -->
                <div class="form-card">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-input @error('name') border-red-500 @enderror"
                                   value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-input @error('username') border-red-500 @enderror"
                                   value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-input @error('password') border-red-500 @enderror"
                                   required autocomplete="new-password">
                            @error('password')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-input" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="role" class="form-label">Peran</label>
                            <select id="role" name="role" class="form-input @error('role') border-red-500 @enderror" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col md:flex-row justify-between gap-3 md:gap-0">
                            <button type="submit" class="btn btn-primary order-2 md:order-1">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger order-1 md:order-2">
                                <i class="fas fa-times mr-2"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
