<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\AdminSetupController;
use App\Http\Controllers\Alumni\DashboardController as AlumniDashboard;
use App\Http\Controllers\Alumni\ProfileController;
use App\Http\Controllers\Alumni\EventController as AlumniEventController;
use App\Http\Controllers\Alumni\AnnouncementController as AlumniAnnouncementController;
use App\Http\Controllers\Alumni\DirectoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ImportController as AdminImportController;

// ── GUEST ROUTES ──────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/setup/admin', [AdminSetupController::class, 'create'])->name('admin.setup.create');
Route::post('/setup/admin', [AdminSetupController::class, 'store'])->name('admin.setup.store');

Route::get('/activate', [ActivationController::class, 'showActivate'])->name('activate');
Route::post('/activate', [ActivationController::class, 'activate'])->name('activate.post');

// ── ALUMNI ROUTES ─────────────────────────────────
Route::middleware(['auth', 'role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/dashboard', [AlumniDashboard::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/events', [AlumniEventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [AlumniEventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/rsvp', [AlumniEventController::class, 'rsvp'])->name('events.rsvp');
    Route::post('/events/{event}/cancel-rsvp', [AlumniEventController::class, 'cancelRsvp'])->name('events.cancel-rsvp');
    Route::get('/announcements', [AlumniAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AlumniAnnouncementController::class, 'show'])->name('announcements.show');
    Route::get('/directory', [DirectoryController::class, 'index'])->name('directory');
});

// ── ADMIN ROUTES ──────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('alumni', AlumniController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('announcements', AdminAnnouncementController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/import', [AdminImportController::class, 'index'])->name('import.index');
    Route::post('/import/trigger', [AdminImportController::class, 'trigger'])->name('import.trigger');
    Route::get('/activations', [\App\Http\Controllers\Admin\ActivationController::class, 'index'])->name('activations.index');
    Route::get('/activations/{profile}', [\App\Http\Controllers\Admin\ActivationController::class, 'show'])->name('activations.show');
    Route::post('/activations/{profile}/approve', [\App\Http\Controllers\Admin\ActivationController::class, 'approve'])->name('activations.approve');
    Route::post('/activations/{profile}/reject', [\App\Http\Controllers\Admin\ActivationController::class, 'reject'])->name('activations.reject');
});
