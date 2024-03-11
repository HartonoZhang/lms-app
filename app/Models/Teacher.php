<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';

    protected $fillable = [
        'user_id',
        'profile_id',
        'name',
        'lasted_education'
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
        return $this->hasMany(TeacherClassroom::class);
    }
}
