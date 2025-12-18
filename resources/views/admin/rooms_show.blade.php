{{-- resources/views/admin/rooms_show.blade.php --}}
@extends('admin.layout')

@section('title', 'รายละเอียดห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

@push('styles')
<style>
    /* ===== Page ===== */
    main{
        background: radial-gradient(1200px 600px at 15% 0%, #ffffff 0%, transparent 55%),
                    radial-gradient(1200px 600px at 88% 8%, #ffffff 0%, transparent 55%),
                    #ffffff;
        min-height: 100vh;
    }
    .page-shell{
        max-width: 1200px;
        margin: 0 auto;
        padding: 12px 10px 34px;
    }

    /* ===== Hero ===== */
    .hero{
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 40%, #eefdf6 100%);
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 18px;
        padding: 18px 18px;
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
        width: 46px; height: 46px;
        border-radius: 14px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: #e8f3ff;
        border: 1px solid rgb(255, 255, 255);
        color: #2563eb;
        box-shadow: 0 10px 22px rgba(255, 255, 255, 0.12);
        font-size: 22px;
    }
    .hero-title{
        margin:0;
        font-weight: 900;
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

    /* ===== Main Card ===== */
    .room-card{
        background: rgba(255,255,255,.88);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 18px;
        box-shadow: 0 22px 55px rgba(15,23,42,.10);
        overflow: hidden;
    }

    /* ===== Image side ===== */
    .img-wrap{
        position: relative;
        height: 100%;
        min-height: 320px;
        background: #eef2f7;
    }
    .img-wrap img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display:block;
    }
    .img-overlay{
        position:absolute;
        inset:0;
        background: linear-gradient(180deg, rgba(2,6,23,0) 35%, rgba(2,6,23,.70) 100%);
        pointer-events:none;
    }
    .img-bottom{
        position:absolute;
        left: 14px;
        right: 14px;
        bottom: 14px;
        display:flex;
        align-items:flex-end;
        justify-content: space-between;
        gap: 10px;
        color: #fff;
    }
    .img-title{
        font-weight: 900;
        font-size: 18px;
        margin: 0;
        line-height: 1.2;
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
    .chip-dark{
        display:inline-flex;
        align-items:center;
        gap:.4rem;
        padding: .35rem .75rem;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        color:#0f172a;
        background: rgba(250,204,21,.95); /* warning-ish */
        border: 1px solid rgba(250,204,21,.55);
        box-shadow: 0 14px 30px rgba(2,6,23,.18);
        white-space: nowrap;
    }

    /* ===== Info side ===== */
    .info{
        padding: 16px 16px 18px;
        height: 100%;
        display:flex;
        flex-direction: column;
    }
    .info-top{
        margin-bottom: 10px;
    }
    .name{
        margin:0;
        font-weight: 950;
        color:#0f172a;
        font-size: 18px;
    }
    .tags{
        margin-top: 8px;
        display:flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .tag{
        display:inline-flex;
        align-items:center;
        gap:.4rem;
        padding: .35rem .75rem;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        color:#0f172a;
        background: rgba(255,255,255,.72);
        border: 1px solid rgba(148,163,184,.45);
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
        backdrop-filter: blur(6px);
    }

    .kv-list{
        margin-top: 8px;
        display:flex;
        flex-direction: column;
        gap: 10px;
    }
    .kv{
        display:flex;
        gap: 12px;
        align-items:flex-start;
        padding: 10px 12px;
        border-radius: 14px;
        background: #f8fafc;
        border: 1px solid rgba(226,232,240,.9);
        box-shadow: 0 10px 24px rgba(15,23,42,.04);
    }
    .k{
        min-width: 130px;
        font-size: 12px;
        font-weight: 900;
        color:#334155;
        display:flex;
        align-items:center;
        gap: 8px;
    }
    .k .dot{
        width: 8px; height: 8px;
        border-radius: 999px;
        background:#22c55e;
        box-shadow: 0 0 0 3px rgba(34,197,94,.18);
        flex: 0 0 auto;
    }
    .v{
        flex: 1 1 auto;
        font-weight: 700;
        font-size: 13px;
        color:#0f172a;
        word-break: break-word;
    }

    .desc{
        margin-top: 12px;
        padding: 12px 12px;
        border-radius: 14px;
        border: 1px solid rgba(226,232,240,.9);
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        box-shadow: 0 12px 26px rgba(15,23,42,.06);
    }
    .desc-head{
        font-size: 12px;
        font-weight: 950;
        color:#334155;
        display:flex;
        align-items:center;
        gap: 8px;
        margin-bottom: 6px;
    }
    .desc p{
        margin:0;
        color:#334155;
        font-weight: 650;
        font-size: 13px;
        white-space: pre-line;
    }
    .desc .empty{
        color:#64748b;
        font-style: italic;
        font-weight: 700;
        font-size: 13px;
        margin: 0;
    }

    .actions{
        margin-top: auto;
        display:flex;
        gap: 10px;
        padding-top: 14px;
    }
    .btn-warning.btn-pill{
        box-shadow: 0 18px 40px rgba(245,158,11,.20);
        font-weight: 900;
    }
    .btn-outline-danger.btn-pill{
        border-color: rgba(239,68,68,.35) !important;
        background: rgba(255,255,255,.75);
        font-weight: 900;
    }

    @media (max-width: 576px){
        .k{ min-width: 110px; }
        .img-wrap{ min-height: 260px; }
        .hero-title{ font-size: 18px; }
    }
</style>
@endpush

@section('content')
<div class="page-shell">

    {{-- ===== Header + Back ===== --}}
    <div class="hero">
        <div class="hero-inner">
            <div class="hero-left">
                <div class="hero-ic"><i class="bi bi-door-open-fill"></i></div>
                <div>
                    <h5 class="hero-title">รายละเอียดห้องประชุม</h5>
                    <div class="hero-sub">ดูข้อมูลห้องประชุมและจัดการได้จากหน้านี้</div>
                </div>
            </div>

            <a href="{{ route('admin.rooms') }}" class="btn btn-outline-secondary btn-sm btn-pill">
                <i class="bi bi-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>

    {{-- ===== Room Card ===== --}}
    <div class="room-card">
        <div class="row g-0">

            {{-- Image --}}
            <div class="col-lg-7">
                <div class="img-wrap">
                    @if($room->room_image)
                        <img src="{{ asset($room->room_image) }}" alt="{{ $room->room_name }}">
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <div class="text-muted fw-semibold">ไม่มีภาพห้อง</div>
                        </div>
                    @endif

                    <div class="img-overlay"></div>

                    <div class="img-bottom">
                        <div>
                            <div class="img-title">{{ $room->room_name }}</div>
                            <div class="img-sub">
                                <i class="bi bi-building"></i>
                                <span>{{ $room->building ?: 'ไม่ระบุอาคาร' }}</span>
                            </div>
                        </div>

                        <span class="chip-dark">
                            <i class="bi bi-people-fill"></i>
                            {{ $room->quantity ?? 0 }} ที่นั่ง
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-5">
                <div class="info">

                    <div class="info-top">
                        <h5 class="name">{{ $room->room_name }}</h5>
                        <div class="tags">
                            <span class="tag"><i class="bi bi-building"></i> {{ $room->building ?: 'ไม่ระบุอาคาร' }}</span>
                            <span class="tag"><i class="bi bi-people-fill"></i> {{ $room->quantity ?? 0 }} คน/ห้อง</span>
                            <span class="tag"><i class="bi bi-hash"></i> ID: {{ $room->id }}</span>
                        </div>
                    </div>

                    <div class="kv-list">
                        <div class="kv">
                            <div class="k"><span class="dot"></span><i class="bi bi-door-open"></i> ชื่อห้อง</div>
                            <div class="v">{{ $room->room_name }}</div>
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span><i class="bi bi-building"></i> อาคาร</div>
                            <div class="v">{{ $room->building ?: '-' }}</div>
                        </div>

                        <div class="kv">
                            <div class="k"><span class="dot"></span><i class="bi bi-people"></i> จำนวน</div>
                            <div class="v">{{ $room->quantity ?? 0 }} คน/ห้อง</div>
                        </div>
                    </div>

                    <div class="desc">
                        <div class="desc-head">
                            <i class="bi bi-card-text"></i> รายละเอียดห้อง
                        </div>
                        @if($room->description)
                            <p>{{ $room->description }}</p>
                        @else
                            <p class="empty">ยังไม่มีการกรอกรายละเอียดห้อง</p>
                        @endif
                    </div>

                    <div class="actions">
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning btn-pill">
                            <i class="bi bi-pencil-square"></i> แก้ไข
                        </a>

                        <form action="{{ route('admin.rooms.destroy', $room->id) }}"
                              method="POST"
                              class="form-delete-room m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-pill">
                                <i class="bi bi-trash"></i> ลบ
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.form-delete-room');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'ลบห้องประชุม?',
                text: 'คุณแน่ใจหรือไม่ว่าต้องการลบห้องนี้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endpush
@endsection
