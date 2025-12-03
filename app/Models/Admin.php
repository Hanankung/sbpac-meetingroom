<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    // ฟิลด์ที่ให้กรอกได้ (mass assign)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // ไม่อยากให้คืน password ตอนแปลงเป็น array/json
    protected $hidden = [
        'password',
    ];
}
