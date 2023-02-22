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
use Illuminate\Database\Eloquent\Collection;

class Card extends Component
{
    public $school_year_id;
    public $classroom_id;
    public $day_id;
    public $timetable_id;
    public $amount;

    public $resultFindIdleTeacher;

    public function render()
    {

        $Teachers = Teacher::all();
        // $Classroom = Classroom::count();
        $SubjectLesson = SubjectLesson::count();

        $SchoolYears = SchoolYear::all();
        $Classrooms = Classroom::all();
        $Days = Day::all();
        $Timetables = Timetable::all();


        // $schedule = Schedule::with('SchoolYear','Classroom','Teacher','SubjectLesson','Timetable','Day')->get();

        // $schedule->groupBy('school_year_id')->map(function (Collection $school_year_id) {
        //     $school_year_id->groupBy('day_id')->map(function (Collection $day_id) {
        //         $day_id->groupBy('classroom_id')->map(function (Collection $classroom_id) {
        //             $classroom_id->pluck('subject_lesson_id');
        //         });
        //     });
        // });

        // dd($schedule);

        // $test = Schedule::get();
        // $groupByDay = $test->groupBy('day_id')->all();
        // dd(collect($groupByDay)->groupBy(('classroom_id')));

        // $test = Schedule::with('SchoolYear','Classroom','Teacher','SubjectLesson','Timetable','Day')->get();
        // // $groupByDay = $test->groupBy(['day_id','classroom_id'])->all();
        // $groupByDay = $test->groupBy(['day_id'])->all();
        // foreach ($groupByDay as $value) {
        //     echo $value."<br><br>";
        // }
        // die();
        // dd($groupByDay);
        // dd(collect($groupByDay)->groupBy(('classroom_id')));


        // $test = Schedule::get()->groupBy('day_id', function ($query) {
        //     $query->groupBy('classroom_id');
        // })->all();

        // dd($test);

        // dd(collect($groupByDay)->groupBy(('classroom_id')));




        return view('livewire.widgets.card',compact('Teachers','SubjectLesson','SchoolYears','Classrooms','Days','Timetables'));
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
            $this->resultFindIdleTeacher = null;
        }

    }
}
