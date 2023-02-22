<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'teacher_name'
    ];

    public function Schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // public function SumJP(){
    //     return $this->Schedules()->count();
    // }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class,'classroom_teacher','teacher_id','classroom_id')
        ->withTimestamps()
        ->withPivot(['school_year_id'])
        ;
    }

}
