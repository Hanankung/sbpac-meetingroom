<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\UserRoomController;

Route::get('/', function () {
    return view('users.index');
});

// ปฏิทินการใช้ห้องประชุม (ฝั่งผู้ใช้ทั่วไป)
Route::get('/calendar', function () {
    return view('users.calendar');
})->name('calendar');

// หน้า "จองห้องประชุม" ของผู้ใช้
Route::get('/rooms', [UserRoomController::class, 'index'])->name('users.rooms');
// หน้าแสดง "รายละเอียดห้องประชุม 1 ห้อง"
Route::get('/rooms/{room}', [UserRoomController::class, 'show'])->name('user.rooms.show');


// ====== Admin Auth ======
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ====== พื้นที่ /admin ======
Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    // ห้องประชุม
    Route::get('/rooms',          [AdminRoomController::class, 'index'])->name('admin.rooms');
    Route::get('/rooms/create',   [AdminRoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('/rooms',         [AdminRoomController::class, 'store'])->name('admin.rooms.store');

    //สำหรับ แก้ไข / อัปเดต / ลบ
    Route::get('/rooms/{room}/edit', [AdminRoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/rooms/{room}',      [AdminRoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/rooms/{room}',   [AdminRoomController::class, 'destroy'])->name('admin.rooms.destroy');
    
    //show
    Route::get('/rooms/{room}', [AdminRoomController::class, 'show'])->name('admin.rooms.show');
});