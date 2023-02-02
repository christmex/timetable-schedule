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
        'classroom_id',
        'timetable_id',
        'teacher_id',
        'day_id',
        'subject_lesson_id',
        'no_lesson',
    ];

    public function Classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id','id');
    }

    public function Timetable()
    {
        return $this->belongsTo('App\Models\Timetable', 'timetable_id','id');
    }

    public function SchoolYear()
    {
        return $this->belongsTo('App\Models\SchoolYear', 'school_year_id','id');
    }

    public function Teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id','id');
    }

    public function Day()
    {
        return $this->belongsTo('App\Models\Day', 'day_id','id');
    }

    public function SubjectLesson()
    {
        return $this->belongsTo('App\Models\SubjectLesson', 'subject_lesson_id','id');
    }
}
