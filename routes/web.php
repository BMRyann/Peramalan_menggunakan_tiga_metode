<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeramalanController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordResetController;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// -------------------------
// AUTHENTICATION
// -------------------------
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgotpassword', [PasswordResetController::class, 'showForgotForm'])->name('forgotpassword');

// Kirim email reset password
Route::post('/forgotpassword', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

// Halaman reset password
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('resetpassword');

// Simpan password baru
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
;


// ===============================
// 🔹 HALAMAN TERPROTEKSI (HANYA SETELAH LOGIN)
// ===============================
Route::get('/home', [AuthController::class, 'home'])
    ->name('home')
    ->middleware('auth');

// ===============================
// 🔹 DATA SISWAx`
// ===============================
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/create', [SiswaController::class, 'create'])->name('create');
    Route::post('/', [SiswaController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SiswaController::class, 'update'])->name('update');
    Route::get('/{id}/show', [SiswaController::class, 'show'])->name('show');
    Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('destroy');
    Route::post('/import', [SiswaController::class, 'import'])->name('import');
});

// routes/web.php
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/password/edit', [ProfileController::class, 'editPassword'])->name('password.edit');
Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');



// ===============================
// 🔹 PERAMALAN
// ===============================
// Route Tampilan Peramalan
Route::get('/peramalan', [PeramalanController::class, 'index'])->name('peramalan.index');

// Route Export Excel
Route::get('/peramalan/export/excel', function () {
    return Excel::download(new \App\Exports\PeramalanExport, 'peramalan.xlsx');
})->name('peramalan.export.excel');

// Route Export PDF
Route::get('/peramalan/export/pdf', [PeramalanController::class, 'exportPDF'])
    ->name('peramalan.export.pdf');


// ===============================
// 🔹 EVALUASI
// ===============================
Route::prefix('evaluasi')->name('evaluasi.')->group(function () {
    Route::get('/', [EvaluasiController::class, 'index'])->name('index');
    Route::get('/export/pdf', [EvaluasiController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/export/excel', [EvaluasiController::class, 'exportExcel'])->name('export.excel');
});

// ===============================
// 🔹 MANAJEMEN ADMIN
// ===============================
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('index');
//     Route::get('/create', [AdminController::class, 'create'])->name('create');
//     Route::post('/', [AdminController::class, 'store'])->name('store');
//     Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
// });

