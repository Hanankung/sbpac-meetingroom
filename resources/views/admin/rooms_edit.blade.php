{{-- resources/views/admin/rooms_edit.blade.php --}}
@extends('admin.layout')

@section('title', 'แก้ไขห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

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
        max-width: 1100px;
        margin: 0 auto;
        padding: 12px 10px 34px;
    }

    /* ===== Hero Header ===== */
    .hero{
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 40%, #ffffff 100%);
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
        background: #fff7ed;
        border: 1px solid rgba(245,158,11,.22);
        color: #b45309;
        box-shadow: 0 10px 22px rgba(245,158,11,.12);
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
        display:flex;
        align-items:center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .chip{
        display:inline-flex;
        align-items:center;
        gap:.45rem;
        padding: .35rem .75rem;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        color:#0f172a;
        background: rgba(255,255,255,.72);
        border: 1px solid rgba(148,163,184,.45);
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
        backdrop-filter: blur(6px);
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

    /* ===== Form Card ===== */
    .form-card{
        background: rgb(255, 255, 255);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(148,163,184,.35);
        border-radius: 18px;
        box-shadow: 0 22px 55px rgba(15,23,42,.10);
        overflow: hidden;
    }
    .form-head{
        padding: 14px 16px;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.45);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.6));
        display:flex;
        align-items:center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .form-title{
        margin:0;
        font-weight: 900;
        color:#0f172a;
        font-size: 14px;
        display:flex;
        align-items:center;
        gap: 10px;
    }
    .form-title .tic{
        width: 34px; height: 34px;
        border-radius: 12px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: #fff7ed;
        border: 1px solid rgba(245,158,11,.22);
        color:#b45309;
        box-shadow: 0 10px 22px rgba(245,158,11,.10);
    }
    .form-sub{
        color:#64748b;
        font-size: 12px;
        margin: 2px 0 0;
    }
    .form-body{
        padding: 16px;
    }

    /* ===== Current image preview ===== */
    .preview{
        display:flex;
        align-items:center;
        gap: 10px;
    }
    .preview small{
        color:#64748b;
        font-weight: 800;
    }
    .preview img{
        width: 86px; height: 54px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid rgba(148,163,184,.45);
        box-shadow: 0 12px 26px rgba(15,23,42,.10);
    }

    /* ===== Inputs ===== */
    .form-label{
        font-weight: 900;
        color:#334155;
        font-size: 13px;
        margin-bottom: .35rem;
    }
    .form-control{
        border-radius: 14px;
        border: 1px solid rgba(148,163,184,.45);
        padding: .65rem .9rem;
        box-shadow: 0 10px 22px rgba(15,23,42,.04);
    }
    .form-control:focus{
        border-color: rgba(245,158,11,.70);
        box-shadow: 0 0 0 .22rem rgba(245,158,11,.18), 0 10px 22px rgba(15,23,42,.06);
    }
    textarea.form-control{ min-height: 120px; }

    /* ===== Upload box (stylish) ===== */
    .upload-box{
        border: 1px dashed rgba(148,163,184,.65);
        background: rgba(248,250,252,.65);
        border-radius: 16px;
        padding: 14px;
    }
    .upload-meta{
        color:#64748b;
        font-size: 12px;
        margin-top: .35rem;
    }

    /* ===== Buttons ===== */
    .btn-warning.btn-save{
        border-radius: 999px;
        padding: .62rem 1.15rem;
        font-weight: 900;
        box-shadow: 0 18px 40px rgba(245,158,11,.22);
    }
    .btn-cancel{
        border-radius: 999px;
        padding: .62rem 1.05rem;
        font-weight: 900;
        border: 1px solid rgba(148,163,184,.55) !important;
        background: rgba(255,255,255,.75);
    }

    @media (max-width:576px){
        .hero-title{ font-size: 18px; }
        .preview img{ width: 78px; height: 50px; }
    }
</style>
@endpush

@section('content')
<div class="page-shell">

    {{-- ===== Header + Back ===== --}}
    <div class="hero">
        <div class="hero-inner">
            <div class="hero-left">
                <div class="hero-ic"><i class="bi bi-pencil-square"></i></div>
                <div>
                    <h5 class="hero-title mb-0">แก้ไขห้องประชุม</h5>
                    <div class="hero-sub">
                        <span class="chip"><i class="bi bi-gear"></i> ปรับรายละเอียดให้ตรงกับการใช้งานจริง</span>
                        <span class="chip"><i class="bi bi-hash"></i> ห้อง ID: {{ $room->id }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.rooms') }}" class="btn btn-outline-secondary btn-sm btn-pill">
                <i class="bi bi-arrow-left"></i> ย้อนกลับ
            </a>
        </div>
    </div>

    {{-- ===== Form Card ===== --}}
    <div class="form-card">
        <div class="form-head">
            <div>
                <h6 class="form-title">
                    <span class="tic"><i class="bi bi-door-open"></i></span>
                    รายละเอียดห้องประชุม
                </h6>
                <div class="form-sub">แก้ไขข้อมูลพื้นฐานและรูปภาพของห้องประชุม</div>
            </div>

            @if($room->room_image)
                <div class="preview">
                    <small>รูปปัจจุบัน</small>
                    <img src="{{ asset($room->room_image) }}" alt="รูปห้องปัจจุบัน">
                </div>
            @endif
        </div>

        <div class="form-body">
            <form method="POST"
                  action="{{ route('admin.rooms.update', $room->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ชื่อห้อง --}}
                <div class="mb-3">
                    <label class="form-label">ชื่อห้องประชุม <span class="text-danger">*</span></label>
                    <input type="text"
                           name="room_name"
                           class="form-control @error('room_name') is-invalid @enderror"
                           value="{{ old('room_name', $room->room_name) }}"
                           placeholder="เช่น ห้องประชุม 1 / ห้องสุไหงโก-ลก"
                           required>
                    @error('room_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    {{-- อาคาร --}}
                    <div class="col-md-6">
                        <label class="form-label">อาคาร</label>
                        <input type="text"
                               name="building"
                               class="form-control @error('building') is-invalid @enderror"
                               value="{{ old('building', $room->building) }}"
                               placeholder="เช่น อาคาร 2 ชั้น 3">
                        @error('building')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- จำนวนคน --}}
                    <div class="col-md-6">
                        <label class="form-label">จำนวนคน/ห้อง</label>
                        <input type="number"
                               name="quantity"
                               class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity', $room->quantity) }}"
                               placeholder="เช่น 10">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- รายละเอียด --}}
                <div class="mt-3">
                    <label class="form-label">รายละเอียด</label>
                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="ใส่รายละเอียดเพิ่มเติม เช่น อุปกรณ์ที่มีในห้อง, ลักษณะการใช้งาน">{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- รูปภาพ --}}
                <div class="mt-3">
                    <label class="form-label">เปลี่ยนรูปภาพ (ถ้าต้องการ)</label>

                    <div class="upload-box">
                        <input type="file"
                               name="room_image"
                               class="form-control @error('room_image') is-invalid @enderror">
                        <div class="upload-meta">
                            รองรับไฟล์ jpg, jpeg, png, webp ขนาดไม่เกิน 2MB (ถ้าไม่เลือกไฟล์ ระบบจะใช้รูปเดิม)
                        </div>
                        @error('room_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.rooms') }}" class="btn btn-cancel">
                        ยกเลิก
                    </a>
                    <button type="submit" class="btn btn-warning btn-save">
                        <i class="bi bi-save me-1"></i> บันทึกการเปลี่ยนแปลง
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
