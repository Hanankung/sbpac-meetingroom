{{-- resources/views/users/rooms_show.blade.php --}}
@extends('layouts.app')

@section('title', 'รายละเอียดห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')
<link rel="icon" type="image/png" href="{{ asset('image/cropped-logo.png') }}?v=2">

@push('styles')
<style>
    /* ===== Page ===== */
    main{
        background: radial-gradient(1200px 600px at 15% 0%, #ffffff 0%, transparent 55%),
                    radial-gradient(1200px 600px at 88% 8%, #ffffff 0%, transparent 55%),
                    #ffffff;
        min-height: 100vh;
    }
    .room-show-wrapper{
        max-width: 1100px;
        margin: 0 auto;
        padding: 10px 10px 34px;
    }

    /* ===== Breadcrumb ===== */
    .room-breadcrumb{
        font-size: 12.5px;
        color: #94a3b8;
        margin-bottom: 6px;
    }
    .room-breadcrumb a{
        color:#64748b;
        text-decoration:none;
        font-weight: 700;
    }
    .room-breadcrumb a:hover{ text-decoration: underline; }

    /* ===== Hero header ===== */
    .hero{
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 40%, #eefdf6 100%);
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 18px;
        padding: 16px 16px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        position: relative;
        overflow: hidden;
        margin-bottom: 14px;
    }
    .hero:before{
        content:"";
        position:absolute;
        inset:-2px;
        background: radial-gradient(600px 220px at 10% 0%, rgb(255, 255, 255), transparent 60%),
                    radial-gradient(600px 220px at 95% 0%, rgb(255, 255, 255), transparent 60%);
        pointer-events:none;
    }
    .hero-inner{
        position: relative;
        display:flex;
        justify-content: space-between;
        align-items:center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .hero-left{
        display:flex;
        align-items:center;
        gap: 12px;
    }
    .hero-ic{
        width: 44px; height: 44px;
        border-radius: 14px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#e5f4ff;
        border: 1px solid rgba(37, 99, 235, .18);
        color:#2563eb;
        box-shadow: 0 10px 22px rgba(37,99,235,.12);
        font-size: 20px;
    }
    .hero-title{
        margin:0;
        font-size: 18px;
        font-weight: 900;
        color:#0f172a;
        letter-spacing: .2px;
        line-height: 1.2;
    }
    .hero-sub{
        margin: 2px 0 0;
        color:#64748b;
        font-size: 13px;
    }

    .btn-pill{
        border-radius: 999px !important;
        padding: .44rem .95rem;
        font-weight: 800;
        display:inline-flex;
        align-items:center;
        gap:.35rem;
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
    }
    .btn-pill.btn-outline-secondary{
        border-color: rgba(148,163,184,.6);
        background: rgba(255,255,255,.75);
        backdrop-filter: blur(6px);
    }

    /* ===== Main card ===== */
    .room-main-card{
        border-radius: 18px;
        border: 1px solid rgba(148,163,184,.35);
        overflow: hidden;
        box-shadow: 0 22px 55px rgba(15, 23, 42, .10);
        background: rgba(255,255,255,.88);
        backdrop-filter: blur(8px);
    }

    /* ===== Image side ===== */
    .img-wrap{
        position: relative;
        min-height: 320px;
        height: 100%;
        background: #eef2f7;
    }
    .room-main-image{
        width: 100%;
        height: 100%;
        min-height: 320px;
        object-fit: cover;
        display:block;
    }
    .room-image-placeholder{
        min-height: 320px;
        border-right: 1px solid rgba(226,232,240,.9);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .img-overlay{
        position:absolute;
        inset:0;
        background: linear-gradient(180deg, rgba(2,6,23,0) 35%, rgba(2,6,23,.70) 100%);
        pointer-events:none;
    }
    .img-badges{
        position:absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        display:flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .badge-soft{
        display:inline-flex;
        align-items:center;
        gap:.45rem;
        padding: .35rem .75rem;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        color:#0f172a;
        background: rgba(255,255,255,.78);
        border: 1px solid rgba(148,163,184,.45);
        box-shadow: 0 10px 24px rgba(15,23,42,.08);
        backdrop-filter: blur(8px);
        white-space: nowrap;
    }
    .badge-soft--cap{
        background: rgba(250,204,21,.95);
        border-color: rgba(250,204,21,.55);
    }
    .img-bottom{
        position:absolute;
        left: 14px;
        right: 14px;
        bottom: 14px;
        color:#fff;
        display:flex;
        align-items:flex-end;
        justify-content: space-between;
        gap: 10px;
    }
    .img-title{
        margin:0;
        font-weight: 950;
        font-size: 18px;
        text-shadow: 0 10px 26px rgba(0,0,0,.35);
    }
    .img-sub{
        margin: 4px 0 0;
        font-size: 12px;
        color: rgba(255,255,255,.78);
        display:flex;
        align-items:center;
        gap:.45rem;
    }

    /* ===== Content side ===== */
    .card-body{
        padding: 16px 16px 18px;
    }

    .room-chip-row{
        display:flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }
    .room-chip{
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        display:inline-flex;
        align-items:center;
        gap: 8px;
        background: rgba(255,255,255,.72);
        border: 1px solid rgba(148,163,184,.45);
        color:#334155;
        font-weight: 900;
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
        backdrop-filter: blur(6px);
    }
    .room-chip--primary{
        background: rgba(37,99,235,.08);
        border-color: rgba(37,99,235,.18);
        color:#1d4ed8;
    }

    .room-title-main{
        font-size: 20px;
        font-weight: 950;
        margin-bottom: 6px;
        color:#0f172a;
    }
    .room-meta{
        font-size: 13px;
        color:#64748b;
        display:flex;
        align-items:center;
        gap: 6px;
        margin-bottom: 10px;
    }

    .room-description{
        font-size: 14px;
        color:#334155;
        line-height: 1.7;
        margin-top: 8px;
        margin-bottom: 14px;
        white-space: pre-line;
    }

    .room-info-box{
        background: linear-gradient(135deg, rgb(255, 255, 255), rgb(255, 255, 255));
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 16px;
        padding: 12px 12px;
        font-size: 13px;
        color:#334155;
        margin-bottom: 16px;
        box-shadow: 0 14px 30px rgba(15,23,42,.06);
    }
    .room-info-box strong{
        color:#0f172a;
        font-weight: 950;
    }

    .room-cta-row{
        display:flex;
        gap: 10px;
        align-items:center;
        flex-wrap: wrap;
    }
    .btn-room-book{
        border-radius: 999px;
        padding: .62rem 1.2rem;
        font-weight: 900;
        box-shadow: 0 18px 40px rgba(22,163,74,.22);
        display:inline-flex;
        align-items:center;
        gap:.45rem;
    }
    .btn-room-secondary{
        border-radius: 999px;
        padding: .62rem 1.05rem;
        font-weight: 800;
        border-color: rgba(148,163,184,.55) !important;
        background: rgba(255,255,255,.75);
    }

    @media (max-width: 992px){
        .room-main-image, .room-image-placeholder{
            border-right: none !important;
            border-bottom: 1px solid rgba(226,232,240,.9);
            min-height: 280px;
        }
        .img-wrap{ min-height: 280px; }
    }
</style>
@endpush

@section('content')
<div class="room-show-wrapper">

    {{-- breadcrumb --}}
    <div class="room-breadcrumb">
        <a href="{{ route('users.rooms') }}">ห้องประชุมทั้งหมด</a>
        <span class="mx-1">/</span>
        <span>{{ $room->room_name }}</span>
    </div>

    {{-- hero header --}}
    <div class="hero">
        <div class="hero-inner">
            <div class="hero-left">
                <div class="hero-ic"><i class="bi bi-door-open"></i></div>
                <div>
                    <p class="hero-title mb-0">รายละเอียดห้องประชุม</p>
                    <p class="hero-sub mb-0">ดูข้อมูลห้องก่อนทำการจอง</p>
                </div>
            </div>

            <a href="{{ route('users.rooms') }}" class="btn btn-outline-secondary btn-sm btn-pill">
                <i class="bi bi-arrow-left-short"></i> ย้อนกลับ
            </a>
        </div>
    </div>

    {{-- main card --}}
    <div class="card room-main-card">
        <div class="row g-0">

            {{-- image --}}
            <div class="col-lg-6">
                <div class="img-wrap">
                    @if ($room->room_image)
                        <img src="{{ asset($room->room_image) }}" alt="{{ $room->room_name }}" class="room-main-image">
                    @else
                        <div class="room-image-placeholder">
                            <span class="text-muted fw-semibold">ไม่มีภาพห้อง</span>
                        </div>
                    @endif

                    <div class="img-overlay"></div>

                    {{-- top badges --}}
                    <div class="img-badges">
                        <span class="badge-soft">
                            <i class="bi bi-building"></i>
                            {{ $room->building ?: 'ไม่ระบุอาคาร' }}
                        </span>
                        <span class="badge-soft badge-soft--cap">
                            <i class="bi bi-people-fill"></i>
                            {{ $room->quantity ?? 0 }} คน/ห้อง
                        </span>
                    </div>

                    {{-- bottom title --}}
                    <div class="img-bottom">
                        <div>
                            <div class="img-title">{{ $room->room_name }}</div>
                            <div class="img-sub">
                                <i class="bi bi-info-circle"></i>
                                <span>ข้อมูลห้องประชุมสำหรับการใช้งานของหน่วยงาน</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- content --}}
            <div class="col-lg-6">
                <div class="card-body">

                    {{-- chips --}}
                    <div class="room-chip-row">
                        <div class="room-chip room-chip--primary">
                            <i class="bi bi-pin-map"></i>
                            <span>อาคาร {{ $room->building ?: '-' }}</span>
                        </div>
                        <div class="room-chip">
                            <i class="bi bi-people-fill"></i>
                            <span>{{ $room->quantity ?? 0 }} คน/ห้อง</span>
                        </div>
                    </div>

                    <h3 class="room-title-main">{{ $room->room_name }}</h3>

                    <div class="room-meta">
                        <i class="bi bi-shield-check"></i>
                        ข้อมูลห้องสำหรับการจองและการใช้งานภายในหน่วยงาน
                    </div>

                    {{-- description --}}
                    @if ($room->description)
                        <p class="room-description">{{ $room->description }}</p>
                    @else
                        <p class="room-description text-muted mb-2">ยังไม่ได้ระบุรายละเอียดเพิ่มเติมสำหรับห้องนี้</p>
                    @endif

                    {{-- summary box --}}
                    <div class="room-info-box">
                        <strong>สรุปห้อง:</strong>
                        รองรับประมาณ {{ $room->quantity ?? 0 }} คน
                        @if ($room->building)
                            , ตั้งอยู่ที่อาคาร {{ $room->building }}
                        @endif
                        เหมาะสำหรับการประชุม งานอบรม หรือกิจกรรมภายในหน่วยงาน
                    </div>

                    {{-- buttons --}}
                    <div class="room-cta-row">
                        @auth
                            <a href="{{ route('user.bookings.create', $room->id) }}" class="btn btn-success btn-room-book">
                                <i class="bi bi-calendar2-plus"></i> จองห้องนี้
                            </a>
                        @else
                            <a href="{{ route('user.login') }}" class="btn btn-success btn-room-book">
                                <i class="bi bi-calendar2-plus"></i> จองห้องนี้
                            </a>
                        @endauth

                        <button type="button" class="btn btn-outline-secondary btn-room-secondary"
                                onclick="history.back()">
                            <i class="bi bi-arrow-left"></i> กลับไปหน้าก่อนหน้า
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
