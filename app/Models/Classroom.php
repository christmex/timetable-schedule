<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    
    protected $fillable = [
        'classname'
    ];

    public function Schedules()
    {
        return $this->hasMany(Schedule::class)->where('no_lesson',0)
        ->whereNull('teacher_id')
        ->whereNull('subject_lesson_id');
    }
}
