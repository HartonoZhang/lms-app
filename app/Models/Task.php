<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['deadline'];

    public function category(){
        return $this->belongsTo(TaskCategory::class, 'task_category_id', 'id');
    }

    public function uploads(){
        return $this->hasMany(TaskUpload::class);
    }

    public function getDueDate(){
        return Carbon::parse($this->deadline)->format('j F Y, H:i:s');
    }

    public function getTimeRemaining(){
        $deadline = Carbon::parse($this->deadline);
        if ($deadline->isPast()) {
            return 'Deadline has passed';
        } else {
            return $deadline->diffForHumans(null, [
                'parts' => 3,
                'short' => true
            ]);
        }
    }
}
