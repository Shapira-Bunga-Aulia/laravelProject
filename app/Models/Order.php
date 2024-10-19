<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'students',
        'name_student',
        'total_nis',
    ];

    protected $casts = [
        'students' => 'array', 
    ];
}
