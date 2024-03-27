<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = ['session_id','title', 'value', 'is_file'];

    
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

}
