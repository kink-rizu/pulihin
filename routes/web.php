<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Donatur\DashboardController as DonaturDashboard;
use App\Http\Controllers\Korban\DashboardController as KorbanDashboard;
use App\Http\Controllers\Volunteer\DashboardController as VolunteerDashboard;
use App\Http\Controllers\Admin\ProgramBantuanController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\KorbanController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\PenyaluranController as AdminPenyaluranController;
use App\Http\Controllers\Admin\LaporanPenyaluranController;
use App\Http\Controllers\Donatur\DonasiController as DonaturDonasiController;
use App\Http\Controllers\Korban\KebutuhanController;
use App\Http\Controllers\Volunteer\PenyaluranController as VolunteerPenyaluranController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])->name('register.donatur');
Route::post('/register/korban', [RegisterController::class, 'registerKorban'])->name('register.korban');
Route::post('/register/volunteer', [RegisterController::class, 'registerVolunteer'])->name('register.volunteer');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('program', ProgramBantuanController::class);
    Route::resource('donasi', AdminDonasiController::class);
    Route::resource('korban', KorbanController::class);
    Route::resource('volunteer', VolunteerController::class);
    Route::resource('penyaluran', AdminPenyaluranController::class);
    Route::get('laporan/penyaluran', [LaporanPenyaluranController::class, 'index'])
        ->name('laporan.penyaluran');
    Route::get('laporan/penyaluran/export', [LaporanPenyaluranController::class, 'exportExcel'])
        ->name('laporan.penyaluran.export');
    Route::get('laporan/penyaluran/print', [LaporanPenyaluranController::class, 'print'])
        ->name('laporan.penyaluran.print');
    
    // Verifikasi Korban
    Route::post('/korban/{korban}/verify', [KorbanController::class, 'verify'])->name('korban.verify');
    Route::post('/korban/{korban}/reject', [KorbanController::class, 'reject'])->name('korban.reject');
    
    // Verifikasi Donasi
    Route::post('/donasi/{donasi}/verify', [AdminDonasiController::class, 'verify'])->name('donasi.verify');
    Route::post('/donasi/{donasi}/reject', [AdminDonasiController::class, 'reject'])->name('donasi.reject');
});

// Donatur Routes
Route::prefix('donatur')->name('donatur.')->middleware('donatur')->group(function () {
    Route::get('/dashboard', [DonaturDashboard::class, 'index'])->name('dashboard');
    Route::get('/donasi/create/{program}', [DonaturDonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [DonaturDonasiController::class, 'store'])->name('donasi.store');
    Route::get('/donasi/{donasi}', [DonaturDonasiController::class, 'show'])->name('donasi.show');
    Route::get('/program', [DonaturDonasiController::class, 'programs'])->name('program.index');
});

// Korban Routes
Route::prefix('korban')->name('korban.')->middleware('korban')->group(function () {
    Route::get('/dashboard', [KorbanDashboard::class, 'index'])->name('dashboard');
    Route::resource('kebutuhan', KebutuhanController::class);
    Route::get('/bantuan', [KorbanDashboard::class, 'riwayatBantuan'])->name('bantuan.index');
});

// Volunteer Routes
Route::prefix('volunteer')->name('volunteer.')->middleware('volunteer')->group(function () {
    Route::get('/dashboard', [VolunteerDashboard::class, 'index'])->name('dashboard');
    Route::resource('penyaluran', VolunteerPenyaluranController::class);
    Route::get('/tugas', [VolunteerDashboard::class, 'tugas'])->name('tugas.index');
});
