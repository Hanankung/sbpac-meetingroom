<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1) จำนวนห้องประชุมทั้งหมด
        $totalRooms = Room::count();

        // 2) การจองวันนี้
        $today = Carbon::today()->toDateString();
        $bookingsToday = Booking::whereDate('booking_date', $today)->count();

        // 3) การจองล่วงหน้า (หลังจากวันนี้)
        $upcomingBookings = Booking::whereDate('booking_date', '>', $today)->count();

        // 4) การจองล่าสุด (ดึงมาแสดงสัก 5 รายการ)
        $latestBookings = Booking::with('room')
            ->orderByDesc('booking_date')
            ->orderByDesc('start_time')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'totalRooms',
            'bookingsToday',
            'upcomingBookings',
            'latestBookings'
        ));
    }
}
