<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'time_login',
        'time_logout',
    ];
}
