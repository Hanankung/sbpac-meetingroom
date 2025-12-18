<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function editBooking(Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);

        $booking->load('room');

        return view('users.bookings_edit', compact('booking'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);

        $request->validate([
            'booking_date'  => ['required', 'date'],
            'start_time'    => ['required', 'date_format:H:i'],
            'end_time'      => ['required', 'date_format:H:i', 'after:start_time'],
            'meeting_topic' => ['required', 'string', 'max:255'],
            'department'    => ['nullable', 'string', 'max:255'],
            'name'          => ['required', 'string', 'max:100'],
            'lastname'      => ['required', 'string', 'max:100'],
            'phone'         => ['nullable', 'string', 'max:20'],
            // ถ้าตัด email แล้ว ไม่ต้องมี
        ]);
        $tz = config('app.timezone', 'Asia/Bangkok');
        $now = Carbon::now($tz);

        $startAt = Carbon::parse($request->booking_date . ' ' . $request->start_time, $tz);
        $endAt   = Carbon::parse($request->booking_date . ' ' . $request->end_time, $tz);

        if ($startAt->lt($now)) {
            return back()->withErrors([
                'time' => 'ไม่สามารถแก้ไขเป็นเวลาย้อนหลังได้ เพราะเวลาเริ่ม (' . $request->start_time . ') ผ่านไปแล้ว กรุณาเลือกเวลา “ปัจจุบันหรืออนาคต”',
                'start_time' => 'เวลาเริ่มผ่านไปแล้ว'
            ])->withInput();
        }

        if ($endAt->lte($now)) {
            return back()->withErrors([
                'time' => 'ไม่สามารถแก้ไขเป็นเวลาย้อนหลังได้ เพราะเวลาสิ้นสุด (' . $request->end_time . ') ผ่านไปแล้ว กรุณาเลือกเวลา “ปัจจุบันหรืออนาคต”',
                'end_time' => 'เวลาสิ้นสุดต้องเป็นปัจจุบันหรืออนาคต'
            ])->withInput();
        }



        // ✅ เช็คเวลาซ้ำ
        $overlap = Booking::where('room_id', $booking->room_id)
            ->where('booking_date', $request->booking_date)
            ->where('id', '!=', $booking->id)
            ->where(function ($q) use ($request) {
                $q->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['time' => 'ช่วงเวลานี้ถูกจองแล้ว กรุณาเลือกเวลาใหม่'])->withInput();
        }

        $booking->update([
            'booking_date'  => $request->booking_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'meeting_topic' => $request->meeting_topic,
            'department'    => $request->department,
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phone'         => $request->phone,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'แก้ไขรายการจองเรียบร้อยแล้ว');
    }

    public function bookingHistory(Request $request)
    {
        // ดึงข้อมูลการจองทั้งหมด เรียงจากวันล่าสุด
        $bookings = Booking::orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'asc')
            ->get();

        $search = $request->input('q');

        $query = Booking::with('room')
            ->where('user_id', Auth::id())
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
        abort_unless($booking->user_id === Auth::id(), 403);
        $booking->load('room'); // ดึงข้อมูลห้องมาด้วย (room_name ฯลฯ)

        return view('users.booking_history_show', compact('booking'));
    }
}
