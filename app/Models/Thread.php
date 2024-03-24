<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['session_id', 'user_id', 'title', 'description'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDate()
    {
        return Carbon::parse($this->created_at)->format('j F Y, H:i:s');;
    }
}
