{{-- resources/views/admin/rooms_create.blade.php --}}
@extends('admin.layout')

@section('title', 'เพิ่มห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

@section('content')
<div class="container-fluid">

    {{-- แถวหัวข้อ + ปุ่มย้อนกลับ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-calendar2-event me-2" style="font-size: 22px;"></i>
            <h5 class="mb-0 fw-bold">เพิ่มห้องประชุม</h5>
        </div>

        <a href="{{ route('admin.rooms') }}" class="btn btn-outline-secondary btn-sm">
            ย้อนกลับ
        </a>
    </div>

    {{-- การ์ดฟอร์ม --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <strong>รายละเอียดห้องประชุม</strong>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- ชื่อห้องประชุม --}}
                <div class="mb-3">
                    <label class="form-label">ชื่อห้องประชุม</label>
                    <input type="text" name="room_name" class="form-control"
                           value="{{ old('room_name') }}" required>
                    @error('room_name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- อาคาร --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">อาคาร</label>
                        <input type="text" name="building" class="form-control"
                               value="{{ old('building') }}">
                        @error('building')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- จำนวนคน/ห้อง --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">จำนวนคน/ห้อง</label>
                        <input type="number" name="quantity" class="form-control"
                               value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- รายละเอียด --}}
                <div class="mb-3">
                    <label class="form-label">รายละเอียด</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- รูปภาพ --}}
                <div class="mb-4">
                    <label class="form-label">รูปภาพ</label>
                    <input type="file" name="room_image" class="form-control">
                    <div class="form-text">รองรับไฟล์ jpg, jpeg, png, webp ขนาดไม่เกิน 2MB</div>
                    @error('room_image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning px-4">
                        บันทึก
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
