<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class UserRoomController extends Controller
{
    // แสดงรายการห้องประชุมให้ผู้ใช้เห็น
    public function index(Request $request)
    {
        // ดึงห้องทั้งหมดจากฐานข้อมูล
        $rooms = Room::all();

        // ค่าที่พิมพ์มาจากช่องค้นหา
        $search = $request->input('q');

        $roomsQuery = Room::query();

        if (!empty($search)) {
            $roomsQuery->where(function ($q) use ($search) {
                $q->where('room_name', 'like', "%{$search}%")
                  ->orWhere('building', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // อยากเรียงยังไงก็เติมได้
        $rooms = $roomsQuery->orderBy('room_name')->get();

        // ส่งไปหน้า users.rooms
        return view('users.rooms', compact('rooms', 'search'));
    }

    // หน้า "รายละเอียดห้อง 1 ห้อง" ฝั่งผู้ใช้
    public function show(Room $room)
    {
        return view('users.rooms_show', compact('room'));
    }

    public function bookingHistory(Request $request)
{
    // ดึงข้อมูลการจองทั้งหมด เรียงจากวันล่าสุด
    $bookings = Booking::orderBy('booking_date', 'desc')
        ->orderBy('start_time', 'asc')
        ->get();

    $search = $request->input('q');

    $query = Booking::with('room')
            ->orderByDesc('booking_date')
            ->orderBy('start_time');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('meeting_topic', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhereHas('room', function ($qr) use ($search) {
                      $qr->where('room_name', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->get();

    return view('users.booking_history', compact('bookings', 'search'));
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
