@extends('layouts.app')

@section('title', 'เข้าสู่ระบบพนักงาน | ระบบจองห้องประชุม')

@section('content')
<div class="container" style="max-width:520px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-1">เข้าสู่ระบบพนักงาน</h5>
            <p class="text-muted small mb-3">กรอกอีเมลหรือเลขบัตรประชาชน และรหัสผ่านที่เจ้าหน้าที่กำหนด</p>

            {{-- ✅ แสดง error รวม (แบบที่คุณถามว่าจะวางตรงไหน) --}}
            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('user.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">อีเมล หรือ เลขบัตรประชาชน</label>
                    <input name="login"
                           class="form-control"
                           value="{{ old('login') }}"
                           placeholder="เช่น name@sbpac.go.th หรือ 1234567890123"
                           required>
                    @error('login') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-success w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> เข้าสู่ระบบ
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
