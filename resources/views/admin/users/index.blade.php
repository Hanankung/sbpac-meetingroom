@extends('admin.layout')

@section('title', 'จัดการผู้ใช้งาน | ศอ.บต.')

@push('styles')
    <style>
        /* ===== Page background ===== */
        main {
            background: #f4f6f9;
        }

        /* ===== Header / Cards ===== */
        .page-shell {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-card {
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 55%, #eefdf5 100%);
            border: 1px solid #e6eaf0;
            border-radius: 18px;
            box-shadow: 0 10px 26px rgba(15, 23, 42, .06);
            padding: 18px 20px;
            margin-bottom: 14px;
        }

        .hero-title {
            font-weight: 800;
            letter-spacing: .2px;
            margin: 0;
            color: #0f172a;
            font-size: 20px;
        }

        .hero-sub {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .btn-pill {
            border-radius: 999px !important;
            padding: .55rem 1rem;
            font-weight: 700;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .18);
        }

        /* ===== Stat chips ===== */
        .stats-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .stat-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            border: 1px solid #e6eaf0;
            border-radius: 14px;
            padding: 10px 12px;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .04);
            min-width: 160px;
        }

        .stat-ico {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            border: 1px solid #e6eaf0;
        }

        .stat-ico i {
            font-size: 18px;
            color: #0f172a;
        }

        .stat-label {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1;
        }

        /* ===== Search card ===== */
        .search-card {
            background: #fff;
            border: 1px solid #e6eaf0;
            border-radius: 18px;
            box-shadow: 0 10px 26px rgba(15, 23, 42, .05);
            padding: 14px;
            margin-bottom: 14px;
        }

        .search-wrap {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input {
            position: relative;
            flex: 1;
            min-width: 280px;
        }

        .search-input i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .search-input input {
            padding-left: 40px !important;
            border-radius: 14px !important;
            border: 1px solid #e6eaf0 !important;
            height: 44px;
            font-size: 14px;
            background: #fbfcfe;
        }

        .search-input input:focus {
            background: #fff;
            border-color: #22c55e !important;
            box-shadow: 0 0 0 .18rem rgba(34, 197, 94, .18) !important;
        }

        .btn-soft {
            border-radius: 14px !important;
            height: 44px;
            padding: 0 14px;
            font-weight: 700;
        }

        /* ===== Table card ===== */
        .table-card {
            background: #fff;
            border: 1px solid #e6eaf0;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
            overflow: hidden;
        }

        .table thead th {
            background: #f8fafc !important;
            border-bottom: 1px solid #e6eaf0 !important;
            color: #475569;
            font-size: 12.5px;
            letter-spacing: .2px;
            text-transform: none;
            padding: 12px 14px;
        }

        .table tbody td {
            padding: 14px 14px;
            border-top: 1px solid #eef2f7;
            vertical-align: middle;
            color: #0f172a;
            font-size: 14px;
        }

        .row-hover:hover {
            background: #fbfdff;
        }

        /* ===== Name block ===== */
        .name-line {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #0f172a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: .4px;
            box-shadow: 0 10px 22px rgba(15, 23, 42, .15);
        }

        .meta {
            color: #64748b;
            font-size: 12px;
            margin-top: 2px;
        }

        /* ===== Status badge ===== */
        .badge-soft-success {
            background: rgba(34, 197, 94, .12) !important;
            color: #166534 !important;
            border: 1px solid rgba(34, 197, 94, .25);
            font-weight: 800;
            padding: .4rem .6rem;
            border-radius: 999px;
        }

        .badge-soft-muted {
            background: rgba(100, 116, 139, .12) !important;
            color: #334155 !important;
            border: 1px solid rgba(100, 116, 139, .25);
            font-weight: 800;
            padding: .4rem .6rem;
            border-radius: 999px;
        }

        /* ===== Action buttons ===== */
        .action-btn {
            border-radius: 999px !important;
            padding: .38rem .75rem;
            font-weight: 800;
        }

        .action-group {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        /* ===== Pagination spacing ===== */
        .card-footer-like {
            padding: 14px;
            border-top: 1px solid #eef2f7;
            background: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-shell">

            {{-- ===== Header ===== --}}
            <div class="hero-card d-flex justify-content-between align-items-start gap-3 flex-wrap">
                <div>
                    <h4 class="hero-title">จัดการผู้ใช้งาน (พนักงาน)</h4>
                    <p class="hero-sub">เพิ่ม/แก้ไขข้อมูลพนักงาน และกำหนดรหัสผ่านเริ่มต้น</p>

                    @php
                        $totalUsers = $users->total();
                        // ใช้ collection ของหน้าปัจจุบันเป็นค่าแสดง (พอสำหรับ UI)
                        $activeCount = $users->getCollection()->where('is_active', true)->count();
                        $inactiveCount = $users->getCollection()->where('is_active', false)->count();
                    @endphp

                    <div class="stats-row">
                        <div class="stat-chip">
                            <div class="stat-ico"><i class="bi bi-people"></i></div>
                            <div>
                                <p class="stat-label">จำนวนผู้ใช้ทั้งหมด</p>
                                <p class="stat-value">{{ $totalUsers }}</p>
                            </div>
                        </div>
                        <div class="stat-chip">
                            <div class="stat-ico"><i class="bi bi-check-circle"></i></div>
                            <div>
                                <p class="stat-label">ใช้งาน (หน้านี้)</p>
                                <p class="stat-value">{{ $activeCount }}</p>
                            </div>
                        </div>
                        <div class="stat-chip">
                            <div class="stat-ico"><i class="bi bi-slash-circle"></i></div>
                            <div>
                                <p class="stat-label">ปิดใช้งาน (หน้านี้)</p>
                                <p class="stat-value">{{ $inactiveCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-pill">
                        <i class="bi bi-person-plus me-1"></i> เพิ่มผู้ใช้
                    </a>
                </div>
            </div>

            {{-- ===== Flash ===== --}}
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: @json(session('success')),
                        confirmButtonColor: '#2563eb'
                    })
                </script>
            @endif


            {{-- ===== Search ===== --}}
            <div class="search-card">
                <form method="GET" class="search-wrap">
                    <div class="search-input">
                        <i class="bi bi-search"></i>
                        <input type="text" name="q" class="form-control" value="{{ $q }}"
                            placeholder="ค้นหา: ชื่อ / นามสกุล / อีเมล / เลขบัตร / โทร">
                    </div>
                    <button class="btn btn-outline-secondary btn-soft">
                        <i class="bi bi-funnel me-1"></i> ค้นหา
                    </button>
                    @if (!empty($q))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-soft">
                            <i class="bi bi-x-circle me-1"></i> ล้าง
                        </a>
                    @endif
                </form>
            </div>

            {{-- ===== Table ===== --}}
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:70px;">#</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th style="min-width:160px;">สำนักงาน/กอง</th>
                                <th style="min-width:160px;">กลุ่มงาน</th>
                                <th style="min-width:220px;">อีเมล</th>
                                <th class="text-center" style="width:120px;">สถานะ</th>
                                <th class="text-end" style="width:220px;">จัดการ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $u)
                                @php
                                    $initials =
                                        mb_strtoupper(mb_substr($u->name ?? '-', 0, 1)) .
                                        mb_strtoupper(mb_substr($u->lastname ?? '-', 0, 1));
                                @endphp

                                <tr class="row-hover">
                                    <td class="text-muted fw-semibold">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </td>


                                    <td>
                                        <div class="fw-semibold">{{ $u->name }} {{ $u->lastname }}</div>
                                        <div class="text-muted small">
                                            เลขบัตร: {{ $u->national_id ?? '-' }}
                                        </div>
                                        <div class="text-muted small">
                                            โทร: {{ $u->phone ?? '-' }}
                                    </td>


                                    <td>{{ $u->division ?? '-' }}</td>
                                    <td>{{ $u->department ?? '-' }}</td>
                                    <td class="text-muted">{{ $u->email ?? '-' }}</td>

                                    <td class="text-center">
                                        @if ($u->is_active)
                                            <span class="badge badge-soft-success">ใช้งาน</span>
                                        @else
                                            <span class="badge badge-soft-muted">ปิด</span>
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <div class="action-group">
                                            <a href="{{ route('admin.users.edit', $u->id) }}"
                                                class="btn btn-sm btn-outline-primary action-btn">
                                                <i class="bi bi-pencil-square me-1"></i> แก้ไข
                                            </a>

                                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger action-btn">
                                                    <i class="bi bi-trash3 me-1"></i> ลบ
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <div class="mb-2" style="font-size:34px; opacity:.5;">
                                            <i class="bi bi-inboxes"></i>
                                        </div>
                                        ยังไม่มีผู้ใช้งาน
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer-like">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: @json(session('success')),
                confirmButtonColor: '#2563eb'
            })
        </script>
    @endif

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'ยืนยันการลบ?',
                    text: 'ข้อมูลผู้ใช้นี้จะถูกลบถาวร',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ลบ',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            })
        })
    </script>
@endpush

