<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'room_name',
        'building',
        'organization',
        'department',
        'room_image',
    ];
}
