<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'teacher_id',
        'teacher_name',
        'year',
        'semester'
    ];

    public function classSessions()
    {
        return $this->hasMany(ClassSession::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
