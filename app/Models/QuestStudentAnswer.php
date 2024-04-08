<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestStudentAnswer extends Model
{
    use HasFactory;
    protected $table = 'quest_student_answer';
    protected $fillable = ['student_id', 'quest_question_id', 'answer', 'status'];

    public function questQuestion(){
        return $this->belongsTo(QuestQuestion::class);
    }
    
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
