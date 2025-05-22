<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\User\MateriController as UserMateriController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PermainanController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Learning routes
Route::middleware('auth')->group(function () {
    // Profile page
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Achievement routes
    Route::get('/achievements', [App\Http\Controllers\AchievementController::class, 'index'])->name('achievements.index');
    Route::get('/achievements/check', [App\Http\Controllers\AchievementController::class, 'checkAchievements'])->name('achievements.check');
    Route::get('/achievements/{id}', [App\Http\Controllers\AchievementController::class, 'show'])->name('achievements.show');

    // Test route to directly check achievements and show the page
    Route::get('/test-achievements', function () {
        $user = \App\Models\Users::find(Auth::id());
        $achievementService = app(\App\Services\AchievementService::class);
        $achievementService->checkAchievements($user);
        return redirect()->route('achievements.index');
    })->name('test.achievements');

    // Test route to verify speed achievements
    Route::get('/test-speed-achievement', [\App\Http\Controllers\AchievementController::class, 'testSpeedAchievement'])->name('test.speed.achievement');

    // Show current question
    Route::get('/belajar/question/current', [LessonController::class, 'showQuestion'])->name('belajar.question');

    // Submit answer
    Route::post('/belajar/question/answer', [LessonController::class, 'answerQuestion'])->name('belajar.answer');

    // Lesson completion page
    Route::get('/belajar/{id}/complete', [LessonController::class, 'complete'])->name('belajar.complete');

    // Review completed lesson (view only)
    Route::get('/belajar/{id}/review/{part?}', [LessonController::class, 'reviewLesson'])->name('belajar.review');

    // Start a lesson
    Route::post('/belajar/{id}/start', [LessonController::class, 'start'])->name('belajar.start');

    // Lesson detail
    Route::get('/belajar/{id}', [LessonController::class, 'show'])->name('belajar.show');

    // Main learning index
    Route::get('/belajar', [LessonController::class, 'index'])->name('belajar');

    // User Materi routes (read-only)
    Route::get('/user/materi', [UserMateriController::class, 'index'])->name('user.materi.index');
    Route::get('/user/materi/{materi}', [UserMateriController::class, 'show'])->name('user.materi.show');
    Route::post('/user/materi/{materi}/progress', [UserMateriController::class, 'updateProgress'])->name('user.materi.progress');

    // Dokumen upload/download routes
    Route::post('/upload-document', [DocumentController::class, 'upload'])->name('document.upload');
    Route::get('/document/{fileName}', [DocumentController::class, 'download'])->name('document.download');
    Route::get('/document/serve/{id}', [DocumentController::class, 'serve'])->name('document.serve');

    // Permainan Routes
    Route::get('/permainan', [PermainanController::class, 'index'])->name('permainan');

    // Word Scramble games
    Route::get('/permainan/word-scramble', [PermainanController::class, 'wordScramble'])->name('permainan.word-scramble');
    Route::get('/permainan/word-scramble-house', [PermainanController::class, 'wordScrambleHouse'])->name('permainan.word-scramble-house');

    // Word Matching games
    Route::get('/permainan/word-matching', [PermainanController::class, 'wordMatching'])->name('permainan.word-matching');
    Route::get('/permainan/word-matching-house', [PermainanController::class, 'wordMatchingHouse'])->name('permainan.word-matching-house');

    // Word Search games
    Route::get('/permainan/word-search', [PermainanController::class, 'wordSearch'])->name('permainan.word-search');
    Route::get('/permainan/word-search-house', [PermainanController::class, 'wordSearchHouse'])->name('permainan.word-search-house');
    Route::get('/permainan/word-search-illness', [PermainanController::class, 'wordSearchIllness'])->name('permainan.word-search-illness');

    // Word Scramble Illness game
    Route::get('/permainan/word-scramble-illness', [PermainanController::class, 'wordScrambleIllness'])->name('permainan.word-scramble-illness');

    // Sentence Scramble game
    Route::get('/permainan/sentence-scramble', [PermainanController::class, 'sentenceScramble'])->name('permainan.sentence-scramble');

    // Word Matching Illness game
    Route::get('/permainan/word-matching-illness', [PermainanController::class, 'wordMatchingIllness'])->name('permainan.word-matching-illness');

    // Image Guessing and Image Matching games
    Route::get('/permainan/image-matching-house', [PermainanController::class, 'imageMatchingHouse'])->name('permainan.image-matching-house');

    // Word Hangman game
    Route::get('/permainan/word-hangman-body', [PermainanController::class, 'wordHangmanBody'])->name('permainan.word-hangman-body');

    // Game completion
    Route::post('/permainan/complete', [PermainanController::class, 'completeGame'])->name('permainan.complete');

    // Game answers & explanations
    Route::get('/permainan/answers/{slug}', [PermainanController::class, 'showAnswers'])->name('permainan.answers');
});

Route::get('/mengerjakan-tugas', function () {
    return view('mengerjakan_tugas.index');
})->name('mengerjakan_tugas');

// Admin-only materi routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/materi', [MateriController::class, 'index'])->name('admin.materi.index');
    Route::get('/admin/materi/create', [MateriController::class, 'create'])->name('admin.materi.create');
    Route::post('/admin/materi', [MateriController::class, 'store'])->name('admin.materi.store');
    Route::get('/admin/materi/{materi}', [MateriController::class, 'show'])->name('admin.materi.show');
    Route::get('/admin/materi/{materi}/edit', [MateriController::class, 'edit'])->name('admin.materi.edit');
    Route::put('/admin/materi/{materi}', [MateriController::class, 'update'])->name('admin.materi.update');
    Route::delete('/admin/materi/{materi}', [MateriController::class, 'destroy'])->name('admin.materi.destroy');

    // Document deletion route
    Route::delete('/admin/materi/document/{id}/delete', [MateriController::class, 'deleteDocument'])->name('admin.materi.document.delete');

    // User management routes - available to both admin and superadmin
    Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');

    // Export users data route - must be before {user} routes to avoid conflicts
    Route::get('/admin/users/export/csv', [App\Http\Controllers\Admin\UserController::class, 'exportUsers'])->name('admin.users.export');

    Route::get('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
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
        return redirect()->route('permainan')->with('success', 'All games have been seeded into the database.');
    }

    return redirect()->route('permainan')->with('error', 'Access denied.');
})->middleware('auth')->name('seed.games');

// Admin route to specifically seed house-themed games
Route::get('/seed-house-games', function() {
    // Check if the user is an admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
        Artisan::call('db:seed', ['--class' => 'HouseGamesSeeder', '--force' => true]);
        return redirect()->route('permainan')->with('success', 'House-themed games have been seeded into the database.');
    }

    return redirect()->route('permainan')->with('error', 'Access denied.');
})->middleware('auth')->name('seed.house.games');

// Admin route to specifically seed hangman games
Route::get('/seed-hangman-games', function() {
    // Check if the user is an admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
        Artisan::call('db:seed', ['--class' => 'HangmanGamesSeeder', '--force' => true]);
        return redirect()->route('permainan')->with('success', 'Hangman games have been seeded into the database.');
    }

    return redirect()->route('permainan')->with('error', 'Access denied.');
})->middleware('auth')->name('seed.hangman.games');

