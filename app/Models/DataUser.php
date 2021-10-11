<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;
    protected $table = 'data_users';
    protected $id = 'id';
    protected $fillable = [
        'id',
        'name',
        'birth_date',
        'phone',
        'email',
        'user_id'
    ];
}
