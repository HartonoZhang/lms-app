<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function getFormattedDate(){
        return Carbon::parse($this->created_at)->format('j F Y, H:i:s');;
    }
}
