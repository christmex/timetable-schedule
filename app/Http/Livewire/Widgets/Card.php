<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Day;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Models\SchoolYear;
use App\Models\SubjectLesson;

class Card extends Component
{
    public $school_year_id;
    public $classroom_id;
    public $day_id;
    public $timetable_id;

    public $resultFindIdleTeacher;

    public function render()
    {
        $Teachers = Teacher::count();
        // $Classroom = Classroom::count();
        $SubjectLesson = SubjectLesson::count();

        $SchoolYears = SchoolYear::all();
        $Classrooms = Classroom::all();
        $Days = Day::all();
        $Timetables = Timetable::all();

        return view('livewire.widgets.card',compact('Teachers','Classrooms','SubjectLesson','SchoolYears','Classrooms','Days','Timetables'));
    }

    public function find(){
        if($this->school_year_id && $this->classroom_id && $this->day_id && $this->timetable_id){
            $resultFindIdleTeacher = Teacher::whereDoesntHave('Schedules', function ($query) {
                $query->where('school_year_id', $this->school_year_id)
                ->where('classroom_id',$this->classroom_id)
                ->where('day_id',$this->day_id)
                ->where('timetable_id',$this->timetable_id);
            })->get();
    
            $this->resultFindIdleTeacher = $resultFindIdleTeacher;
            $this->dispatchBrowserEvent('alert_dispatch', ['text' => 'Success find idle teacher there is '.$resultFindIdleTeacher->count().' idle teacher at that time',"type" => 'success']);
        }else {
            $this->dispatchBrowserEvent('alert_dispatch', ['text' => 'Please fill out the form',"type" => 'warning']);
        }

    }
}
