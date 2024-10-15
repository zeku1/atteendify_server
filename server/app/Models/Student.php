<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory, HasApiTokens;

    protected $casts = [
        'isEnrolled' => 'boolean'
    ];

    protected $fillable =[
        'school_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'isEnrolled',
        'image_link',
        'verification_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function classParticipants()
    {
        return $this->hasMany(ClassParticipant::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(ClassSession::class, 'session_participant', 'student_id', 'class_session_id');
    }

    public function sections()
    {
        return $this->hasManyThrough(Section::class, ClassParticipant::class, 'student_id', 'id', 'id', 'section_id');
    }

}
