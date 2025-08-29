<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.login');
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



Route::get('/director/dashboard', function () {
    $user = Auth::user();
    if (!$user || $user->role !== 'director') {
        abort(403, 'غير مسموح بالدخول');
    }
    return view('director.dashboard');
})->name('director.dashboard')->middleware('auth');

// راوت لعرض الفورم
Route::get('/director/parent/create', function () {
    $user = Auth::user();
    if (!$user || $user->role !== 'director') abort(403);
    return view('director.parent-create');
})->name('director.parent-create');

// راوت لمعالجة الفورم
Route::post('/director/parents/store', [DirectorController::class, 'registerParent_student'])
    ->name('director.parents.store');


Route::get('/director/students/create', function () {
    $user = Auth::user();
    if (!$user || $user->role !== 'director') abort(403);
    return view('director.student-create');
})->name('director.students.create');

// حفظ الطالب الجديد
Route::post('/director/students/store', [DirectorController::class, 'registerStudent'])
    ->name('director.students.store');

// عرض الطلاب
Route::get('/director/students/index', [DirectorController::class, 'index_students'])
    ->name('director.students.index');

Route::get('/director/students/{id}', [DirectorController::class, 'show_student_details'])
    ->name('director.students.show');

Route::delete('/director/students/{id}', [DirectorController::class, 'destroy'])
    ->name('director.students.destroy');
Route::delete('/director/students/{id}', [DirectorController::class, 'destroy'])
    ->name('director.students.destroy');



// 🟢 العلامات
Route::prefix('director/marks')->middleware('auth')->group(function () {

    // إضافة علامات
    Route::get('/create', function () {
        $user = Auth::user();
        if (!$user || $user->role !== 'director') abort(403);
        return view('director.marks.create');
    })->name('director.marks.create');

    // عرض العلامات
    Route::get('/', function () {
        $user = Auth::user();
        if (!$user || $user->role !== 'director') abort(403);
        return view('director.marks.index');
    })->name('director.marks.index');
});

// 🟢 البرامج الأسبوعية
Route::prefix('director/programs')->middleware('auth')->group(function () {

    // إضافة برنامج أسبوعي
    Route::get('/create', function () {
        $user = Auth::user();
        if (!$user || $user->role !== 'director') abort(403);
        return view('director.programs.create');
    })->name('director.programs.create');

    // عرض البرامج الأسبوعية
    Route::get('/', function () {
        $user = Auth::user();
        if (!$user || $user->role !== 'director') abort(403);
        return view('director.programs.index');
    })->name('director.programs.index');
});
// عرض صفحة أخذ التفقد
Route::get('/director/attendance', [DirectorController::class, 'attendanceForm'])
    ->name('director.attendance');
// حفظ التفقد
Route::post('/director/attendance/store', [DirectorController::class, 'store_check'])
    ->name('director.attendance.store');
// عرض كل سجلات التفقد
Route::get('/director/attendance/index', [DirectorController::class, 'index_check'])
    ->name('director.attendance.index');


// 🟢 تسجيل الخروج
Route::post('/director/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->middleware('auth')->name('director.logout');


