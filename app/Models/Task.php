<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['deadline'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function category()
    {
        return $this->belongsTo(TaskCategory::class, 'task_category_id', 'id');
    }

    public function uploads()
    {
        return $this->hasMany(TaskUpload::class);
    }

    public function getDueDate()
    {
        return Carbon::parse($this->deadline)->format('j F Y, H:i:s');
    }

    public function getTimeRemainingAttribute()
    {
        $deadline = Carbon::parse($this->deadline);
        if ($deadline->isPast()) {
            return 'Deadline has passed';
        } else {
            return $deadline->diffForHumans(
                now(),
                CarbonInterface::DIFF_ABSOLUTE,
                false,
                4
            );
        }
    }
}
