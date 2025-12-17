@extends('admin.layout')

@section('title', 'เพิ่มผู้ใช้งาน | ศอ.บต.')

@push('styles')
<style>
    main { background:#f4f6f9; }

    .page-shell{
        max-width: 1180px;
        margin: 0 auto;
    }

    .page-hero{
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 45%, #ecfeff 100%);
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 28px rgba(15,23,42,.06);
        border-radius: 18px;
        padding: 18px 20px;
        margin-bottom: 16px;
    }

    .hero-title{
        font-size: 20px;
        font-weight: 800;
        margin: 0;
        color:#0f172a;
        letter-spacing: .2px;
    }

    .hero-sub{
        margin: 4px 0 0 0;
        color:#64748b;
        font-size: 13px;
        line-height: 1.45;
    }

    .btn-soft{
        border-radius: 999px;
        padding: 8px 14px;
        font-weight: 800;
        border: 1px solid #e5e7eb;
        background: #fff;
    }
    .btn-soft:hover{ background:#f8fafc; }

    .btn-primary-pill{
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(37,99,235,.18);
    }

    .card-premium{
        border: 1px solid #e5e7eb !important;
        border-radius: 18px !important;
        box-shadow: 0 12px 30px rgba(15,23,42,.06) !important;
        overflow: hidden;
    }

    .card-premium .card-header{
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
        padding: 14px 18px;
    }

    .section-title{
        font-weight: 900;
        color:#0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: .2px;
    }

    .section-title i{
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-size: 18px;
        border: 1px solid #dbeafe;
    }

    .form-label{
        font-weight: 800;
        color:#334155;
        font-size: 13.5px;
        margin-bottom: 6px;
    }

    .form-control{
        border-radius: 12px;
        border-color: #e5e7eb;
        padding: 10px 12px;
        font-size: 15px;
        background: #fbfcfe;
    }

    .form-control:focus{
        background: #fff;
        border-color: #2563eb;
        box-shadow: 0 0 0 .18rem rgba(37,99,235,.14);
    }

    .hint{
        color:#64748b;
        font-size: 12px;
        margin-top: 6px;
        line-height: 1.4;
    }

    .divider{
        height: 1px;
        background: #eef2f7;
        margin: 10px 0 2px;
    }

    .pill-note{
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #ecfdf3;
        color: #047857;
        border: 1px solid #d1fae5;
        font-weight: 800;
        font-size: 12px;
        white-space: nowrap;
    }

    .form-check-input{
        width: 18px;
        height: 18px;
        margin-top: 0.15rem;
        cursor: pointer;
    }
    .form-check-label{
        font-weight: 800;
        color:#334155;
        cursor: pointer;
    }

    .actions-bar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 6px;
    }

    .ghost-tip{
        display:flex;
        align-items:center;
        gap: 8px;
        color:#64748b;
        font-size: 12px;
    }

    .btn-loading{
        opacity: .85;
        pointer-events: none;
        position: relative;
    }
    .btn-loading::after{
        content: "";
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,.65);
        border-top-color: rgba(255,255,255,1);
        border-radius: 999px;
        display: inline-block;
        margin-left: 10px;
        vertical-align: -3px;
        animation: spin 0.7s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-shell">

        {{-- HERO --}}
        <div class="page-hero d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <p class="hero-title">เพิ่มผู้ใช้งาน (พนักงาน)</p>
                <p class="hero-sub">
                    เพิ่มข้อมูลพนักงาน และกำหนดรหัสผ่านเริ่มต้นเพื่อให้เข้าสู่ระบบได้ทันที
                    <br>แนะนำ: ให้ผู้ใช้งานเปลี่ยนรหัสผ่านหลังล็อกอินครั้งแรก
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-soft">
                    <i class="bi bi-arrow-left-short me-1"></i> ย้อนกลับ
                </a>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="card card-premium border-0">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h6 class="section-title">
                        <i class="bi bi-person-plus"></i>
                        รายละเอียดผู้ใช้งาน
                    </h6>
                    <span class="pill-note">
                        <i class="bi bi-shield-check"></i>
                        แนะนำ: ตั้งรหัสผ่านชั่วคราว
                    </span>
                </div>
            </div>

            <div class="card-body p-4">

                <form id="user-create-form" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="row g-3">

                        {{-- กลุ่ม: ข้อมูลส่วนตัว --}}
                        <div class="col-12">
                            <div class="ghost-tip">
                                <i class="bi bi-person-badge"></i>
                                ข้อมูลพื้นฐานของพนักงาน
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">เลขบัตรประชาชน</label>
                            <input name="national_id" class="form-control"
                                   value="{{ old('national_id') }}"
                                   placeholder="เช่น 110xxxxxxxxxx">
                            @error('national_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                            <input name="name" class="form-control" value="{{ old('name') }}" required
                                   placeholder="กรอกชื่อ">
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">นามสกุล</label>
                            <input name="lastname" class="form-control"
                                   value="{{ old('lastname') }}"
                                   placeholder="กรอกนามสกุล">
                            @error('lastname')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">เบอร์โทร</label>
                            <input name="phone" class="form-control"
                                   value="{{ old('phone') }}"
                                   placeholder="เช่น 08x-xxx-xxxx">
                            @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        {{-- กลุ่ม: หน่วยงาน --}}
                        <div class="col-12 mt-2">
                            <div class="ghost-tip">
                                <i class="bi bi-building"></i>
                                หน่วยงาน (ช่วยค้นหา/จัดกลุ่ม)
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">สำนักงาน/กอง</label>
                            <input name="division" class="form-control"
                                   value="{{ old('division') }}"
                                   placeholder="เช่น กอง/สำนักงาน...">
                            @error('division')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">กลุ่มงาน</label>
                            <input name="department" class="form-control"
                                   value="{{ old('department') }}"
                                   placeholder="เช่น กลุ่มงาน...">
                            @error('department')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        {{-- กลุ่ม: บัญชีเข้าใช้ --}}
                        <div class="col-12 mt-2">
                            <div class="ghost-tip">
                                <i class="bi bi-shield-lock"></i>
                                บัญชีเข้าใช้ระบบ
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">อีเมล (ใช้ล็อกอิน)</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="เช่น user@sbpac.go.th">
                            <div class="hint">
                                สามารถใช้ “อีเมล” หรือ “เลขบัตรประชาชน” ในการล็อกอินได้ (ตามที่ตั้งค่าไว้)
                            </div>
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">รหัสผ่านเริ่มต้น <span class="text-danger">*</span></label>
                            <input type="text" name="password" class="form-control" required
                                   placeholder="อย่างน้อย 6 ตัวอักษร">
                            <div class="hint">แนะนำ: ผสมตัวเลข/ตัวอักษรเพื่อความปลอดภัย</div>
                            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <div class="divider"></div>
                        </div>

                        <div class="col-12">
                            <div class="actions-bar">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                    <label class="form-check-label" for="is_active">
                                        เปิดใช้งานบัญชี
                                    </label>
                                </div>

                                <button id="btn-submit" type="submit" class="btn btn-primary btn-primary-pill">
                                    <i class="bi bi-check2-circle me-1"></i> บันทึกผู้ใช้งาน
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    {{-- SweetAlert2 (ต้องโหลดก่อนใช้ Swal) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const form = document.getElementById('user-create-form');
        const btn  = document.getElementById('btn-submit');

        // 1) confirm ก่อนบันทึก
        form?.addEventListener('submit', function(e){
            e.preventDefault();

            Swal.fire({
                title: 'ยืนยันการบันทึก?',
                text: 'ต้องการเพิ่มผู้ใช้งานคนนี้เข้าสู่ระบบหรือไม่',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'บันทึก',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b'
            }).then((result) => {
                if(result.isConfirmed){
                    // กันกดซ้ำ + ใส่ loading
                    btn?.classList.add('btn-loading');
                    form.submit();
                }
            });
        });

        // 2) popup success (หลัง controller redirect()->with('success', '...'); )
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: @json(session('success')),
            timer: 1600,
            showConfirmButton: false
        });
        @endif

        // 3) popup error รวม (validation error)
        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'บันทึกไม่สำเร็จ',
            text: @json($errors->first()),
            confirmButtonColor: '#dc2626'
        });
        @endif
    </script>
@endpush
