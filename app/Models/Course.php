<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name','code'];
    use HasFactory;

    public function classroom(){
        return $this->hasMany(Classroom::class);
    }
}
