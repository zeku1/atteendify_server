<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    use HasFactory;

    protected $fillable =[
        'section_id',
        'date',
        'start_time',
        'end_time'
    ];
}
