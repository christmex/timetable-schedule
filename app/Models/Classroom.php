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

    public function setClassnameAttribute($value)
    {
        $this->attributes['classname'] = ucwords($value);
    }

    public function Schedules()
    {
        return $this->hasMany(Schedule::class)->where('no_lesson',0)
        ->whereNull('teacher_id')
        ->whereNull('subject_lesson_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'classroom_teacher','classroom_id','teacher_id')
        ->withTimestamps()
        ->withPivot(['school_year_id'])
        ;
    }
}
