<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $id = 'id';
    protected $fillable = [
        'id',
        'room',
        'data_user',
        'checkin',
        'checkout',
        'total',
        'status'
    ];
}
