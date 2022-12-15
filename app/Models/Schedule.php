<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'school_year_id',
        'teacher_id',
        'classroom_id',
        'day_id',
        'timetable_id',
        'subject_lesson_id'
    ];
}
