<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/table', function () {
    return view('table');
});
Route::get('/admin/create-director', function () {
    return view('admin.create-director');
})->name('admin.create-director');

Route::post('/admin/store-director', [AdminController::class, 'register_Director_in_admin'])
    ->name('admin.store-director');
//
//Route::middleware(['auth'])->group(function () {

    // صفحة إنشاء إعلان جديد (form)
    Route::get('/announcements/create', [AdminController::class, 'create'])
        ->name('announcements.create');

    // تخزين إعلان جديد
    Route::post('/announcements', [AdminController::class, 'createAnnouncements'])
        ->name('announcements.store');

    // عرض كل الإعلانات
    Route::get('/announcements', [AdminController::class, 'index_Ann'])
        ->name('announcements.index');

//});
// صفحة تسجيل الدخول للمدير والموجه
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');

// معالجة تسجيل الدخول
Route::post('/admin/login', [AuthController::class, 'loginWeb'])->name('admin.login.post');

// لوحة المدير بعد تسجيل الدخول
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
});


