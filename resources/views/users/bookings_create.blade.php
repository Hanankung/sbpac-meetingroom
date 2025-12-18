{{-- resources/views/users/bookings_create.blade.php --}}
@extends('layouts.app')

@section('title', 'จองห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

@push('styles')
    {{-- flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{-- ธีม modern หน่อย --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_green.css">

    <style>
        main {
            background: #f3f4f6;
        }

        /* การ์ด head ด้านบน */
        .page-header-card {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 50%, #ecfdf3 100%);
            border-radius: 18px;
            padding: 18px 22px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid #e5e7eb;
            margin-bottom: 22px;
        }

        .page-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: #111827;
        }

        .room-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            background: #ecfdf3;
            color: #047857;
            font-size: 14px;
            font-weight: 600;
        }

        .page-header-pill {
            background: #111827;
            color: #e5e7eb;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* การ์ด section */
        .booking-section-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px 22px;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
            border: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .booking-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .booking-section-title {
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #111827;
        }

        .booking-section-title i {
            font-size: 18px;
        }

        .booking-section-hint {
            font-size: 12px;
            color: #9ca3af;
        }

        /* label & input */
        .form-label {
            font-size: 15px;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            border-radius: 10px;
            border-color: #e5e7eb;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 0.15rem rgba(34, 197, 94, 0.2);
        }

        /* ปุ่มส่ง */
        .btn-submit-booking {
            border-radius: 999px;
            padding-inline: 32px;
            font-weight: 600;
            font-size: 18px;
            box-shadow: 0 10px 22px rgba(22, 163, 74, 0.3);
        }

        .btn-submit-booking i {
            font-size: 16px;
        }

        /* ปุ่มย้อนกลับ */
        .btn-back-soft {
            border-radius: 999px;
            font-size: 13px;
            padding-inline: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">

        {{-- หัวข้อใหญ่ --}}
        <div class="page-header-card d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                    style="width:40px;height:40px;background:#dcfce7;">
                    <i class="bi bi-calendar2-plus" style="font-size:20px;color:#16a34a;"></i>
                </div>
                <div>
                    <p class="page-title mb-1">จองห้องประชุม</p>
                    <div class="room-chip">
                        <i class="bi bi-door-open"></i>
                        ห้องที่เลือก: {{ $room->room_name }}
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('users.rooms') }}" class="btn btn-outline-secondary btn-sm btn-back-soft">
                    <i class="bi bi-arrow-left-short me-1"></i> ย้อนกลับ
                </a>
            </div>
        </div>

        {{-- ฟอร์มจองห้อง --}}
        <form method="POST" action="{{ route('user.bookings.store', $room->id) }}">
            @csrf

            {{-- ✅ ข้อมูลผู้ขอใช้ห้อง --}}
            <div class="booking-section-card">
                <div class="booking-section-header">
                    <div class="booking-section-title">
                        <i class="bi bi-person-lines-fill text-emerald-500"></i>
                        <span>ข้อมูลผู้ขอใช้ห้อง</span>
                    </div>
                    <div class="booking-section-hint">
                        โปรดกรอกข้อมูลติดต่อให้ครบถ้วน เพื่อให้เจ้าหน้าที่ติดต่อกลับได้หากมีปัญหา
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">นามสกุล <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
                        @error('lastname')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="col-md-6">
                        <label class="form-label">อีเมล</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
            </div>

            {{-- ✅ ข้อมูลการใช้ห้อง + date & time picker ใหม่ --}}
            <div class="booking-section-card">
                <div class="booking-section-header">
                    <div class="booking-section-title">
                        <i class="bi bi-info-circle text-sky-500"></i>
                        <span>ข้อมูลการใช้ห้อง</span>
                    </div>
                    <div class="booking-section-hint">
                        เลือกวันและช่วงเวลาที่ต้องการใช้ห้องให้ชัดเจน เพื่อลดการจองซ้ำซ้อน
                    </div>
                </div>

                <div class="row g-3">
                    {{-- วันที่ใช้ห้อง --}}
                    <div class="col-md-4">
                        <label class="form-label">วันที่ใช้ห้อง <span class="text-danger">*</span></label>
                        <input type="text" name="booking_date" id="booking_date" class="form-control js-date-picker"
                            value="{{ old('booking_date') }}" placeholder="เลือกวันที่" required>
                        @error('booking_date')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- เวลาเริ่ม --}}
                    <div class="col-md-4">
                        <label class="form-label">เวลาเริ่ม <span class="text-danger">*</span></label>
                        <input type="text" name="start_time" id="start_time" class="form-control js-time-start"
                            value="{{ old('start_time') }}" placeholder="เลือกเวลาเริ่ม" required>
                        @error('start_time')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- เวลาสิ้นสุด --}}
                    <div class="col-md-4">
                        <label class="form-label">เวลาสิ้นสุด <span class="text-danger">*</span></label>
                        <input type="text" name="end_time" id="end_time" class="form-control js-time-end"
                            value="{{ old('end_time') }}" placeholder="เลือกเวลาสิ้นสุด" required>
                        @error('end_time')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">หัวข้อการประชุม <span class="text-danger">*</span></label>
                        <input type="text" name="meeting_topic" class="form-control" value="{{ old('meeting_topic') }}"
                            required>
                        @error('meeting_topic')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">กลุ่มงาน / ส่วนงาน</label>
                        <input type="text" name="department" class="form-control"
                            value="{{ old('department', $user->department ?? '') }}" placeholder="กลุ่มงาน / ส่วนงาน">
                        @error('department')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    @error('time')
                        {{-- error จาก logic เช็คเวลาซ้ำ --}}
                        <div class="col-12">
                            <div class="alert alert-danger py-2 px-3 small mb-0">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                </div>
            </div>

            {{-- ปุ่มส่งฟอร์ม --}}
            <div class="d-flex justify-content-end mb-3">
                <button type="submit" class="btn btn-success btn-submit-booking">
                    <i class="bi bi-check2-circle me-1"></i>
                    จองห้องประชุม
                </button>
            </div>
        </form>

    </div>
