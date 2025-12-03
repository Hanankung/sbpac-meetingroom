{{-- resources/views/admin/index.blade.php --}}
@extends('admin.layout')

@section('title', 'แดชบอร์ดผู้ดูแล | ระบบจองห้องประชุม ศอ.บต.')

@section('content')
    <div class="container-fluid">

        {{-- หัวข้อหน้า + คำทักทาย --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 fw-bold">แดชบอร์ดผู้ดูแลระบบ</h4>
                <p class="mb-0 text-muted small">
                    ภาพรวมการใช้งานห้องประชุม และสถานะการจองล่าสุด
                </p>
            </div>

            {{-- ปุ่มลัด เช่น ออกจากระบบ หรือไปหน้าจัดการห้องประชุม --}}
            <div>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#logoutModal">
                        <i class="bi bi-box-arrow-right me-1"></i> ออกจากระบบ
                    </button>

                </form>
            </div>

        </div>

        {{-- แถวสรุปตัวเลขสำคัญ --}}
        <div class="row g-3 mb-4">

            {{-- การ์ด: จำนวนห้องประชุมทั้งหมด --}}
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small mb-1">จำนวนห้องประชุม</div>
                                <div class="h4 mb-0">{{ $totalRooms ?? 0 }}</div>
                            </div>
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i class="bi bi-building fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- การ์ด: การจองวันนี้ --}}
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small mb-1">การจองวันนี้</div>
                                <div class="h4 mb-0">{{ $bookingsToday ?? 0 }}</div>
                            </div>
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i class="bi bi-calendar2-check fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- การ์ด: การจองล่วงหน้า --}}
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small mb-1">การจองล่วงหน้า</div>
                                <div class="h4 mb-0">{{ $upcomingBookings ?? 0 }}</div>
                            </div>
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i class="bi bi-calendar-event fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- การ์ด: สถานะอื่น ๆ (เช่น รออนุมัติ) --}}
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small mb-1">การจองที่รอดำเนินการ</div>
                                <div class="h4 mb-0">{{ $pendingBookings ?? 0 }}</div>
                            </div>
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px;">
                                <i class="bi bi-hourglass-split fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- การ์ด: ตารางการจองล่าสุด --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">การจองล่าสุด</span>
                <a href="#" class="small text-decoration-none">ดูทั้งหมด</a>
            </div>
            <div class="card-body">
                {{-- ตอนนี้แสดงเป็นข้อความ placeholder ไว้ก่อน --}}
                <p class="text-muted small mb-0">
                    ยังไม่มีข้อมูลการจอง แสดงตัวอย่างตารางการจองภายหลังเมื่อต่อฐานข้อมูลเรียบร้อยแล้ว
                </p>
            </div>
        </div>

    </div>


    <!-- Modal ยืนยันการออกจากระบบ -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="logoutModalLabel">
                        ต้องการออกจากระบบ ?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    คุณแน่ใจหรือไม่ว่าต้องการออกจากระบบตอนนี้
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        ยกเลิก
                    </button>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            ออกจากระบบ
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
