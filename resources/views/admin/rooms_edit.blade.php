{{-- resources/views/admin/rooms_edit.blade.php --}}
@extends('admin.layout')

@section('title', 'แก้ไขห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

@section('content')
<div class="container-fluid">

    {{-- หัวข้อหน้า + ปุ่มย้อนกลับ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="d-flex align-items-center mb-1">
                <span class="badge bg-warning text-dark me-2 rounded-circle d-inline-flex align-items-center justify-content-center"
                      style="width:32px;height:32px;">
                    <i class="bi bi-pencil-square"></i>
                </span>
                <h5 class="mb-0 fw-bold">แก้ไขห้องประชุม</h5>
            </div>
            <p class="mb-0 text-muted small">
                ปรับรายละเอียดห้องประชุมให้ตรงกับการใช้งานจริง
            </p>
        </div>

        <a href="{{ route('admin.rooms') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> ย้อนกลับ
        </a>
    </div>

    {{-- การ์ดฟอร์ม --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <div>
                <strong>รายละเอียดห้องประชุม</strong>
                <span class="text-muted small d-block">แก้ไขข้อมูลพื้นฐานและรูปภาพของห้องประชุม</span>
            </div>

            @if($room->room_image)
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">รูปปัจจุบัน</span>
                    <img src="{{ asset($room->room_image) }}"
                         alt="รูปห้องปัจจุบัน"
                         style="height:48px;width:80px;object-fit:cover;border-radius:6px;">
                </div>
            @endif
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.rooms.update', $room->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ชื่อห้องประชุม --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">ชื่อห้องประชุม <span class="text-danger">*</span></label>
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

                <div class="row">
                    {{-- อาคาร --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">อาคาร</label>
                        <input type="text"
                               name="building"
                               class="form-control @error('building') is-invalid @enderror"
                               value="{{ old('building', $room->building) }}"
                               placeholder="เช่น อาคาร 2 ชั้น 3">
                        @error('building')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- จำนวนคน/ห้อง --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">จำนวนคน/ห้อง</label>
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
                <div class="mb-3">
                    <label class="form-label fw-semibold">รายละเอียด</label>
                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="ใส่รายละเอียดเพิ่มเติม เช่น อุปกรณ์ที่มีในห้อง, ลักษณะการใช้งาน">{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- รูปภาพ --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">เปลี่ยนรูปภาพ (ถ้าต้องการ)</label>
                    <input type="file"
                           name="room_image"
                           class="form-control @error('room_image') is-invalid @enderror">
                    <div class="form-text">
                        รองรับไฟล์ jpg, jpeg, png, webp ขนาดไม่เกิน 2MB หากไม่เลือกไฟล์ ระบบจะใช้รูปเดิม
                    </div>
                    @error('room_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ปุ่มบันทึก --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.rooms') }}" class="btn btn-light border">
                        ยกเลิก
                    </a>
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="bi bi-save me-1"></i> บันทึกการเปลี่ยนแปลง
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
