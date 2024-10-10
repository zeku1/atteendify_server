<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_session_id',
        'student_id',
        'time'
    ];

    public function classSession()
    {
        return $this->belongsTo(ClassSession::class, 'class_session_id'); // This references ClassSession
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
