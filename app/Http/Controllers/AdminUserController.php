<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $users = User::query()
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('lastname', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('national_id', 'like', "%{$q}%");
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'national_id' => ['nullable','string','max:50'],
            'name'        => ['required','string','max:255'],
            'lastname'    => ['nullable','string','max:255'],
            'phone'       => ['nullable','string','max:50'],
            'division'    => ['nullable','string','max:255'],
            'department'  => ['nullable','string','max:255'],
            'email'       => ['nullable','email','max:255','unique:users,email'],
            'password'    => ['required','string','min:6'],
            'is_active'   => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        // ถ้า User model มี cast password => hashed แล้ว บรรทัดนี้ไม่จำเป็น
        // แต่ใส่ไว้ก็ไม่เสียหาย (แนะนำเลือกอย่างใดอย่างหนึ่ง)
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'เพิ่มผู้ใช้เรียบร้อยแล้ว');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'national_id' => ['nullable','string','max:50'],
            'name'        => ['required','string','max:255'],
            'lastname'    => ['nullable','string','max:255'],
            'phone'       => ['nullable','string','max:50'],
            'division'    => ['nullable','string','max:255'],
            'department'  => ['nullable','string','max:255'],
            'email'       => ['nullable','email','max:255','unique:users,email,'.$user->id],
            'password'    => ['nullable','string','min:6'], // ถ้าไม่กรอก = ไม่เปลี่ยน
            'is_active'   => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'แก้ไขผู้ใช้เรียบร้อยแล้ว');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'ลบผู้ใช้เรียบร้อยแล้ว');
    }
}
