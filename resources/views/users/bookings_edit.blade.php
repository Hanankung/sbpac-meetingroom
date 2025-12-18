@extends('layouts.app')

@section('title', 'แก้ไขการจอง | ระบบจองห้องประชุม ศอ.บต.')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_green.css">

    <style>
        /* ===== Page ===== */
        main {
            background: radial-gradient(1200px 600px at 20% 0%, #eef2ff 0%, transparent 55%),
                radial-gradient(1200px 600px at 85% 10%, #ecfeff 0%, transparent 55%),
                #f5f7fb;
            min-height: 100vh;
        }

        .page-shell {
            max-width: 1100px;
            margin: 0 auto;
            padding: 10px 10px 34px;
        }

        /* ===== Hero Header ===== */
        .hero {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 42%, #eefdf6 100%);
            border: 1px solid rgba(148, 163, 184, .35);
            border-radius: 18px;
            padding: 18px 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
            position: relative;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .hero:before {
            content: "";
            position: absolute;
            inset: -2px;
            background: radial-gradient(600px 200px at 10% 0%, rgba(59, 130, 246, .12), transparent 60%),
                radial-gradient(600px 200px at 95% 0%, rgba(34, 197, 94, .12), transparent 60%);
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .hero-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero-ic {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f3ff;
            border: 1px solid rgba(37, 99, 235, .18);
            color: #2563eb;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .12);
            font-size: 22px;
        }

        .hero-title {
            margin: 0;
            font-weight: 900;
            letter-spacing: .2px;
            color: #0f172a;
            font-size: 20px;
            line-height: 1.2;
        }

        .hero-sub {
            margin: 2px 0 0;
            color: #64748b;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .35rem .75rem;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            background: rgba(255, 255, 255, .72);
            border: 1px solid rgba(148, 163, 184, .45);
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
            backdrop-filter: blur(6px);
        }

        .btn-pill {
            border-radius: 999px !important;
            padding: .42rem .95rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
        }

        .btn-pill.btn-outline-secondary {
            border-color: rgba(148, 163, 184, .6);
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(6px);
        }

        /* ===== Section Cards ===== */
        .section-card {
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(148, 163, 184, .35);
            border-radius: 18px;
            box-shadow: 0 22px 55px rgba(15, 23, 42, .10);
            overflow: hidden;
            margin-bottom: 14px;
        }

        .section-head {
            padding: 14px 16px;
            border-bottom: 1px dashed rgba(148, 163, 184, .45);
            background: linear-gradient(180deg, rgba(248, 250, 252, .9), rgba(255, 255, 255, .6));
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .section-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
            color: #0f172a;
            font-size: 14px;
        }

        .section-ic {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ecfdf5;
            border: 1px solid rgba(34, 197, 94, .20);
            color: #16a34a;
            box-shadow: 0 10px 22px rgba(34, 197, 94, .10);
            font-size: 16px;
        }

        .section-body {
            padding: 16px;
        }

        /* ===== Form Style ===== */
        .form-label {
            font-weight: 800;
            color: #334155;
            font-size: 13px;
            margin-bottom: .35rem;
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, .45);
            padding: .65rem .9rem;
            box-shadow: 0 10px 22px rgba(15, 23, 42, .04);
        }

        .form-control:focus {
            border-color: rgba(34, 197, 94, .65);
            box-shadow: 0 0 0 .22rem rgba(34, 197, 94, .18), 0 10px 22px rgba(15, 23, 42, .06);
        }

        .hint {
            color: #64748b;
            font-size: 12px;
            margin-top: .35rem;
        }

        /* error block */
        .alert-soft-danger {
            border-radius: 14px;
            border: 1px solid rgba(239, 68, 68, .25);
            background: rgba(254, 242, 242, .9);
            color: #991b1b;
            padding: .7rem .9rem;
            font-size: 13px;
            margin: 0;
            box-shadow: 0 12px 26px rgba(239, 68, 68, .08);
        }

        /* submit */
        .submit-bar {
            display: flex;
            justify-content: flex-end;
            margin-top: 8px;
        }

        .btn-submit {
            border-radius: 999px;
            padding: .62rem 1.25rem;
            font-weight: 800;
            box-shadow: 0 18px 40px rgba(34, 197, 94, .18);
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 18px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-shell">

        {{-- ===== Header ===== --}}
        <div class="hero">
            <div class="hero-inner">
                <div class="hero-left">
                    <div class="hero-ic">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h1 class="hero-title">แก้ไขการจองห้องประชุม</h1>
                        <div class="hero-sub">
                            <span class="chip">
                                <i class="bi bi-door-open"></i>
                                ห้อง: {{ $booking->room->room_name ?? '-' }}
                            </span>
                            <span class="chip">
                                <i class="bi bi-hash"></i>
                                รายการ #{{ $booking->id }}
                            </span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-outline-secondary btn-sm btn-pill">
                    <i class="bi bi-arrow-left-short"></i> ย้อนกลับ
                </a>
            </div>
        </div>

        {{-- ===== Form ===== --}}
        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')

            {{-- ข้อมูลผู้ขอใช้ห้อง --}}
            <div class="section-card">
                <div class="section-head">
                    <h2 class="section-title">
                        <span class="section-ic"><i class="bi bi-person-lines-fill"></i></span>
                        ข้อมูลผู้ขอใช้ห้อง
                    </h2>
                    <span class="chip">
                        <i class="bi bi-shield-check"></i> โปรดกรอกข้อมูลให้ครบถ้วน
                    </span>
                </div>

                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $booking->name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" name="lastname" class="form-control"
                                value="{{ old('lastname', $booking->lastname) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">เบอร์โทร</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $booking->phone) }}">
                            <div class="hint">ใส่เฉพาะตัวเลข (ถ้ามี)</div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->has('time'))
                <div class="alert alert-danger py-2 px-3 small mb-3">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    {{ $errors->first('time') }}
                </div>
            @endif
            {{-- ข้อมูลการใช้ห้อง --}}
            <div class="section-card">
                <div class="section-head">
                    <h2 class="section-title">
                        <span class="section-ic"
                            style="background:#e0f2fe;border-color:rgba(14,165,233,.25);color:#0284c7;box-shadow:0 10px 22px rgba(14,165,233,.10);">
                            <i class="bi bi-info-circle"></i>
                        </span>
                        ข้อมูลการใช้ห้อง
                    </h2>
                    <span class="chip">
                        <i class="bi bi-clock"></i> เลือกวัน/เวลาให้ตรงกับการใช้งานจริง
                    </span>
                </div>

                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">วันที่ใช้ห้อง <span class="text-danger">*</span></label>
                            <input type="text" name="booking_date" class="form-control js-date-picker"
                                value="{{ old('booking_date', $booking->booking_date) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">เวลาเริ่ม <span class="text-danger">*</span></label>
                            <input type="text" name="start_time" class="form-control js-time-start"
                                value="{{ old('start_time', $booking->start_time) }}" required>
                            @error('start_time')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">เวลาสิ้นสุด <span class="text-danger">*</span></label>
                            <input type="text" name="end_time" class="form-control js-time-end"
                                value="{{ old('end_time', $booking->end_time) }}" required>
                            @error('end_time')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-12">
                            <label class="form-label">หัวข้อการประชุม <span class="text-danger">*</span></label>
                            <input type="text" name="meeting_topic" class="form-control"
                                value="{{ old('meeting_topic', $booking->meeting_topic) }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">กลุ่มงาน / ส่วนงาน</label>
                            <input type="text" name="department" class="form-control"
                                value="{{ old('department', $booking->department) }}">
                        </div>

                        @error('time')
                            <div class="col-12">
                                <div class="alert-soft-danger">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ปุ่ม --}}
            <div class="submit-bar">
                <button type="submit" class="btn btn-success btn-submit btn-pill">
                    <i class="bi bi-check2-circle"></i>
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
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->has('time'))
                Swal.fire({
                    icon: 'error',
                    title: 'แก้ไขไม่ได้',
                    text: @json($errors->first('time')),
                    confirmButtonText: 'เข้าใจแล้ว'
                });
            @endif
        });
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
