<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * ฟิลด์ที่อนุญาตให้ mass assign
     */
    protected $fillable = [
        'national_id',
        'name',
        'lastname',
        'phone',
        'division',
        'department',
        'email',
        'password',
        'is_active',
    ];

    /**
     * ฟิลด์ที่ไม่ให้แสดงออก (เช่น JSON)
     */
    protected $hidden = [
        'password',
    ];

    /**
     * cast ประเภทข้อมูล
     */
    protected function casts(): array
    {
        return [
            'password'  => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * scope: เฉพาะพนักงานที่ยังใช้งานได้
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function bookings()
{
    return $this->hasMany(\App\Models\Booking::class);
}

}
