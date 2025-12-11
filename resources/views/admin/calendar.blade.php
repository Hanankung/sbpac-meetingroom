{{-- resources/views/admin/calendar.blade.php --}}
@extends('admin.layout')

@section('title', 'ระบบจองห้องประชุม | ศอ.บต.')

@push('styles')
    <style>
        main {
            background: #f3f4f6;
        }

        .calendar-header-card {
            background: #fff;
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .calendar-wrapper {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }

        .cal-day-name {
            text-align: center;
            font-weight: 600;
            padding: 6px 0;
            font-size: 13px;
            color: #4b5563;
        }

        .cal-cell {
            background: #f9fafb;
            min-height: 80px;
            border-radius: 10px;
            padding: 6px;
            font-size: 13px;
            position: relative;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            transition: background .15s, transform .1s, box-shadow .15s;
        }

        .cal-cell span.day-number {
            font-weight: 600;
            font-size: 13px;
        }

        .cal-cell.outside-month {
            color: #9ca3af;
            background: #f3f4f6;
        }

        .cal-cell.has-booking {
            border-color: #22c55e;
            box-shadow: 0 0 0 1px rgba(34, 197, 94, 0.7);
        }

        .cal-cell.selected {
            background: #ecfdf3;
        }

        .cal-dot {
            position: absolute;
            bottom: 6px;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #16a34a;
        }

        .booking-list-card {
            margin-top: 20px;
            background: #fff;
            border-radius: 16px;
            padding: 18px 22px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
        }
    </style>
@endpush


@section('content')
    <div class="calendar-header-card d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-calendar2-week" style="font-size:22px;"></i>
            @php
                // ตัวอย่างแสดงเดือนแบบไทย
                $thaiMonths = [
                    1 => 'มกราคม',
                    2 => 'กุมภาพันธ์',
                    3 => 'มีนาคม',
                    4 => 'เมษายน',
                    5 => 'พฤษภาคม',
                    6 => 'มิถุนายน',
                    7 => 'กรกฎาคม',
                    8 => 'สิงหาคม',
                    9 => 'กันยายน',
                    10 => 'ตุลาคม',
                    11 => 'พฤศจิกายน',
                    12 => 'ธันวาคม',
                ];
                $monthName = $thaiMonths[$current->month] ?? $current->format('F');
                $yearTh = $current->year + 543;
            @endphp
            <div>
                <div class="fw-bold" style="font-size:18px;">
                    ระบบจองห้องประชุม
                </div>
                <div class="text-muted" style="font-size:13px;">
                    {{ $monthName }} {{ $yearTh }}
                </div>
            </div>
        </div>

        {{-- ปุ่มเลื่อนเดือน --}}
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.calendar', ['month' => $current->copy()->subMonth()->format('Y-m')]) }}"
                class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <a href="{{ route('admin.calendar', ['month' => $current->copy()->addMonth()->format('Y-m')]) }}"
                class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-chevron-right"></i>
            </a>

        </div>
    </div>

    <div class="calendar-wrapper">

        {{-- ชื่อวัน --}}
        <div class="calendar-grid mb-1">
            <div class="cal-day-name">จันทร์</div>
            <div class="cal-day-name">อังคาร</div>
            <div class="cal-day-name">พุธ</div>
            <div class="cal-day-name">พฤหัสบดี</div>
            <div class="cal-day-name">ศุกร์</div>
            <div class="cal-day-name">เสาร์</div>
            <div class="cal-day-name">อาทิตย์</div>
        </div>

        {{-- cell แสดงวันที่ --}}
        <div class="calendar-grid">
            @foreach ($weeks as $week)
                @foreach ($week as $day)
                    @php
                        $dateStr = $day->toDateString();
                        $inMonth = $day->month === $current->month;
                        $hasBooking = $bookingsByDate->has($dateStr);
                        $isSelected = $selectedDate === $dateStr;
                    @endphp

                    <a href="{{ route('admin.calendar', [
                        'month' => $current->format('Y-m'),
                        'date' => $dateStr,
                    ]) }}"
                        class="text-decoration-none text-reset">

                        <div
                            class="cal-cell
                        {{ $inMonth ? '' : 'outside-month' }}
                        {{ $hasBooking ? 'has-booking' : '' }}
                        {{ $isSelected ? 'selected' : '' }}">
                            <span class="day-number">{{ $day->format('j') }}</span>

                            @if ($hasBooking)
                                <div class="cal-dot"></div>
                            @endif
                        </div>

                    </a>
                @endforeach
            @endforeach
        </div>
    </div>

    {{-- รายการจองของวันที่คลิก --}}
    <div class="booking-list-card">
        @if ($selectedDate)
            <h6 class="fw-bold mb-3">
                รายการจองวันที่
                {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/') }}
                {{ \Carbon\Carbon::parse($selectedDate)->year + 543 }}
            </h6>

            @if ($selectedBookings && count($selectedBookings))
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr>
                                <th>เวลา</th>
                                <th>ห้องประชุม</th>
                                <th>หัวข้อ</th>
                                <th>ผู้จอง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedBookings as $b)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($b->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($b->end_time)->format('H:i') }}
                                    </td>
                                    <td>{{ $b->room->room_name ?? '-' }}</td>
                                    <td>{{ $b->meeting_topic }}</td>
                                    <td>{{ $b->name }} {{ $b->lastname }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mb-0 text-muted">
                    วันนี้ยังไม่มีการจองห้องประชุม
                </p>
            @endif
        @else
            <p class="mb-0 text-muted">
                กรุณาคลิกวันที่ในปฏิทินเพื่อดูรายละเอียดการจอง
            </p>
        @endif
    </div>
@endsection
