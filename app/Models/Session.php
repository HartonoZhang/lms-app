<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    protected $guarded = ['id'];

    public function Materials(){
        return $this->hasMany(Material::class);
    }

    public function Threads(){
        return $this->hasMany(Thread::class);
    }
}
