<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // แสดงฟอร์มจองห้อง (ใช้ของเดิมได้เลย)
    public function create(Room $room)
    {
        $user = Auth::user(); // ถ้าใช้ guard อื่นค่อยเปลี่ยนเป็น Auth::guard('xxx')->user()

        return view('users.bookings_create', compact('room', 'user'));
    }

    // รับข้อมูลจากฟอร์มแล้วบันทึก
    public function store(Request $request, Room $room)
    {
        // 1) validate ข้อมูลพื้นฐาน
        $request->validate([
            'booking_date'  => ['required', 'date'],
            'start_time'    => ['required', 'date_format:H:i'],
            'end_time'      => ['required', 'date_format:H:i', 'after:start_time'],
            'meeting_topic' => ['required', 'string', 'max:255'],
            'department'    => ['nullable', 'string', 'max:255'],
            'name'          => ['required', 'string', 'max:100'],
            'lastname'      => ['required', 'string', 'max:100'],
            'phone'         => ['nullable', 'string', 'max:20'],
            // 'email'         => ['nullable', 'email', 'max:255'],
        ]);

        $tz = config('app.timezone', 'Asia/Bangkok');
        $now = Carbon::now($tz);

        $startAt = Carbon::parse($request->booking_date . ' ' . $request->start_time, $tz);
        $endAt   = Carbon::parse($request->booking_date . ' ' . $request->end_time, $tz);

        if ($startAt->lt($now)) {
            return back()
                ->withErrors(['start_time' => 'ไม่สามารถจองย้อนหลังได้ กรุณาเลือกเวลา “ปัจจุบันหรืออนาคต”'])
                ->withInput();
        }

        if ($endAt->lte($now)) {
            return back()
                ->withErrors(['end_time' => 'เวลาสิ้นสุดต้องเป็น “ปัจจุบันหรืออนาคต”'])
                ->withInput();
        }

        // 2) เช็กว่าห้องว่างไหม (ดูเฉพาะห้องนี้ + วันที่นี้ + เวลา overlap)
        $exists = Booking::where('room_id', $room->id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['time' => 'ช่วงเวลานี้ถูกจองแล้ว กรุณาเลือกเวลาใหม่'])
                ->withInput();
        }

        // 3) ถ้าไม่ชน -> สร้างการจองได้เลย (ถือว่าอนุมัติทันที)
        Booking::create([
            'user_id'      => Auth::id(), // ✅ ผูกกับ user ที่ล็อกอินอยู่
            'room_id'       => $room->id,
            'booking_date'  => $request->booking_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'meeting_topic' => $request->meeting_topic,
            'department'    => $request->department,
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phone'         => $request->phone,
            // 'email'         => $request->email,
        ]);


        // 4) กลับไปหน้ารายละเอียดห้อง พร้อมแจ้งว่า "จองสำเร็จแล้ว"
        return redirect()
            ->route('users.rooms')
            ->with('success', 'จองห้องประชุมสำเร็จแล้ว');
    }
}
