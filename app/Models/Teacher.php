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

    public function getDetailSchedule() {
        // $group_by_classs = $this->Schedules()->with('Classroom')->get()->groupBy('Classroom.classname')->toArray();
        $group_by_classs = $this->Schedules()
                     ->with('Classroom')
                     ->get()
                     ->groupBy('Classroom.classname')
                     ->map(function ($items) {
                         return count($items);
                     });
        $detail = "";
        $loop = 1;
        // $group_by_classs;
        // dd($group_by_classs->count());
        foreach ($group_by_classs as $key => $value) {
            $detail .= $value." Jam Mengajar di Kelas ".$key;
            if($group_by_classs->count() == 1 || $group_by_classs->count() == $loop){
                $detail .= ".";
            }
            elseif($group_by_classs->count() > 1){
                $detail .= ", ";
            }
            $loop++;
        }
        // for ($i=0; $i < count($group_by_classs); $i++) { 
            
        // }
        return $detail;
        // $detail = "Mengajar di kelas";
        // return $detail;
        // return '<a href="'.url($this->id).'" target="_blank">'.$this->id.'</a>';
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
