<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpLog extends Model
{
    protected $table = 'exp_log';
    protected $fillable = ['user_id','message'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
