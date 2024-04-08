<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestQuestion extends Model
{
    use HasFactory;
    protected $table = 'quest_question';
    protected $fillable = ['teacher_id', 'course_id', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function questStudentAnswer(){
        return $this->hasMany(QuestStudentAnswer::class);
    }
}
