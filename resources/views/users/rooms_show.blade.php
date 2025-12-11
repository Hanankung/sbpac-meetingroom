{{-- resources/views/users/rooms_show.blade.php --}}
@extends('layouts.app')

@section('title', 'รายละเอียดห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')
<link rel="icon" type="image/png" href="{{ asset('image/sbpac-logo.jpg') }}?v=2">

@push('styles')
<style>
    main {
        background: #f5f5f7;
    }

    .room-show-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    .room-breadcrumb {
        font-size: 13px;
        color: #9ca3af;
    }

    .room-breadcrumb a {
        color: #6b7280;
        text-decoration: none;
    }

    .room-breadcrumb a:hover {
        text-decoration: underline;
    }

    .room-header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        margin-top: 4px;
    }

    .room-header-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .room-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e5f4ff;
        color: #0d6efd;
        font-size: 20px;
    }

    .room-header-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .room-header-sub {
        font-size: 13px;
        color: #9ca3af;
        margin: 0;
    }

    .room-back-btn {
        border-radius: 999px;
        font-size: 13px;
        padding-inline: 18px;
    }

    .room-main-card {
        border-radius: 18px;
        border: 0;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        background: #ffffff;
    }

    .room-main-image {
        min-height: 280px;
        height: 100%;
        object-fit: cover;
    }

    .room-image-placeholder {
        min-height: 280px;
        border-right: 1px solid #e5e7eb;
    }

    .room-chip-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .room-chip {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f3f4f6;
        color: #4b5563;
    }

    .room-chip--primary {
        background: #e5f4ff;
        color: #0369a1;
    }

    .room-title-main {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .room-meta {
        font-size: 13px;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
    }

    .room-description {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.6;
        margin-top: 12px;
        margin-bottom: 20px;
    }

    .room-info-box {
        background: #f9fafb;
        border-radius: 12px;
        padding: 10px 12px;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 18px;
    }

    .room-info-box strong {
        color: #374151;
    }

    .room-cta-row {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        align-items: center;
    }

    .btn-room-book {
        border-radius: 999px;
        padding-inline: 26px;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(22, 163, 74, 0.35);
    }

    .btn-room-secondary {
        border-radius: 999px;
        padding-inline: 18px;
        font-size: 13px;
    }

    @media (max-width: 992px) {
        .room-main-image,
        .room-image-placeholder {
            border-right: none !important;
            border-bottom: 1px solid #e5e7eb;
        }
    }
</style>
@endpush

@section('content')
<div class="room-show-wrapper">

    {{-- breadcrumb เล็ก ๆ --}}
    <div class="room-breadcrumb mb-1">
        <a href="{{ route('users.rooms') }}">ห้องประชุมทั้งหมด</a>
        <span class="mx-1">/</span>
        <span>{{ $room->room_name }}</span>
    </div>

    {{-- หัวข้อ + ปุ่มย้อนกลับ --}}
    <div class="room-header-bar">
        <div class="room-header-left">
            <div class="room-header-icon">
                <i class="bi bi-door-open"></i>
            </div>
            <div>
                <p class="room-header-title mb-0">รายละเอียดห้องประชุม</p>
                <p class="room-header-sub mb-0">ดูข้อมูลห้องก่อนทำการจอง</p>
            </div>
        </div>

        <a href="{{ route('users.rooms') }}" class="btn btn-outline-secondary btn-sm room-back-btn">
            <i class="bi bi-arrow-left-short me-1"></i> ย้อนกลับ
        </a>
    </div>

    <div class="card room-main-card">
        <div class="row g-0">
            {{-- รูปห้อง --}}
            <div class="col-lg-6">
                @if($room->room_image)
                    <img src="{{ asset($room->room_image) }}"
                         alt="{{ $room->room_name }}"
                         class="room-main-image w-100">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light room-image-placeholder">
                        <span class="text-muted">ไม่มีภาพห้อง</span>
                    </div>
                @endif
            </div>

            {{-- ข้อมูลรายละเอียด --}}
            <div class="col-lg-6">
                <div class="card-body">

                    {{-- chips ด้านบน --}}
                    <div class="room-chip-row">
                        <div class="room-chip room-chip--primary">
                            <i class="bi bi-building"></i>
                            <span>อาคาร {{ $room->building ?: '-' }}</span>
                        </div>
                        <div class="room-chip">
                            <i class="bi bi-people-fill"></i>
                            <span>{{ $room->quantity ?? 0 }} คน/ห้อง</span>
                        </div>
                    </div>

                    <h3 class="room-title-main">{{ $room->room_name }}</h3>

                    {{-- meta เล็ก ๆ --}}
                    <div class="room-meta">
                        <i class="bi bi-info-circle"></i>
                        ข้อมูลห้องประชุมสำหรับการใช้งานของหน่วยงาน
                    </div>

                    {{-- รายละเอียด --}}
                    @if($room->description)
                        <p class="room-description">
                            {{ $room->description }}
                        </p>
                    @else
                        <p class="room-description text-muted">
                            ยังไม่ได้ระบุรายละเอียดเพิ่มเติมสำหรับห้องนี้
                        </p>
                    @endif

                    {{-- กล่องสรุปข้อมูลย่อย (จะปรับข้อความเพิ่มเองก็ได้) --}}
                    <div class="room-info-box">
                        <strong>สรุปห้อง:</strong>
                        รองรับประมาณ {{ $room->quantity ?? 0 }} คน
                        @if($room->building)
                            , ตั้งอยู่ที่อาคาร {{ $room->building }}
                        @endif
                        เหมาะสำหรับการประชุม งานอบรม หรือกิจกรรมภายในหน่วยงาน
                    </div>

                    {{-- ปุ่มจอง --}}
                    <div class="room-cta-row">
                        <a href="{{ route('user.bookings.create', $room->id) }}"
                           class="btn btn-success btn-room-book">
                            จองห้องนี้
                        </a>
                        <button type="button"
                                class="btn btn-outline-secondary btn-room-secondary"
                                onclick="history.back()">
                            กลับไปหน้าก่อนหน้า
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
