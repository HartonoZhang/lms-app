<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $guarded = ['id'];

    public function Class(){
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }

    public function Materials(){
        return $this->hasMany(Material::class);
    }

    public function Threads(){
        return $this->hasMany(Thread::class);
    }

    public function Attendances(){
        return $this->hasMany(Attendance::class);
    }
}
