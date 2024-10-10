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

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function sessionParticipants()
    {
        return $this->hasMany(SessionParticipant::class, 'class_session_id');
    }

    
}
