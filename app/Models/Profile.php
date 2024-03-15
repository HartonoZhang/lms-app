<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';

    protected $fillable = [
        'address_id',
        'dob',
        'gender',
        'phone_number',
        'religion',
        'level',
        'current_exp',
        'badge_name'
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
