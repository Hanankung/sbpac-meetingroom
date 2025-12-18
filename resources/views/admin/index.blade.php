{{-- resources/views/admin/index.blade.php --}}
@extends('admin.layout')

@section('title', 'แดชบอร์ดผู้ดูแล | ระบบจองห้องประชุม ศอ.บต.')
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
    .page-shell{
        max-width: 1200px;
        margin: 0 auto;
        padding: 12px 10px 34px;
    }

    /* ===== Hero header ===== */
    .hero{
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 40%, #ffffff 100%);
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
        background: radial-gradient(600px 220px at 10% 0%, rgba(255, 255, 255, 0.12), transparent 60%),
                    radial-gradient(600px 220px at 95% 0%, rgba(255, 255, 255, 0.12), transparent 60%);
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
    .hero-title{
        margin:0;
        font-weight: 900;
        letter-spacing: .2px;
        color:#0f172a;
        font-size: 22px;
        line-height: 1.2;
    }
    .hero-sub{
        margin: 4px 0 0;
        color:#64748b;
        font-size: 13px;
    }

    .btn-pill{
        border-radius: 999px !important;
        padding: .44rem .95rem;
        font-weight: 700;
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

    /* ===== Stat cards ===== */
    .stat-card{
        border: 1px solid rgba(148,163,184,.35) !important;
        border-radius: 18px !important;
        box-shadow: 0 22px 55px rgba(15,23,42,.10) !important;
        background: rgba(255,255,255,.86);
        backdrop-filter: blur(8px);
        overflow: hidden;
        position: relative;
    }
    .stat-card:after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(520px 180px at 10% 0%, rgba(255, 255, 255, 0.1), transparent 55%);
        pointer-events:none;
    }
    .stat-body{
        position: relative;
        padding: 16px 16px;
    }
    .stat-label{
        color:#64748b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .2px;
        margin-bottom: 6px;
    }
    .stat-value{
        font-size: 26px;
        font-weight: 900;
        color:#0f172a;
        margin: 0;
        line-height: 1;
    }
    .stat-ic{
        width: 46px; height: 46px;
        border-radius: 16px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: #f1f5f9;
        border: 1px solid rgba(148,163,184,.45);
        box-shadow: 0 12px 26px rgba(15,23,42,.06);
        font-size: 20px;
        color:#0f172a;
    }
    .stat-foot{
        position: relative;
        padding: 10px 16px 14px;
        border-top: 1px dashed rgba(148,163,184,.45);
        color:#64748b;
        font-size: 12px;
        display:flex;
        align-items:center;
        justify-content: space-between;
        gap: 10px;
    }
    .pill{
        display:inline-flex;
        align-items:center;
        gap:.4rem;
        padding: .32rem .7rem;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        color:#0f172a;
        background: rgba(255,255,255,.72);
        border: 1px solid rgba(148,163,184,.45);
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
        backdrop-filter: blur(6px);
    }

    /* ===== Table card ===== */
    .table-card{
        border: 1px solid rgba(148,163,184,.35) !important;
        border-radius: 18px !important;
        box-shadow: 0 22px 55px rgba(15,23,42,.10) !important;
        overflow: hidden;
        background: rgba(255,255,255,.88);
        backdrop-filter: blur(8px);
    }
    .table-head{
        padding: 14px 16px;
        border-bottom: 1px dashed rgba(148,163,184,.45);
        background: linear-gradient(180deg, rgba(248,250,252,.9), rgba(255,255,255,.6));
        display:flex;
        align-items:center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .table-title{
        margin:0;
        font-weight: 900;
        color:#0f172a;
        display:flex;
        align-items:center;
        gap: 10px;
        font-size: 14px;
    }
    .table-title .tic{
        width: 34px; height: 34px;
        border-radius: 12px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: #ecfdf5;
        border: 1px solid rgba(34,197,94,.20);
        color:#16a34a;
        box-shadow: 0 10px 22px rgba(34,197,94,.10);
    }
    .link-soft{
        font-weight: 800;
        font-size: 12px;
        text-decoration: none;
        color:#2563eb;
        padding: .35rem .7rem;
        border-radius: 999px;
        border: 1px solid rgba(37,99,235,.18);
        background: rgba(37,99,235,.06);
    }
    .link-soft:hover{
        background: rgba(37,99,235,.10);
    }

    table.table-modern{
        margin: 0;
        font-size: 13px;
    }
    .table-modern thead th{
        border-bottom: 1px solid rgba(226,232,240,.9) !important;
        color:#334155;
        font-weight: 900;
        font-size: 12px;
        letter-spacing: .2px;
        padding: 12px 14px !important;
        background: rgba(248,250,252,.7);
    }
    .table-modern tbody td{
        padding: 12px 14px !important;
        border-top: 1px solid rgba(226,232,240,.8) !important;
        color:#0f172a;
        vertical-align: middle;
    }
    .table-modern tbody tr:hover{
        background: rgba(34,197,94,.06);
    }

    .empty{
        padding: 22px 16px;
        color:#64748b;
        text-align:center;
        font-weight: 700;
    }

    @media (max-width: 576px){
        .hero-title{ font-size: 18px; }
        .stat-value{ font-size: 22px; }
    }
</style>
@endpush

@section('content')
<div class="page-shell">

    {{-- ===== Hero ===== --}}
    <div class="hero">
        <div class="hero-inner">
            <div>
                <h4 class="hero-title">แดชบอร์ดผู้ดูแลระบบ</h4>
                <p class="hero-sub mb-0">ภาพรวมการใช้งานห้องประชุม และสถานะการจองล่าสุด</p>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="button" class="btn btn-sm btn-outline-secondary btn-pill"
                        data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i> ออกจากระบบ
                </button>
            </form>
        </div>
    </div>

    {{-- ===== Stats ===== --}}
    <div class="row g-3 mb-3">

        <div class="col-md-4">
            <div class="stat-card h-100">
                <div class="stat-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">จำนวนห้องประชุม</div>
                            <div class="stat-value">{{ $totalRooms }}</div>
                        </div>
                        <div class="stat-ic">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-foot">
                    <span class="pill"><i class="bi bi-grid-1x2"></i> Rooms</span>
                    <span class="text-muted">อัปเดตล่าสุด</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card h-100" style="--x:1;">
                <div class="stat-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">การจองวันนี้</div>
                            <div class="stat-value">{{ $bookingsToday }}</div>
                        </div>
                        <div class="stat-ic" style="background:#e0f2fe;border-color:rgba(14,165,233,.25);">
                            <i class="bi bi-calendar2-check"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-foot">
                    <span class="pill"><i class="bi bi-sun"></i> Today</span>
                    <span class="text-muted">เฉพาะวันปัจจุบัน</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card h-100">
                <div class="stat-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">การจองล่วงหน้า</div>
                            <div class="stat-value">{{ $upcomingBookings }}</div>
                        </div>
                        <div class="stat-ic" style="background:#ecfdf5;border-color:rgba(34,197,94,.20);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-foot">
                    <span class="pill"><i class="bi bi-arrow-right-circle"></i> Upcoming</span>
                    <span class="text-muted">รายการอนาคต</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Latest Table ===== --}}
    <div class="table-card">
        <div class="table-head">
            <h6 class="table-title">
                <span class="tic"><i class="bi bi-clock-history"></i></span>
                การจองล่าสุด
            </h6>
            <a href="{{ route('admin.bookings.history') }}" class="link-soft">
                ดูทั้งหมด <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="min-width:140px;">วันที่จอง</th>
                            <th style="min-width:140px;">ห้องประชุม</th>
                            <th style="min-width:170px;">เวลา</th>
                            <th>ผู้จอง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestBookings as $b)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($b->booking_date)->format('d/m/Y') }}</td>
                                <td>{{ $b->room->room_name ?? '-' }}</td>
                                <td>
                                    <span class="pill">
                                        <i class="bi bi-clock"></i>
                                        {{ $b->start_time }} - {{ $b->end_time }}
                                    </span>
                                </td>
                                <td class="fw-semibold">{{ $b->name }} {{ $b->lastname }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">ยังไม่มีข้อมูลการจอง</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Modal Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:18px; overflow:hidden; border:1px solid rgba(148,163,184,.35);">
            <div class="modal-header" style="background:linear-gradient(180deg, rgba(248,250,252,.95), rgba(255,255,255,.85));">
                <h5 class="modal-title fw-bold">ต้องการออกจากระบบ ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="color:#334155;">คุณต้องการออกจากระบบหรือไม่</div>

            <div class="modal-footer" style="background:#fff;">
                <button type="button" class="btn btn-outline-secondary btn-pill" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-pill">
                        <i class="bi bi-box-arrow-right"></i> ออกจากระบบ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
