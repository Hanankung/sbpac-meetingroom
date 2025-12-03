<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // แสดงหน้า login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // รับฟอร์ม login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return back()
                ->withErrors(['email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'])
                ->withInput();
        }

        // เก็บสถานะว่าแอดมินล็อกอินแล้ว
        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_name', $admin->name);

        // ไปหน้า Dashboard (เดี๋ยวสร้าง route ง่าย ๆ ให้)
        return redirect()->route('admin.index');
    }

    // ออกจากระบบ
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
