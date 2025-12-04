<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class AdminRoomController extends Controller
{
    // แสดงหน้า ห้องประชุมทั้งหมด
    public function index()
    {
        // ตอนนี้ยังไม่ต้องส่งข้อมูลห้องก็ได้
        // ถ้าจะส่งก็ Room::all()
        $rooms = Room::all();

        return view('admin.rooms', compact('rooms'));
    }

    // แสดงฟอร์มเพิ่มห้อง
    public function create()
    {
        return view('admin.rooms_create'); // เดี๋ยวสร้างไฟล์นี้ต่อ
    }

    // รับข้อมูลจากฟอร์มแล้วบันทึก
    public function store(Request $request)
    {
        // 1) validate
        $request->validate([
            'room_name'   => ['required', 'string', 'max:100'],
            'building'    => ['nullable', 'string', 'max:50'],
            'quantity'    => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'room_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // 2) จัดการรูปภาพ
        $imagePath = null;

        if ($request->hasFile('room_image')) {
            $file = $request->file('room_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/rooms'), $fileName);
            $imagePath = 'images/rooms/' . $fileName;
        }

        // 3) บันทึกลงฐานข้อมูล
        Room::create([
            'room_name'   => $request->room_name,
            'building'    => $request->building,
            'quantity'    => $request->quantity ?? 0,
            'description' => $request->description,
            'room_image'  => $imagePath,
        ]);

        // 4) กลับไปหน้าห้องทั้งหมด พร้อมข้อความ
        return redirect()
            ->route('admin.rooms')
            ->with('success', 'เพิ่มห้องประชุมเรียบร้อยแล้ว');
    }

    // แสดงฟอร์มแก้ไขห้อง
    public function edit(Room $room)
    {
        return view('admin.rooms_edit', compact('room'));
    }

    // อัปเดตข้อมูลห้อง
    public function update(Request $request, Room $room)
    {
        // 1) validate
        $request->validate([
            'room_name'   => ['required', 'string', 'max:100'],
            'building'    => ['nullable', 'string', 'max:50'],
            'quantity'    => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'room_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // 2) ถ้ามีการอัปโหลดรูปใหม่
        if ($request->hasFile('room_image')) {

            // ลบรูปเก่า (ถ้ามีในโฟลเดอร์ public)
            if ($room->room_image && file_exists(public_path($room->room_image))) {
                @unlink(public_path($room->room_image));
            }

            $file = $request->file('room_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/rooms'), $fileName);
            $room->room_image = 'images/rooms/' . $fileName;
        }

        // 3) อัปเดตข้อมูลอื่น ๆ
        $room->room_name   = $request->room_name;
        $room->building    = $request->building;
        $room->quantity    = $request->quantity ?? 0;
        $room->description = $request->description;

        $room->save();

        return redirect()->route('admin.rooms')
            ->with('success', 'แก้ไขข้อมูลห้องประชุมเรียบร้อยแล้ว');
    }

    // ลบห้องประชุม
    public function destroy(Room $room)
    {
        // ลบรูปออกจาก public ถ้ามี
        if ($room->room_image && file_exists(public_path($room->room_image))) {
            @unlink(public_path($room->room_image));
        }

        $room->delete();

        return redirect()->route('admin.rooms')
            ->with('success', 'ลบห้องประชุมเรียบร้อยแล้ว');
    }

    // แสดงรายละเอียดห้องประชุม 1 ห้อง
    public function show(Room $room)
    {
        return view('admin.rooms_show', compact('room'));
    }
}
