<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PermainanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\User\MateriController as UserMateriController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckDeviceToken;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes that require authentication and device token check
Route::middleware(['auth', CheckDeviceToken::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Profile routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Materi routes
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{id}', [MateriController::class, 'show'])->name('materi.show');
    Route::post('/materi/{id}/progress', [MateriController::class, 'updateProgress'])->name('materi.progress');

    // Lesson/Belajar routes
    Route::prefix('belajar')->name('belajar.')->group(function () {
        Route::get('/', [LessonController::class, 'index'])->name('index');
        Route::get('/{id}', [LessonController::class, 'show'])->name('show');
        Route::post('/{id}/start', [LessonController::class, 'start'])->name('start');
        Route::get('/{id}/complete', [LessonController::class, 'complete'])->name('complete');
        Route::get('/question/current', [LessonController::class, 'showQuestion'])->name('question');
        Route::post('/question/answer', [LessonController::class, 'answerQuestion'])->name('answer');
        Route::get('/{id}/review/{part?}', [LessonController::class, 'reviewLesson'])->name('review');
    });

    // Document routes
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');

    // Game routes
    Route::prefix('permainan')->name('permainan.')->group(function () {
        Route::get('/', [PermainanController::class, 'index'])->name('index');
        Route::get('/word-scramble', [PermainanController::class, 'wordScramble'])->name('word-scramble');
        Route::get('/word-scramble-house', [PermainanController::class, 'wordScrambleHouse'])->name('word-scramble-house');
        Route::get('/word-matching', [PermainanController::class, 'wordMatching'])->name('word-matching');
        Route::get('/word-matching-house', [PermainanController::class, 'wordMatchingHouse'])->name('word-matching-house');
        Route::get('/word-search', [PermainanController::class, 'wordSearch'])->name('word-search');
        Route::get('/word-search-house', [PermainanController::class, 'wordSearchHouse'])->name('word-search-house');
        Route::get('/word-search-illness', [PermainanController::class, 'wordSearchIllness'])->name('word-search-illness');
        Route::get('/word-scramble-illness', [PermainanController::class, 'wordScrambleIllness'])->name('word-scramble-illness');
        Route::get('/sentence-scramble', [PermainanController::class, 'sentenceScramble'])->name('sentence-scramble');
        Route::get('/word-matching-illness', [PermainanController::class, 'wordMatchingIllness'])->name('word-matching-illness');
        Route::get('/image-matching-house', [PermainanController::class, 'imageMatchingHouse'])->name('image-matching-house');
        Route::get('/word-hangman-body', [PermainanController::class, 'wordHangmanBody'])->name('word-hangman-body');
        Route::post('/complete', [PermainanController::class, 'completeGame'])->name('complete');
        Route::get('/answers/{slug}', [PermainanController::class, 'showAnswers'])->name('answers');
    });

    // Achievement routes
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::get('/achievements/check', [AchievementController::class, 'checkAchievements'])->name('achievements.check');
    Route::get('/achievements/{id}', [AchievementController::class, 'show'])->name('achievements.show');

    // Test route to directly check achievements and show the page
    Route::get('/test-achievements', function () {
        $user = \App\Models\Users::find(Auth::id());
        $achievementService = app(\App\Services\AchievementService::class);
        $achievementService->checkAchievements($user);
        return redirect()->route('achievements.index');
    })->name('test.achievements');

    // Test route to verify speed achievements
    Route::get('/test-speed-achievement', [\App\Http\Controllers\AchievementController::class, 'testSpeedAchievement'])->name('test.speed.achievement');

    // User Materi routes (read-only)
    Route::get('/user/materi', [UserMateriController::class, 'index'])->name('user.materi.index');
    Route::get('/user/materi/{materi}', [UserMateriController::class, 'show'])->name('user.materi.show');
    Route::post('/user/materi/{materi}/progress', [UserMateriController::class, 'updateProgress'])->name('user.materi.progress');

    // Document upload/download routes
    Route::post('/upload-document', [DocumentController::class, 'upload'])->name('document.upload');
    Route::get('/document/{fileName}', [DocumentController::class, 'download'])->name('document.download');
    Route::get('/document/serve/{id}', [DocumentController::class, 'serve'])->name('document.serve');
});

Route::get('/mengerjakan-tugas', function () {
    return view('mengerjakan_tugas.index');
})->name('mengerjakan_tugas');

// Admin-only routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Materi management
        Route::resource('materi', MateriController::class);
        Route::delete('materi/document/{id}/delete', [MateriController::class, 'deleteDocument'])->name('materi.document.delete');

        // User management
        Route::resource('users', UserController::class);
        Route::get('users/export/csv', [UserController::class, 'exportUsers'])->name('users.export');
    });
});

// Leaderboard route
Route::get('/skor', [LeaderboardController::class, 'index'])
    ->middleware(['auth', \App\Http\Middleware\PreventRequestCaching::class])
    ->name('leaderboard');

// Maintenance route to fix user points (only accessible to admins)
Route::get('/fix-points', function() {
    // Check if the user is an admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
        Artisan::call('fix:user-points');
        return redirect()->route('leaderboard')->with('success', 'Points have been fixed! The leaderboard now reflects all your completions.');
    }

    return redirect()->route('leaderboard');
})->middleware('auth')->name('fix.points');

// Admin maintenance route to seed games
Route::get('/seed-games', function() {
    // Check if the user is an admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
        Artisan::call('db:seed', ['--class' => 'GameSeeder', '--force' => true]);
        return redirect()->route('permainan.index')->with('success', 'All games have been seeded into the database.');
    }

    return redirect()->route('permainan.index')->with('error', 'Access denied.');
})->middleware('auth')->name('seed.games');

// Admin route to specifically seed house-themed games
Route::get('/seed-house-games', function() {
    // Check if the user is an admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
        Artisan::call('db:seed', ['--class' => 'HouseGamesSeeder', '--force' => true]);
        return redirect()->route('permainan.index')->with('success', 'House-themed games have been seeded into the database.');
    }

    return redirect()->route('permainan.index')->with('error', 'Access denied.');
})->middleware('auth')->name('seed.house.games');

// Admin route to specifically seed hangman games
Route::get('/seed-hangman-games', function() {
    // Check if the user is an admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
        Artisan::call('db:seed', ['--class' => 'HangmanGamesSeeder', '--force' => true]);
        return redirect()->route('permainan.index')->with('success', 'Hangman games have been seeded into the database.');
    }

    return redirect()->route('permainan.index')->with('error', 'Access denied.');
})->middleware('auth')->name('seed.hangman.games');

// Route untuk gambar materi
Route::get('/images/materi/{filename}', function ($filename) {
    $path = public_path('images/materi/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('materi.image');

