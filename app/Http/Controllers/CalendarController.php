<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class CalendarController extends Controller
{
     public function index(Request $request)
    {
        // 1) เดือนที่ต้องการดู (ถ้ามี ?month=2025-11 รับค่ามา, ไม่มีก็ใช้เดือนปัจจุบัน)
        $current = $request->query('month')
            ? Carbon::parse($request->query('month'))->startOfMonth()
            : Carbon::now()->startOfMonth();

        // 2) ช่วงวันจริงที่ต้องใช้ในปฏิทิน (เริ่มจันทร์แรก – ถึงอาทิตย์สุดท้ายของเดือนนั้น)
        $startOfWeek = $current->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek   = $current->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        // 3) ดึง booking ที่อยู่ในช่วงวันที่ที่ปฏิทินแสดง
        $bookings = Booking::with('room')
            ->whereBetween('booking_date', [
                $startOfWeek->toDateString(),
                $endOfWeek->toDateString(),
            ])
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get();

        // 4) group ตามวันที่ เพื่อเอาไปเช็คทีหลังว่ามีคนจองในวันนั้นไหม
        $bookingsByDate = $bookings->groupBy('booking_date');

        // 5) สร้าง array weeks (เหมือนที่คุณเคยทำ)
        $date  = $startOfWeek->copy();
        $weeks = [];
        while ($date->lte($endOfWeek)) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = $date->copy();
                $date->addDay();
            }
            $weeks[] = $week;
        }

        // 6) วันที่ถูกคลิก (ถ้ามี ?date=YYYY-MM-DD)
        $selectedDate = $request->query('date');
        $selectedBookings = [];
        if ($selectedDate) {
            $selectedBookings = $bookingsByDate->get($selectedDate, collect());
        }

        return view('users.calendar', [
            'current'           => $current,
            'weeks'             => $weeks,
            'bookingsByDate'    => $bookingsByDate,
            'selectedDate'      => $selectedDate,
            'selectedBookings'  => $selectedBookings,
        ]);
    }
}
