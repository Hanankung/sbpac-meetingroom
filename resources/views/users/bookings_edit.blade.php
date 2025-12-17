@extends('layouts.app')

@section('title', 'แก้ไขการจอง | ระบบจองห้องประชุม ศอ.บต.')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_green.css">

<style>
    main { background:#f3f4f6; }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="page-header-card d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <p class="page-title mb-1">แก้ไขการจองห้องประชุม</p>
            <div class="room-chip">
                <i class="bi bi-door-open"></i>
                ห้อง: {{ $booking->room->room_name ?? '-' }}
            </div>
        </div>

        <a href="{{ route('bookings.show', $booking->id) }}"
           class="btn btn-outline-secondary btn-sm btn-back-soft">
            <i class="bi bi-arrow-left-short me-1"></i> ย้อนกลับ
        </a>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
        @csrf
        @method('PUT')

        {{-- ข้อมูลผู้ขอใช้ห้อง --}}
        <div class="booking-section-card">
            <div class="booking-section-title mb-3">
                <i class="bi bi-person-lines-fill text-emerald-500"></i>
                ข้อมูลผู้ขอใช้ห้อง
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">ชื่อ *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $booking->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">นามสกุล *</label>
                    <input type="text" name="lastname" class="form-control"
                           value="{{ old('lastname', $booking->lastname) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">เบอร์โทร</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $booking->phone) }}">
                </div>
            </div>
        </div>

        {{-- ข้อมูลการใช้ห้อง --}}
        <div class="booking-section-card">
            <div class="booking-section-title mb-3">
                <i class="bi bi-info-circle text-sky-500"></i>
                ข้อมูลการใช้ห้อง
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">วันที่ใช้ห้อง *</label>
                    <input type="text"
                           name="booking_date"
                           class="form-control js-date-picker"
                           value="{{ old('booking_date', $booking->booking_date) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">เวลาเริ่ม *</label>
                    <input type="text"
                           name="start_time"
                           class="form-control js-time-start"
                           value="{{ old('start_time', $booking->start_time) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">เวลาสิ้นสุด *</label>
                    <input type="text"
                           name="end_time"
                           class="form-control js-time-end"
                           value="{{ old('end_time', $booking->end_time) }}"
                           required>
                </div>

                <div class="col-12">
                    <label class="form-label">หัวข้อการประชุม *</label>
                    <input type="text"
                           name="meeting_topic"
                           class="form-control"
                           value="{{ old('meeting_topic', $booking->meeting_topic) }}"
                           required>
                </div>

                <div class="col-12">
                    <label class="form-label">กลุ่มงาน / ส่วนงาน</label>
                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department', $booking->department) }}">
                </div>

                @error('time')
                    <div class="col-12">
                        <div class="alert alert-danger py-2 px-3 small mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            </div>
        </div>

        {{-- ปุ่ม --}}
        <div class="d-flex justify-content-end mb-3">
            <button type="submit" class="btn btn-success btn-submit-booking">
                <i class="bi bi-check2-circle me-1"></i>
                บันทึกการแก้ไข
            </button>
        </div>
    </form>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

<script>
    flatpickr(".js-date-picker", {
        locale: "th",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "j F Y",
        minDate: "today",
    });

    flatpickr(".js-time-start", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });

    flatpickr(".js-time-end", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
</script>
@endpush
