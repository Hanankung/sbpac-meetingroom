<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.index');
});

// ปฏิทินการใช้ห้องประชุม
Route::get('/calendar', function () {
    return view('users.calendar');
})->name('calendar');