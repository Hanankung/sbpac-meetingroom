<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'room_id',
        'booking_date',
        'start_time',
        'end_time',
        'meeting_topic',
        'department',
        'name',
        'lastname',
        'phone',
        'email',
    ];

    // ความสัมพันธ์: การจอง 1 รายการ อยู่ในห้องประชุม 1 ห้อง
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

    
}
