@extends('admin.layout')

@section('title', 'จัดการผู้ใช้งาน | ศอ.บต.')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold">จัดการผู้ใช้งาน (พนักงาน)</h4>
            <div class="text-muted small">เพิ่ม/แก้ไขข้อมูลพนักงาน และกำหนดรหัสผ่านเริ่มต้น</div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i> เพิ่มผู้ใช้
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" value="{{ $q }}" placeholder="ค้นหา ชื่อ/นามสกุล/อีเมล/เลขบัตร">
                <button class="btn btn-outline-secondary">ค้นหา</button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>สำนักงาน/กอง</th>
                        <th>กลุ่มงาน</th>
                        <th>อีเมล</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-end">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $u->name }} {{ $u->lastname }}</div>
                                <div class="text-muted small">เลขบัตร: {{ $u->national_id ?? '-' }} | โทร: {{ $u->phone ?? '-' }}</div>
                            </td>
                            <td>{{ $u->division ?? '-' }}</td>
                            <td>{{ $u->department ?? '-' }}</td>
                            <td>{{ $u->email ?? '-' }}</td>
                            <td class="text-center">
                                @if($u->is_active)
                                    <span class="badge bg-success">ใช้งาน</span>
                                @else
                                    <span class="badge bg-secondary">ปิด</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-sm btn-outline-primary">
                                    แก้ไข
                                </a>
                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('ยืนยันลบผู้ใช้นี้?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">ยังไม่มีผู้ใช้งาน</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-body">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection
