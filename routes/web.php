<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', [AuthController::class, 'splash'])->name('splash');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('bookings', BookingController::class);
        Route::post('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
        Route::post('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');
    Route::resource('professionals', ProfessionalController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class);
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password', [ProfileController::class, 'password'])->name('password.edit');
    Route::patch('/password', [ProfileController::class, 'passwordUpdate'])->name('password.update');

    // KaziLive
    Route::prefix('kazilive')->name('kazilive.')->group(function () {
        Route::get('/', [SessionController::class, 'index'])->name('index');
        Route::get('/upcoming', [SessionController::class, 'upcoming'])->name('upcoming');
        Route::get('/history', [SessionController::class, 'history'])->name('history');
    });

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/messages/{receiverId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    
    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/bookings', [ReportController::class, 'bookings'])->name('bookings');
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('revenue');
        Route::get('/activity', [ReportController::class, 'activity'])->name('activity');
        Route::get('/regional', [ReportController::class, 'regional'])->name('regional');
    });

    Route::get('/schedule', [SessionController::class, 'schedule'])->name('schedule.index');
    
    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/suspensions', [UserController::class, 'suspensions'])->name('suspensions');
        Route::post('/{user}/suspend', [UserController::class, 'suspend'])->name('suspend');
        Route::post('/{user}/unsuspend', [UserController::class, 'unsuspend'])->name('unsuspend');
        Route::get('/verifications', [UserController::class, 'verifications'])->name('verifications');
        Route::post('/{user}/verify', [UserController::class, 'verify'])->name('verify');
    });

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
});
