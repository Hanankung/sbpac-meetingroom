<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('users.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'login'    => 'required|string',   // email หรือ เลขบัตรประชาชน
        'password' => 'required|string',
    ]);

    $login = trim($request->login);

    // ถ้าเป็นอีเมล → ใช้ email, ถ้าไม่ใช่ → ใช้ national_id
    $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'national_id';

    // เช็ค user + active ก่อน
    $user = User::where($field, $login)->first();
    if (!$user) {
        return back()->withErrors(['login' => 'ไม่พบบัญชีผู้ใช้งาน'])->withInput();
    }
    if (!$user->is_active) {
        return back()->withErrors(['login' => 'บัญชีนี้ถูกปิดการใช้งาน'])->withInput();
    }

    // ✅ อย่าใส่ remember=true ถ้าตาราง users ไม่มี remember_token
    if (Auth::attempt([$field => $login, 'password' => $request->password], false)) {
        $request->session()->regenerate();
        return redirect()->intended(route('users.rooms'));
    }

    return back()->withErrors(['password' => 'รหัสผ่านไม่ถูกต้อง'])->withInput();
}



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
