<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class UserRoomController extends Controller
{
    // แสดงรายการห้องประชุมให้ผู้ใช้เห็น
    public function index()
    {
        // ดึงห้องทั้งหมดจากฐานข้อมูล
        $rooms = Room::all();

        // ส่งไปหน้า users.rooms
        return view('users.rooms', compact('rooms'));
    }

    // หน้า "รายละเอียดห้อง 1 ห้อง" ฝั่งผู้ใช้
    public function show(Room $room)
    {
        return view('users.rooms_show', compact('room'));
    }
}
