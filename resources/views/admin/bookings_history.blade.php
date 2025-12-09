@extends('admin.layout')

@section('title', 'ประวัติการจอง | ระบบจองห้องประชุม ศอ.บต.')

@push('styles')
    <style>
        main {
            background: #f3f4f6;
        }

        .page-header-card {
            background: #fff;
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .table-wrapper {
            background: white;
            border-radius: 18px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        table thead {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
        }

        table th {
            font-weight: 700;
            font-size: 14px;
            padding: 12px;
        }

        table td {
            font-size: 14px;
            padding: 12px;
            vertical-align: middle;
        }

        .btn-detail {
            background: #facc15;
            border-radius: 999px;
            font-size: 13px;
            padding: 6px 16px;
            color: #000;
            font-weight: 600;
            border: 0;
        }

        .btn-detail:hover {
            background: #eab308;
        }
    </style>
@endpush

@section('content')

    <div class="page-header-card d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-clock-history" style="font-size:22px;"></i>
            <span class="page-title">ประวัติการจอง</span>
        </div>

        <div class="input-group" style="max-width:250px;">
            <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
            </span>
            <input disabled type="text" class="form-control" placeholder="ค้นหา...">
        </div>
    </div>

    <div class="table-wrapper">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>วันที่จอง</th>
                    <th>วันที่ใช้ห้อง</th>
                    <th>เวลา</th>
                    <th>ชื่อ - สกุล</th>
                    <th>ห้องประชุม</th>
                    <th class="text-center">รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>
                            {{-- วันที่จอง ใช้ created_at --}}
                            {{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}
                        </td>

                        <td>
                            {{-- วันที่ใช้ห้อง ใช้ booking_date --}}
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}
                        </td>

                        <td>
                            {{-- เวลา --}}
                            {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                        </td>

                        <td>
                            {{-- ชื่อ - สกุล --}}
                            {{ $booking->name }} {{ $booking->lastname }}
                        </td>

                        <td>
                            {{-- ชื่อห้อง --}}
                            {{ $booking->room->room_name ?? '-' }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn-detail">รายละเอียด</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        {{-- มี 6 คอลัมน์ ต้อง colspan="6" --}}
                        <td colspan="6" class="text-center text-muted py-4">
                            ยังไม่มีประวัติการจอง
                        </td>
                    </tr>
                @endforelse
            </tbody>


    </div>

@endsection
