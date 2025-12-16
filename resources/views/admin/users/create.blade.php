@extends('admin.layout')

@section('title', 'เพิ่มผู้ใช้งาน | ศอ.บต.')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 fw-bold">เพิ่มผู้ใช้งาน</h4>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">ย้อนกลับ</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">เลขบัตรประชาชน</label>
                        <input name="national_id" class="form-control" value="{{ old('national_id') }}">
                        @error('national_id')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                        <input name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">นามสกุล</label>
                        <input name="lastname" class="form-control" value="{{ old('lastname') }}">
                        @error('lastname')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">เบอร์โทร</label>
                        <input name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">สำนักงาน/กอง</label>
                        <input name="division" class="form-control" value="{{ old('division') }}">
                        @error('division')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">กลุ่มงาน</label>
                        <input name="department" class="form-control" value="{{ old('department') }}">
                        @error('department')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">อีเมล (ใช้ล็อกอิน)</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">รหัสผ่านเริ่มต้น <span class="text-danger">*</span></label>
                        <input type="text" name="password" class="form-control" required>
                        <div class="text-muted small">แนะนำให้กำหนดชั่วคราว แล้วค่อยให้ผู้ใช้เปลี่ยนทีหลัง</div>
                        @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">เปิดใช้งานบัญชี</label>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button class="btn btn-primary">
                        <i class="bi bi-check2-circle me-1"></i> บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
