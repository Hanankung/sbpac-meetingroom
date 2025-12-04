@extends('admin.layout')

@section('title', 'ห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')

{{-- แต่ง CSS เพิ่มเติมสำหรับหน้านี้ --}}
@push('styles')
<style>
    /* พื้นหลังส่วนเนื้อหา */
    main {
        background: #f5f5f7;
    }

    .page-header-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 22px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #ececec;
    }

    .page-title {
        font-size: 18px;
        font-weight: 700;
        color: #222;
    }

    .page-subtitle {
        font-size: 13px;
        color: #888;
    }

    .btn-add-room {
        border-radius: 999px;
        font-weight: 600;
        font-size: 14px;
        padding-inline: 18px;
        box-shadow: 0 4px 10px rgba(255,193,7,0.25);
    }

    /* การ์ดห้องประชุม */
    .room-card {
        border-radius: 16px;
        overflow: hidden;
        border: 0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        transition: transform .18s ease, box-shadow .18s ease;
        background: #ffffff;
    }

    .room-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 35px rgba(0,0,0,0.08);
    }

    .room-card-image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .room-card-image-wrapper img {
        transition: transform .25s ease;
    }

    .room-card:hover .room-card-image-wrapper img {
        transform: scale(1.03);
    }

    /* แถบข้อมูลซ้อนบนรูป */
    .room-cap-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(4px);
    }

    .room-cap-badge i {
        font-size: 13px;
    }

    .room-building-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        background: #f3f4f6;
        color: #555;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .room-name {
        font-weight: 700;
        font-size: 15px;
        color: #222;
    }

    .room-desc {
        font-size: 13px;
        color: #777;
    }

    .room-card-footer {
        border-top: 1px solid #f0f0f0;
        padding-top: 10px;
        margin-top: 10px;
    }

    .btn-room-edit {
        border-radius: 999px;
        font-size: 13px;
        padding-inline: 14px;
    }

    .btn-room-delete {
        border-radius: 999px;
        font-size: 13px;
        padding-inline: 14px;
    }

    /* ข้อความเมื่อไม่มีห้อง */
    .empty-state {
        border-radius: 16px;
        border: 1px dashed #d2d2d7;
        padding: 40px 24px;
        background: #ffffff;
        max-width: 520px;
        margin: 40px auto 0;
    }
</style>
@endpush

@section('content')

    {{-- แถวหัวข้อ + ปุ่มเพิ่มห้อง (อยู่ใน card สวย ๆ) --}}
    <div class="page-header-card mb-4 d-flex justify-content-between align-items-center">
        <div>
            <div class="d-flex align-items-center mb-1">
                <div
                    class="me-2 d-inline-flex align-items-center justify-content-center rounded-circle"
                    style="width:36px;height:36px;background:#ffe9a3;">
                    <i class="bi bi-calendar2-event" style="font-size:18px;color:#c28a00;"></i>
                </div>
                <h5 class="page-title mb-0">ห้องประชุมทั้งหมด</h5>
            </div>
            <div class="page-subtitle">
                จัดการห้องประชุมและความจุของแต่ละห้องสำหรับการจองของหน่วยงาน
            </div>
        </div>

        <a href="{{ route('admin.rooms.create') }}"
           class="btn btn-warning text-dark btn-add-room d-flex align-items-center">
            <i class="bi bi-plus-lg me-1"></i>
            เพิ่มห้อง
        </a>
    </div>

    {{-- ถ้ายังไม่มีห้องเลย --}}
    @if ($rooms->count() === 0)
        <div class="empty-state text-center text-muted">
            <div class="mb-2">
                <i class="bi bi-door-open" style="font-size:30px;"></i>
            </div>
            <h6 class="mb-1 fw-bold">ยังไม่มีข้อมูลห้องประชุม</h6>
            <p class="mb-3" style="font-size:13px;">
                เริ่มต้นเพิ่มห้องประชุมแรกของคุณ เพื่อเปิดให้เจ้าหน้าที่ทำการจองได้
            </p>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-warning btn-sm text-dark px-3">
                <i class="bi bi-plus-lg me-1"></i> เพิ่มห้องประชุม
            </a>
        </div>
    @else
        {{-- แสดงการ์ดห้องประชุมทั้งหมด --}}
        <div class="row g-4">

            @foreach ($rooms as $room)
                <div class="col-md-6 col-lg-4">
                    <div class="card room-card h-100">

                        {{-- รูปห้อง (กดแล้วไปหน้ารายละเอียด) --}}
                        <div class="room-card-image-wrapper">
                            @if ($room->room_image)
                                <a href="{{ route('admin.rooms.show', $room->id) }}">
                                    <img src="{{ asset($room->room_image) }}"
                                         class="card-img-top"
                                         alt="{{ $room->room_name }}"
                                         style="height:230px; object-fit:cover; cursor:pointer;">
                                </a>
                            @else
                                <a href="{{ route('admin.rooms.show', $room->id) }}" class="text-decoration-none">
                                    <div class="d-flex align-items-center justify-content-center bg-light"
                                         style="height:230px; cursor:pointer;">
                                        <span class="text-muted small">ไม่มีภาพห้อง (กดเพื่อดูรายละเอียด)</span>
                                    </div>
                                </a>
                            @endif

                            {{-- badge ความจุบนรูป --}}
                            <div class="room-cap-badge">
                                <i class="bi bi-people-fill"></i>
                                {{ $room->quantity ?? 0 }} คน/ห้อง
                            </div>
                        </div>

                        {{-- เนื้อหาในการ์ด --}}
                        <div class="card-body d-flex flex-column">

                            {{-- อาคาร + ชื่อห้อง --}}
                            <div class="room-building-pill">
                                <i class="bi bi-building"></i>
                                <span>อาคาร {{ $room->building ?: '-' }}</span>
                            </div>

                            <div class="room-name mb-1">
                                {{ $room->room_name }}
                            </div>

                            {{-- รายละเอียดสั้น ๆ --}}
                            @if ($room->description)
                                <p class="room-desc mb-2">
                                    {{ Str::limit($room->description, 80) }}
                                </p>
                            @else
                                <p class="room-desc mb-2 text-muted">
                                    ยังไม่ได้ระบุรายละเอียดเพิ่มเติม
                                </p>
                            @endif

                            {{-- ปุ่มด้านล่าง --}}
                            <div class="room-card-footer mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.rooms.show', $room->id) }}"
                                   class="btn btn-link p-0 small text-decoration-none">
                                    ดูรายละเอียด <i class="bi bi-arrow-right-short"></i>
                                </a>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                       class="btn btn-sm btn-outline-warning btn-room-edit">
                                        แก้ไข
                                    </a>

                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}"
                                          method="POST"
                                          class="form-delete-room m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger btn-room-delete">
                                            ลบ
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif

    {{-- SweetAlert สำหรับแจ้งเตือน & ยืนยันการลบ --}}
    @push('scripts')
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: @json(session('success')),
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#ffc107',
                        width: 420,
                        timer: 2200,
                        timerProgressBar: true,
                    });
                });
            </script>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForms = document.querySelectorAll('.form-delete-room');

                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
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
            });
        </script>
    @endpush

@endsection
