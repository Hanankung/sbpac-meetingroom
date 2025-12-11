{{-- resources/views/admin/index.blade.php --}}
@extends('admin.layout')

@section('title', 'แดชบอร์ดผู้ดูแล | ระบบจองห้องประชุม ศอ.บต.')
<link rel="icon" type="image/png" href="{{ asset('image/cropped-logo.png') }}?v=2">

@section('content')
<div class="container-fluid">

    {{-- หัวข้อหน้า --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">แดชบอร์ดผู้ดูแลระบบ</h4>
            <p class="mb-0 text-muted small">
                ภาพรวมการใช้งานห้องประชุม และสถานะการจองล่าสุด
            </p>
        </div>

        <div>
            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right me-1"></i> ออกจากระบบ
                </button>
            </form>
        </div>
    </div>

    {{-- แถวสรุปตัวเลข --}}
    <div class="row g-3 mb-4">

        {{-- จำนวนห้องประชุม --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">จำนวนห้องประชุม</div>
                            <div class="h4 mb-0">{{ $totalRooms }}</div>
                        </div>
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                             style="width: 42px; height: 42px;">
                            <i class="bi bi-building fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- การจองวันนี้ --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">การจองวันนี้</div>
                            <div class="h4 mb-0">{{ $bookingsToday }}</div>
                        </div>
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                             style="width: 42px; height: 42px;">
                            <i class="bi bi-calendar2-check fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- การจองล่วงหน้า --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">การจองล่วงหน้า</div>
                            <div class="h4 mb-0">{{ $upcomingBookings }}</div>
                        </div>
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                             style="width: 42px; height: 42px;">
                            <i class="bi bi-calendar-event fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- end row --}}

    {{-- ตารางการจองล่าสุด --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <span class="fw-semibold">การจองล่าสุด</span>
            <a href="{{ route('admin.bookings.history') }}" class="small text-decoration-none">ดูทั้งหมด</a>
        </div>

        <div class="card-body">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>วันที่จอง</th>
                        <th>ห้องประชุม</th>
                        <th>เวลา</th>
                        <th>ผู้จอง</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestBookings as $b)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($b->booking_date)->format('d/m/Y') }}</td>
                            <td>{{ $b->room->room_name ?? '-' }}</td>
                            <td>{{ $b->start_time }} - {{ $b->end_time }}</td>
                            <td>{{ $b->name }} {{ $b->lastname }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted text-center">ยังไม่มีข้อมูลการจอง</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Modal Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">ต้องการออกจากระบบ ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">คุณต้องการออกจากระบบหรือไม่</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">ออกจากระบบ</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
