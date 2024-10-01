<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable =[
        'school_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'isEnrolled',
    ];

    protected $hidden = [
        'password'
    ];
}
