<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class UserRoomController extends Controller
{
    // แสดงรายการห้องประชุมให้ผู้ใช้เห็น
    public function index()
    {
        // ดึงห้องทั้งหมดจากฐานข้อมูล
        $rooms = Room::all();

        // ส่งไปหน้า users.rooms
        return view('users.rooms', compact('rooms'));
    }

    // หน้า "รายละเอียดห้อง 1 ห้อง" ฝั่งผู้ใช้
    public function show(Room $room)
    {
        return view('users.rooms_show', compact('room'));
    }
    public function bookingHistory()
{
    // ดึงข้อมูลการจองทั้งหมด เรียงจากวันล่าสุด
    $bookings = Booking::orderBy('booking_date', 'desc')
        ->orderBy('start_time', 'asc')
        ->get();

    return view('users.booking_history', compact('bookings'));
}
    public function history()
    {
        $bookings = Booking::with('room')
            ->orderByDesc('booking_date')
            ->get();

        return view('users.bookings_history', compact('bookings'));
    }
    
    public function historyShow(Booking $booking)
    {
        $booking->load('room'); // ดึงข้อมูลห้องมาด้วย (room_name ฯลฯ)

        return view('users.booking_history_show', compact('booking'));
    }
}
