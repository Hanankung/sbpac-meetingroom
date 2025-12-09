<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    // หน้าแสดง "ประวัติการจอง" ฝั่งแอดมิน
    public function index()
    {
        $bookings = Booking::with('room')
            ->orderByDesc('booking_date')
            ->orderBy('start_time')
            ->get();

        return view('admin.bookings_history', compact('bookings'));
    }

    // หน้า "รายละเอียดประวัติการจอง 1 รายการ" ฝั่งแอดมิน
    public function show(Booking $booking)
    {
        $booking->load('room');

        return view('admin.booking_history_show', compact('booking'));
    }
}
