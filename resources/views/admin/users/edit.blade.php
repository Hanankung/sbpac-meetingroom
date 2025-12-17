@extends('admin.layout')

@section('title', 'แก้ไขผู้ใช้งาน | ศอ.บต.')

@push('styles')
<style>
    main { background:#f3f4f6; }

    .page-shell{
        max-width: 1180px;
        margin: 0 auto;
    }

    .page-hero {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 45%, #ecfdf3 100%);
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px 20px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 16px;
    }

    .hero-icon {
        width: 46px; height: 46px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #dcfce7;
        color: #16a34a;
        font-size: 20px;
        border: 1px solid #bbf7d0;
    }

    .hero-title { font-weight: 900; font-size: 20px; margin:0; color:#111827; letter-spacing:.2px; }
    .hero-sub   { font-size: 12.5px; color:#6b7280; margin:2px 0 0; line-height: 1.45; }

    .btn-pill {
        border-radius: 999px;
        padding: .52rem 1rem;
        font-weight: 800;
    }

    .card-soft {
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 10px 26px rgba(15, 23, 42, 0.06);
        overflow: hidden;
        background: #fff;
    }

    .card-soft .card-body{
        padding: 18px 18px;
    }

    .section-head {
        display:flex;
        align-items:center;
        justify-content:space-between;
        margin: 4px 0 10px;
    }

    .section-title {
        display:flex;
        align-items:center;
        gap:10px;
        font-weight: 900;
        font-size: 14.5px;
        color:#0f172a;
        margin: 0;
        letter-spacing: .2px;
    }

    .section-chip {
        font-size: 12px;
        background: #ecfdf3;
        border: 1px solid #bbf7d0;
        color: #065f46;
        padding: 6px 10px;
        border-radius: 999px;
        font-weight: 800;
        white-space: nowrap;
    }

    .form-label { font-weight: 800; color:#374151; font-size: 13.5px; margin-bottom: 6px; }

    .form-control {
        border-radius: 12px;
        border-color: #e5e7eb;
        padding: .66rem .75rem;
        background: #fbfcfe;
    }
    .form-control:focus {
        background: #fff;
        border-color: #22c55e;
        box-shadow: 0 0 0 .2rem rgba(34,197,94,.18);
    }

    .help-muted{
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
        line-height: 1.4;
    }

    .divider{
        height: 1px;
        background: #eef2f7;
        margin: 12px 0 6px;
    }

    .footer-bar {
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 12px;
        padding-top: 14px;
        border-top: 1px dashed #e5e7eb;
    }

    .btn-save {
        border-radius: 999px;
        padding: .7rem 1.25rem;
        font-weight: 900;
        box-shadow: 0 12px 26px rgba(37,99,235,.18);
    }

    .form-switch .form-check-input {
        width: 46px;
        height: 24px;
        cursor: pointer;
    }

    .btn-loading{
        opacity: .9;
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

        {{-- Hero --}}
        <div class="page-hero d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="hero-icon"><i class="bi bi-person-gear"></i></div>
                <div>
                    <p class="hero-title">แก้ไขผู้ใช้งาน</p>
                    <p class="hero-sub">ปรับข้อมูลพนักงาน หน่วยงาน และสถานะการใช้งานบัญชี</p>
                </div>
            </div>

            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-pill">
                <i class="bi bi-arrow-left-short"></i> ย้อนกลับ
            </a>
        </div>

        {{-- Card --}}
        <div class="card card-soft">
            <div class="card-body">

                {{-- error แบบแถบ (เผื่อ JS ไม่ทำงาน) --}}
                @if ($errors->any())
                    <div class="alert alert-danger small py-2 mb-3">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form id="user-edit-form" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- ข้อมูลพื้นฐาน --}}
                    <div class="section-head">
                        <p class="section-title">
                            <i class="bi bi-person-badge text-primary"></i> ข้อมูลพื้นฐาน
                        </p>
                        <span class="section-chip">ID: {{ $user->id }}</span>
                    </div>

                    <div class="row g-3 mb-2">
                        <div class="col-md-4">
                            <label class="form-label">เลขบัตรประชาชน</label>
                            <input name="national_id" class="form-control"
                                   value="{{ old('national_id',$user->national_id) }}"
                                   placeholder="เช่น 110xxxxxxxxxx">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                            <input name="name" class="form-control" required
                                   value="{{ old('name',$user->name) }}"
                                   placeholder="กรอกชื่อ">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">นามสกุล</label>
                            <input name="lastname" class="form-control"
                                   value="{{ old('lastname',$user->lastname) }}"
                                   placeholder="กรอกนามสกุล">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">เบอร์โทร</label>
                            <input name="phone" class="form-control"
                                   value="{{ old('phone',$user->phone) }}"
                                   placeholder="เช่น 08x-xxx-xxxx">
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- หน่วยงาน --}}
                    <div class="section-head mt-2">
                        <p class="section-title">
                            <i class="bi bi-building text-success"></i> หน่วยงาน
                        </p>
                        <span class="help-muted">ใส่เพื่อช่วยค้นหา/จัดกลุ่มพนักงาน</span>
                    </div>

                    <div class="row g-3 mb-2">
                        <div class="col-md-6">
                            <label class="form-label">สำนักงาน/กอง</label>
                            <input name="division" class="form-control"
                                   value="{{ old('division',$user->division) }}"
                                   placeholder="เช่น กอง/สำนักงาน...">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">กลุ่มงาน</label>
                            <input name="department" class="form-control"
                                   value="{{ old('department',$user->department) }}"
                                   placeholder="เช่น กลุ่มงาน...">
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- บัญชี --}}
                    <div class="section-head mt-2">
                        <p class="section-title">
                            <i class="bi bi-shield-lock text-warning"></i> บัญชีเข้าใช้
                        </p>
                        <span class="help-muted">อีเมล + รหัสผ่าน</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">อีเมล</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email',$user->email) }}"
                                   placeholder="name@sbpac.go.th">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">เปลี่ยนรหัสผ่าน</label>
                            <input type="text" name="password" class="form-control"
                                   placeholder="เว้นว่างหากไม่เปลี่ยน">
                            <div class="help-muted">หากเว้นว่าง ระบบจะไม่เปลี่ยนรหัสผ่านเดิม</div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                       {{ old('is_active',$user->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    เปิดใช้งานบัญชี <span class="text-muted fw-normal small">(ปิด = ล็อกอินไม่ได้)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="footer-bar">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i> บันทึกแล้วมีผลทันที
                        </small>

                        <button id="btn-save" class="btn btn-primary btn-save" type="submit">
                            <i class="bi bi-save2 me-1"></i> บันทึก
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form = document.getElementById('user-edit-form');
    const btn  = document.getElementById('btn-save');

    // Confirm ก่อนบันทึก
    form?.addEventListener('submit', function(e){
        e.preventDefault();

        Swal.fire({
            title: 'ยืนยันการบันทึก?',
            text: 'ต้องการบันทึกการแก้ไขผู้ใช้งานคนนี้หรือไม่',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#64748b'
        }).then((result) => {
            if(result.isConfirmed){
                btn?.classList.add('btn-loading');
                form.submit();
            }
        });
    });

    // success popup (ถ้า controller ส่งกลับมาพร้อม session success)
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: @json(session('success')),
        confirmButtonColor: '#2563eb'
    });
    @endif

    // error popup (validation)
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
