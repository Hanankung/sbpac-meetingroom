<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;


Route::get('/', function () {
    return view('users.index');
});

// ปฏิทินการใช้ห้องประชุม
Route::get('/calendar', function () {
    return view('users.calendar');
})->name('calendar');

// ====== Admin Auth ======
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

// route ออกจากระบบ
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');