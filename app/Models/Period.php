<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods';

    protected $fillable = [
        'name'
    ];

    public function classroom(){
        return $this->hasMany(Classroom::class);
    }
    use HasFactory;
}
