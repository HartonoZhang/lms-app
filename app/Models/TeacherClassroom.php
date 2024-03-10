<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassroom extends Model
{
    protected $fillable = ['classroom_id','teacher_id'];
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function teacher(){
        return $this->belongsTo(TeacherClassroom::class);
    }
    use HasFactory;
}
