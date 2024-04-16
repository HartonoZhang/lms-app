<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpSetting extends Model
{
    use HasFactory;
    protected $table = 'exp_setting';

    protected $fillable = [
        'exp_bronze',
        'exp_silver',
        'exp_gold',
        'exp_purple',
        'exp_emerald',
        'do_quest',
        'do_asg',
        'do_exam',
        'do_project',
        'create_task',
        'create_question',
    ];
}