@endsection

@push('scripts')
    {{-- flatpickr JS + ภาษาไทย (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const pad2 = (n) => String(n).padStart(2,'0');

    // ปัดเวลา "ตอนนี้" ขึ้นเป็นทุก 5 นาที (กันเลือกเวลาย้อนหลังแบบเหลื่อม ๆ)
    function nowRounded5() {
        const d = new Date();
        d.setSeconds(0);
        d.setMilliseconds(0);
        const m = d.getMinutes();
        const add = (5 - (m % 5)) % 5;
        d.setMinutes(m + add);
        return `${pad2(d.getHours())}:${pad2(d.getMinutes())}`;
    }

    const startPicker = flatpickr(".js-time-start", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });

    const endPicker = flatpickr(".js-time-end", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });

    const datePicker = flatpickr(".js-date-picker", {
        locale: "th",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "j F Y",
        minDate: "today",

        onChange: function(selectedDates, dateStr) {
            const todayStr = flatpickr.formatDate(new Date(), "Y-m-d");

            if (dateStr === todayStr) {
                // ถ้าเป็น "วันนี้" -> ห้ามเลือกเวลาเริ่มก่อนตอนนี้
                const minT = nowRounded5();
                startPicker.set('minTime', minT);
                endPicker.set('minTime', minT);
            } else {
                // ถ้าเป็น "อนาคต" -> เลือกได้ทั้งวัน
                startPicker.set('minTime', "00:00");
                endPicker.set('minTime', "00:00");
            }

            // เคลียร์เวลาที่เคยเลือก (กันค้างค่าเดิมที่ผิดเงื่อนไข)
            startPicker.clear();
            endPicker.clear();
        }
    });

    // ถ้าเลือกเวลาเริ่มแล้ว -> บังคับเวลาสิ้นสุดต้องมากกว่าเริ่ม
    startPicker.set('onChange', function(selDates, timeStr){
        if (!timeStr) return;
        endPicker.set('minTime', timeStr);
        // ถ้า end ที่เลือกอยู่ < start -> เคลียร์
        const endVal = document.querySelector('#end_time')?.value;
        if (endVal && endVal <= timeStr) endPicker.clear();
    });

});
</script>

@endpush
