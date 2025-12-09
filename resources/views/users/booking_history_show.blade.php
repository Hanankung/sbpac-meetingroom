@extends('layouts.app')

@section('title', 'รายละเอียดประวัติการจอง | ระบบจองห้องประชุม ศอ.บต.')

@push('styles')
<style>
    main {
        background:#f3f4f6;
    }

    .page-header-card {
        background:#fff;
        border-radius:16px;
        padding:18px 22px;
        box-shadow:0 6px 20px rgba(0,0,0,0.06);
        border:1px solid #e5e7eb;
        margin-bottom:20px;
    }

    .page-title {
        font-size:20px;
        font-weight:700;
        margin:0;
    }

    .detail-card {
        background:#fff;
        border-radius:16px;
        padding:24px 28px;
        border:1px solid #e5e7eb;
        box-shadow:0 8px 24px rgba(0,0,0,0.05);
    }

    .detail-row {
        margin-bottom:14px;
        font-size:14px;
    }

    .detail-label {
        font-weight:700;
        color:#374151;
        min-width:120px;
        display:inline-block;
    }
</style>
@endpush

@section('content')

    <div class="page-header-card d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-clock-history" style="font-size:22px;"></i>
            <span class="page-title">รายละเอียดประวัติการจอง</span>
        </div>

        <a href="{{ route('bookings.history') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-short me-1"></i> ย้อนกลับ
        </a>
    </div>

    <div class="detail-card">

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="detail-row">
                    <span class="detail-label">ชื่อ - สกุล :</span>
                    {{ $booking->name }} {{ $booking->lastname }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">วันที่จอง :</span>
                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">ห้องที่ใช้ :</span>
                    {{ $booking->room->room_name ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-row">
                    <span class="detail-label">เบอร์โทรศัพท์ :</span>
                    {{ $booking->phone ?? '-' }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">อีเมล :</span>
                    {{ $booking->email ?? '-' }}
                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="detail-row">
                    <span class="detail-label">วันที่ใช้ห้อง :</span>
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">เวลา :</span>
                    {{ $booking->start_time }} - {{ $booking->end_time }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-row">
                    <span class="detail-label">หัวข้อการประชุม :</span>
                    {{ $booking->meeting_topic }}
                </div>
                <div class="detail-row">
                    <span class="detail-label">กลุ่มงาน / ส่วนงาน :</span>
                    {{ $booking->department ?? '-' }}
                </div>
            </div>
        </div>

    </div>

@endsection
