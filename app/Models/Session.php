<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $guarded = ['id'];
    protected $dates = ['start_time', 'end_time'];


    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function materials(){
        return $this->hasMany(Material::class);
    }

    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
