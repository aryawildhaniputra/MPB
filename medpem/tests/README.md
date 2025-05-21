# Panduan Pengujian

Dokumen ini berisi panduan untuk menjalankan pengujian otomatis pada aplikasi.

## Struktur Pengujian

Pengujian dibagi menjadi kategori berikut:

1. **Pengujian Fitur** - Menguji integrasi dan alur kerja pengguna
   - `tests/Feature/LeaderboardTest.php` - Pengujian untuk fitur Leaderboard
   - `tests/Feature/MateriTest.php` - Pengujian untuk interaksi dengan Materi
   - `tests/Feature/LessonTest.php` - Pengujian untuk modul pembelajaran
   - `tests/Feature/DashboardTest.php` - Pengujian untuk dashboard pengguna
   - `tests/Feature/PermainanTest.php` - Pengujian untuk fitur permainan
   - `tests/Feature/DocumentTest.php` - Pengujian untuk pengelolaan dokumen
   - `tests/Feature/AuthTest.php` - Pengujian untuk autentikasi

2. **Pengujian Admin** - Menguji fitur admin
   - `tests/Feature/Admin/UserTest.php` - Pengujian untuk pengelolaan pengguna oleh admin

## Cara Menjalankan Pengujian

### Pastikan berada di direktori yang benar
**PENTING**: Test harus dijalankan dari direktori medpem, bukan dari root project MPB:

```bash
cd D:\Skripsi\ Mania\ Mantap\MPB\medpem
```

### Menjalankan Semua Pengujian

```bash
php artisan test
```

### Menjalankan Pengujian Spesifik

```bash
# Menjalankan semua pengujian fitur
php artisan test --testsuite=Feature

# Menjalankan file pengujian tertentu
php artisan test tests/Feature/LeaderboardTest.php

# Menjalankan metode pengujian tertentu
php artisan test --filter=test_user_can_view_belajar_index
```

## Mengatasi Kegagalan Pengujian

Beberapa penyebab umum kegagalan pengujian:

1. **Direktori yang tidak benar** - Pastikan Anda menjalankan test dari direktori medpem, bukan MPB
2. **Route tidak sesuai** - Pastikan URL endpoint di pengujian sesuai dengan route yang terdaftar
3. **Struktur database berbeda** - Pastikan migrasi database dijalankan untuk lingkungan pengujian
4. **Method tidak ada** - Pastikan method yang diuji tersedia di controller yang bersangkutan
5. **Nama view tidak sesuai** - Pastikan nama view yang diperiksa sesuai dengan view yang sebenarnya digunakan

## Database Pengujian

Pengujian menggunakan trait `RefreshDatabase` yang akan me-reset database pengujian sebelum setiap pengujian. Pastikan Anda telah mengatur konfigurasi database pengujian di file `.env.testing`.

Contoh konfigurasi database pengujian:

```
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

## Factory Model

Pengujian menggunakan factory model untuk membuat data pengujian. Factory model tersedia untuk:

- Users
- Materi
- Lesson

## Tips Pengujian

1. Fokus pada pengujian fungsionalitas dasar terlebih dahulu (status kode HTTP)
2. Gunakan assertStatus(200) sebelum menambahkan assertion lain yang lebih spesifik
3. Verifikasi route dan endpoint sebelum menulis test
4. Jalankan pengujian satu persatu untuk menemukan titik kegagalan

## Debugging Pengujian

Untuk melihat output lebih detail saat pengujian gagal:

```bash
php artisan test --verbose
```

Untuk melihat SQL query yang dijalankan selama pengujian:

```bash
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
TELESCOPE_ENABLED=true
```

## Catatan Pengujian API

Untuk menguji endpoint API, gunakan metode `postJson()`, `getJson()`, `putJson()`, atau `deleteJson()` untuk mengirim permintaan JSON, dan gunakan metode assertion seperti `assertJson()` atau `assertJsonStructure()` untuk memverifikasi respons.

Contoh:

```php
$response = $this->postJson('/api/materi/1/progress', [
    'progress' => 50
]);

$response->assertStatus(200)
         ->assertJson([
             'success' => true
         ]);
``` 
