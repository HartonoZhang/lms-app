<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['course_id','code', 'name', 'student_capacity'];
    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function teacherClassroom(){
        return $this->hasMany(TeacherClassroom::class);
    }

    public function studentClassroom(){
        return $this->hasMany(StudentClassroom::class);
    }

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
    use HasFactory;
}
