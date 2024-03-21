<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';

    protected $fillable = [
        'user_id',
        'profile_id',
        'graduation_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function classroom(){
        return $this->hasMany(StudentClassroom::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function attendanceBySession($sessionId = null){
        if ($sessionId) {
            return $this->hasOne(Attendance::class)->where('session_id', $sessionId);
        }
        return $this->hasOne(Attendance::class);
    }
}
