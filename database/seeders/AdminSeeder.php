<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'name'     => 'SBPAC Admin',
            'email'    => 'admin123@sbpac.go.th',
            'password' => Hash::make('sbpac1234'), // เปลี่ยนรหัสตามที่คุณต้องการ
        ]);
    }
}
