@extends('layouts.app')

@section('title', 'จองห้องประชุม | ระบบจองห้องประชุม ศอ.บต.')
<link rel="icon" type="image/png" href="{{ asset('image/cropped-logo.png') }}?v=2">

@push('styles')
    <style>
        main {
            background: #f5f5f7;
        }

        /* ===== ส่วนหัวหน้าเพจ ===== */
        .page-header-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 16px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid #ececec;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: #222;
        }

        .page-subtitle {
            font-size: 13px;
            color: #777;
        }

        .search-box {
            max-width: 320px;
        }

        /* ===== การ์ดห้องประชุม ===== */
        .user-room-card {
            border-radius: 16px;
            border: 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: .18s;
            background: #fff;
        }

        .user-room-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.08);
        }

        .room-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .room-image-wrapper img {
            height: 210px;
            object-fit: cover;
            width: 100%;
            transition: transform .22s ease;
        }

        .user-room-card:hover .room-image-wrapper img {
            transform: scale(1.03);
        }

        /* badge ความจุคน บนรูป */
        .room-cap-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border-radius: 999px;
            padding: 4px 11px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            backdrop-filter: blur(3px);
        }

        .room-cap-badge i {
            font-size: 13px;
        }

        /* ===== เนื้อหาในการ์ด ===== */
        .room-name {
            font-weight: 700;
            font-size: 15px;
            color: #222;
        }

        .room-building {
            font-size: 13px;
            color: #666;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .room-building i {
            font-size: 14px;
        }

        .room-desc {
            font-size: 13px;
            color: #6b7280;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .room-card-footer {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #f1f1f1;
        }

        .btn-book {
            border-radius: 999px;
            font-size: 13px;
            padding-inline: 18px;
        }

        .btn-detail {
            border-radius: 999px;
            font-size: 13px;
            padding-inline: 14px;
        }

        /* ===== สถานะเมื่อไม่มีห้อง ===== */
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
    {{-- แถบหัว + ช่องค้นหา --}}
    <div class="page-header-card d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                style="width:34px;height:34px;background:#e5f4ff;">
                <i class="bi bi-calendar2-check" style="font-size:18px;color:#0d6efd;"></i>
            </div>
            <div>
                <p class="page-title mb-0">ห้องประชุมทั้งหมด</p>
                <p class="page-subtitle mb-0">
                    @if (!empty($search))
                        ผลการค้นหา: “{{ $search }}”
                    @else
                        เลือกห้องที่ต้องการจองจากรายการด้านล่าง
                    @endif
                </p>
            </div>
        </div>

        {{-- กล่องค้นหา --}}
        <div class="search-box">
            <form action="{{ route('users.rooms') }}" method="GET">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-start-0"
                        placeholder="ค้นหาชื่อห้อง / อาคาร" value="{{ old('q', $search ?? '') }}">
                </div>
            </form>
        </div>
    </div>

    @if ($rooms->count() === 0)
        <div class="empty-state text-center text-muted">
            <div class="mb-2">
                <i class="bi bi-door-open" style="font-size:30px;"></i>
            </div>
            <h6 class="fw-bold mb-1">ไม่พบห้องประชุม</h6>
            <p class="mb-0" style="font-size:13px;">
                @if (!empty($search))
                    ลองเปลี่ยนคำค้นหา หรือพิมพ์ชื่อห้อง / อาคารให้สั้นลง
                @else
                    กรุณาติดต่อเจ้าหน้าที่เพื่อเพิ่มห้องประชุมก่อนทำการจอง
                @endif
            </p>
        </div>
    @else
        <div class="row g-4">
            @foreach ($rooms as $room)
                <div class="col-md-6 col-lg-4">
                    <div class="card user-room-card h-100">

                        {{-- รูปห้อง (คลิกได้) --}}
                        <a href="{{ route('user.rooms.show', $room->id) }}" class="text-decoration-none text-dark">
                            <div class="room-image-wrapper">
                                @if ($room->room_image)
                                    <img src="{{ asset($room->room_image) }}" alt="{{ $room->room_name }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light"
                                        style="height:210px;">
                                        <span class="text-muted">ไม่มีภาพห้อง</span>
                                    </div>
                                @endif

                                <div class="room-cap-badge">
                                    <i class="bi bi-people-fill"></i>
                                    {{ $room->quantity ?? 0 }} คน/ห้อง
                                </div>
                            </div>
                        </a>

                        {{-- เนื้อหาในการ์ด --}}
                        <div class="card-body d-flex flex-column">

                            <div class="room-name mb-1">
                                {{ $room->room_name }}
                            </div>

                            <div class="room-building mb-2">
                                <i class="bi bi-building"></i>
                                <span>อาคาร {{ $room->building ?: '-' }}</span>
                            </div>

                            <div class="room-card-footer mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('user.rooms.show', $room->id) }}"
                                    class="btn btn-outline-secondary btn-sm btn-detail">
                                    ดูรายละเอียด
                                </a>

                                @auth
                                    <a href="{{ route('user.bookings.create', $room->id) }}" class="btn btn-success">จอง</a>
                                @else
                                    <a href="{{ route('user.login') }}" class="btn btn-success">จอง</a>
                                @endauth

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @push('scripts')
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'จองสำเร็จ',
                        text: @json(session('success')),
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#198754',
                        width: 420,
                        timer: 2200,
                        timerProgressBar: true,
                    });
                });
            </script>
        @endif
    @endpush

@endsection
