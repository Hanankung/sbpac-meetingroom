{{-- resources/views/users/booking_history_show.blade.php --}}
@extends('layouts.app')

@section('title', 'รายละเอียดประวัติการจอง | ระบบจองห้องประชุม ศอ.บต.')
<link rel="icon" type="image/png" href="{{ asset('image/cropped-logo.png') }}?v=2">

@push('styles')
<style>
    /* ===== Page ===== */
    main{
        background: radial-gradient(1200px 600px at 20% 0%, #eef2ff 0%, transparent 55%),
                    radial-gradient(1200px 600px at 85% 10%, #ecfeff 0%, transparent 55%),
                    #f5f7fb;
        min-height: 100vh;
    }

    .page-shell{
        max-width: 1100px;
        margin: 0 auto;
        padding: 10px 10px 32px;
    }

    /* ===== Header Card ===== */
    .hero{
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 40%, #eefdf6 100%);
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 18px;
        padding: 18px 18px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        position: relative;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .hero:before{
        content:"";
        position:absolute;
        inset:-2px;
        background: radial-gradient(600px 200px at 10% 0%, rgba(59,130,246,.12), transparent 60%),
                    radial-gradient(600px 200px at 95% 0%, rgba(34,197,94,.12), transparent 60%);
        pointer-events:none;
    }
    .hero-inner{
        position: relative;
        display:flex;
        align-items:center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }

    .hero-left{
        display:flex;
        align-items:center;
        gap: 12px;
    }
    .hero-ic{
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: #e8f3ff;
        border: 1px solid rgba(37, 99, 235, .18);
        color: #2563eb;
        box-shadow: 0 10px 22px rgba(37,99,235,.12);
        font-size: 22px;
    }
    .hero-title{
        margin:0;
        font-weight: 800;
        letter-spacing: .2px;
        color:#0f172a;
        font-size: 20px;
        line-height: 1.2;
    }
    .hero-sub{
        margin: 2px 0 0;
        color:#64748b;
        font-size: 13px;
    }

    .btn-pill{
        border-radius: 999px !important;
        padding: .42rem .95rem;
        font-weight: 600;
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

    /* ===== Main Card ===== */
    .card-premium{
        background: rgba(255,255,255,.88);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 18px;
        box-shadow: 0 22px 55px rgba(15,23,42,.10);
        overflow: hidden;
    }

    .card-head{
        padding: 16px 18px;
        border-bottom: 1px dashed rgba(148,163,184,.45);
        display:flex;
        align-items:center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        background: linear-gradient(180deg, rgba(248,250,252,.9), rgba(255,255,255,.6));
    }

    .badge-soft{
        display:inline-flex;
        align-items:center;
        gap:.4rem;
        padding: .35rem .7rem;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        color:#0f172a;
        background: #f1f5f9;
        border: 1px solid rgba(148,163,184,.45);
    }

    .card-body-premium{
        padding: 18px;
    }

    /* ===== Info Blocks ===== */
    .section{
        padding: 14px;
        border-radius: 16px;
        border: 1px solid rgba(226,232,240,.9);
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        box-shadow: 0 10px 26px rgba(15,23,42,.06);
    }

    .section-title{
        display:flex;
        align-items:center;
        gap: 8px;
        margin: 0 0 12px 0;
        font-weight: 800;
        color:#0f172a;
        font-size: 14px;
    }

    .kv{
        display:flex;
        gap: 10px;
        padding: 10px 10px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid rgba(226,232,240,.9);
        margin-bottom: 10px;
    }
    .kv:last-child{ margin-bottom: 0; }

    .k{
        min-width: 135px;
        font-weight: 800;
        color:#334155;
        display:flex;
        align-items:center;
        gap: 8px;
        font-size: 13px;
    }
    .k .dot{
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #22c55e;
        box-shadow: 0 0 0 3px rgba(34,197,94,.18);
        flex: 0 0 auto;
    }

    .v{
        color:#0f172a;
        font-weight: 650;
        font-size: 13px;
        flex: 1 1 auto;
        word-break: break-word;
    }

    .divider-soft{
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(148,163,184,.55), transparent);
        margin: 14px 0;
    }

    @media (max-width: 576px){
        .k{ min-width: 115px; }
        .hero-title{ font-size: 18px; }
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
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <h1 class="hero-title">รายละเอียดประวัติการจอง</h1>
                    <p class="hero-sub">ดูข้อมูลการจองแบบละเอียด และสามารถแก้ไขรายการได้</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('bookings.history') }}" class="btn btn-outline-secondary btn-sm btn-pill">
                    <i class="bi bi-arrow-left-short"></i> ย้อนกลับ
                </a>
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-success btn-sm btn-pill">
                    <i class="bi bi-pencil-square"></i> แก้ไข
                </a>
            </div>
        </div>
    </div>

    {{-- ===== Content Card ===== --}}
    <div class="card-premium">
        <div class="card-head">
            <span class="badge-soft">
                <i class="bi bi-calendar2-check"></i>
                รายการ #{{ $booking->id }}
            </span>

            <span class="badge-soft">
                <i class="bi bi-clock"></i>
                วันที่จอง: {{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}
            </span>
        </div>

        <div class="card-body-premium">
            <div class="row g-3">
                {{-- ผู้จอง --}}
                <div class="col-lg-6">
                    <div class="section h-100">
                        <div class="section-title">
                            <i class="bi bi-person-badge"></i> ข้อมูลผู้จอง
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span>ชื่อ - สกุล</div>
                            <div class="v">{{ $booking->name }} {{ $booking->lastname }}</div>
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span>เบอร์โทรศัพท์</div>
                            <div class="v">{{ $booking->phone ?? '-' }}</div>
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span>กลุ่มงาน/ส่วนงาน</div>
                            <div class="v">{{ $booking->department ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                {{-- รายละเอียดการใช้ห้อง --}}
                <div class="col-lg-6">
                    <div class="section h-100">
                        <div class="section-title">
                            <i class="bi bi-building"></i> รายละเอียดการใช้ห้อง
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span>ห้องที่ใช้</div>
                            <div class="v">{{ $booking->room->room_name ?? '-' }}</div>
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span>วันที่ใช้ห้อง</div>
                            <div class="v">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</div>
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span>เวลา</div>
                            <div class="v">{{ $booking->start_time }} - {{ $booking->end_time }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider-soft"></div>

            {{-- หัวข้อการประชุม --}}
            <div class="section">
                <div class="section-title">
                    <i class="bi bi-chat-square-text"></i> หัวข้อการประชุม
                </div>

                <div class="kv" style="margin-bottom:0;">
                    <div class="k"><span class="dot"></span>หัวข้อ</div>
                    <div class="v">{{ $booking->meeting_topic ?: '-' }}</div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
