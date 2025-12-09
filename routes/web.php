<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\UserRoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminBookingController;

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

// ใหม่: ฟอร์มจอง + บันทึกการจอง
Route::get('/rooms/{room}/book',  [BookingController::class, 'create'])->name('user.bookings.create');
Route::post('/rooms/{room}/book', [BookingController::class, 'store'])->name('user.bookings.store');

// ประวัติการจองห้องประชุม (ฝั่งผู้ใช้งาน)
Route::get('/bookings/history', [UserRoomController::class, 'bookingHistory'])
    ->name('bookings.history');

// หน้า "รายละเอียดประวัติการจอง 1 รายการ"
Route::get('/bookings/{booking}', [UserRoomController::class, 'historyShow'])
    ->name('bookings.show');

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

    // ประวัติการจอง (admin)
    Route::get('/bookings/history', [AdminBookingController::class, 'index'])
        ->name('admin.bookings.history');

    // รายละเอียดประวัติการจอง 1 รายการ (admin)
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])
        ->name('admin.bookings.show');
});