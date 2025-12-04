{{-- resources/views/admin/rooms_show.blade.php --}}
@extends('admin.layout')

@section('title', 'รายละเอียดห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

@section('content')
<div class="container-fluid">

    {{-- หัวหน้า + ปุ่มย้อนกลับ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                 style="width: 38px;height:38px;">
                <i class="bi bi-door-open-fill text-secondary" style="font-size:18px;"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold">รายละเอียดห้องประชุม</h5>
                <small class="text-muted">ดูข้อมูลห้องประชุมและจัดการได้จากหน้านี้</small>
            </div>
        </div>

        <a href="{{ route('admin.rooms') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> ย้อนกลับ
        </a>
    </div>

    {{-- การ์ดรายละเอียดห้อง --}}
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="row g-0">

            {{-- รูปห้อง --}}
            <div class="col-md-6 position-relative">
                @if($room->room_image)
                    <img src="{{ asset($room->room_image) }}"
                         alt="{{ $room->room_name }}"
                         class="img-fluid w-100 h-100"
                         style="object-fit: cover; min-height: 260px;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light w-100 h-100"
                         style="min-height: 260px;">
                        <span class="text-muted">ไม่มีภาพห้อง</span>
                    </div>
                @endif

                {{-- แถบข้อมูลสั้นซ้อนบนรูป --}}
                <div class="position-absolute bottom-0 start-0 w-100 p-3"
                     style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,.55) 100%);">
                    <div class="d-flex justify-content-between align-items-end text-white">
                        <div>
                            <div class="fw-semibold">{{ $room->room_name }}</div>
                            <small class="text-white-50">
                                <i class="bi bi-building me-1"></i>
                                {{ $room->building ?: 'ไม่ระบุอาคาร' }}
                            </small>
                        </div>
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-people-fill me-1"></i>
                            {{ $room->quantity ?? 0 }} คน
                        </span>
                    </div>
                </div>
            </div>

            {{-- ข้อมูลรายละเอียดด้านขวา --}}
            <div class="col-md-6">
                <div class="card-body h-100 d-flex flex-column">

                    {{-- ชื่อห้อง + แท็ก --}}
                    <div class="mb-3">
                        <h5 class="fw-bold mb-1">{{ $room->room_name }}</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge rounded-pill bg-light text-muted">
                                <i class="bi bi-building me-1"></i>
                                {{ $room->building ?: 'ไม่ระบุอาคาร' }}
                            </span>
                            <span class="badge rounded-pill bg-light text-muted">
                                <i class="bi bi-people-fill me-1"></i>
                                {{ $room->quantity ?? 0 }} ที่นั่ง
                            </span>
                        </div>
                    </div>

                    {{-- รายการข้อมูลสรุป --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="text-muted" style="width:120px;">
                                <i class="bi bi-door-open me-1"></i> ชื่อห้อง
                            </div>
                            <div class="fw-semibold">{{ $room->room_name }}</div>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <div class="text-muted" style="width:120px;">
                                <i class="bi bi-building me-1"></i> อาคาร
                            </div>
                            <div>{{ $room->building ?: '-' }}</div>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <div class="text-muted" style="width:120px;">
                                <i class="bi bi-people me-1"></i> จำนวน
                            </div>
                            <div>{{ $room->quantity ?? 0 }} คน/ห้อง</div>
                        </div>
                    </div>

                    {{-- รายละเอียดเพิ่มเติม --}}
                    <div class="mb-4">
                        <div class="text-muted mb-1">
                            <i class="bi bi-card-text me-1"></i> รายละเอียดห้อง
                        </div>
                        @if($room->description)
                            <p class="mb-0 text-secondary" style="white-space: pre-line;">
                                {{ $room->description }}
                            </p>
                        @else
                            <p class="mb-0 text-secondary fst-italic">ยังไม่มีการกรอกรายละเอียดห้อง</p>
                        @endif
                    </div>

                    {{-- ปุ่มจัดการ --}}
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('admin.rooms.edit', $room->id) }}"
                           class="btn btn-warning btn-sm px-3">
                            <i class="bi bi-pencil-square me-1"></i> แก้ไข
                        </a>

                        <form action="{{ route('admin.rooms.destroy', $room->id) }}"
                              method="POST"
                              class="form-delete-room">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                                <i class="bi bi-trash me-1"></i> ลบ
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- ใช้ SweetAlert ยืนยันลบ ให้หน้ารายละเอียดสวยเหมือนหน้า list --}}
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
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
