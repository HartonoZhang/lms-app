<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','code','min_score'];
    use HasFactory;

    public function classroom(){
        return $this->hasMany(Classroom::class);
    }
}
