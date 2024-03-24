<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUpload extends Model
{
    protected $guarded = ['id'];

    public function task(){
        return $this->belongsTo(Task::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
