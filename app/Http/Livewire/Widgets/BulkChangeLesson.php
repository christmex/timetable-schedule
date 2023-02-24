<?php

namespace App\Http\Livewire\Widgets;

use Alert;
use App\Models\Day;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Models\SchoolYear;
use App\Models\SubjectLesson;

class BulkChangeLesson extends Component
{
    public $form_school_year_id;
    public $form_day_id = [];
    public $form_classroom_id = [];
    public $form_timetable_id = [];
    public $form_no_lesson = false;
    public $form_subject_lesson_id =NULL;
    public $form_teacher_id=NULL;

    protected $rules = [
        'form_school_year_id' => 'required',
        'form_day_id' => 'required|array',
        'form_classroom_id' => 'required|array',
        'form_timetable_id' => 'required|array',
        'form_no_lesson' => 'boolean',
    ];

    public function resetAll(){
        $this->resetValidation();
        $this->resetErrorBag();
        $this->form_school_year_id = '';
        $this->form_day_id = [];
        $this->form_classroom_id = [];
        $this->form_timetable_id = [];
        $this->form_no_lesson = false;
        $this->form_subject_lesson_id = NULL;
        $this->form_teacher_id = NULL;
    }

    public function send_alert($type,$text){
        $this->dispatchBrowserEvent('alert_dispatch', ['text' => $text,"type" => $type]);
    }

    public function render()
    {
        $SchoolYears = SchoolYear::all();
        $Classrooms = Classroom::withCount('schedules')->get();
        $Days = Day::all();
        $Timetables = Timetable::all();
        $SubjectLessons = SubjectLesson::all();
        $Teachers = Teacher::all();

        return view('livewire.widgets.bulk-change-lesson',compact('Classrooms','SchoolYears','Days','Timetables','SubjectLessons','Teachers'));
    }

    public function update(){
        $validate = $this->validate();
        
        if($validate) {
            // $doAction = Schedule::where('school_year_id',$this->form_school_year_id)
            // ->whereIn('day_id', $this->form_day_id)
            // ->whereIn('timetable_id', $this->form_timetable_id)
            // ->whereIn('classroom_id', $this->form_classroom_id)


            // // ->whereNot('subject_lesson_id', $this->form_subject_lesson_id)
            // ->whereNot('teacher_id', $this->form_teacher_id)
            // ->get();

            $doAction = Schedule::where('school_year_id', $this->form_school_year_id)
            ->whereIn('day_id', $this->form_day_id)
            ->whereIn('timetable_id', $this->form_timetable_id)
            ->whereIn('classroom_id', $this->form_classroom_id)
            // ->where(function ($query) {
            //     $query->whereNot('teacher_id', $this->form_teacher_id)
            //           ->orWhereNull('teacher_id');
            // })
            // ->where(function ($query) {
            //     $query->whereNot('subject_lesson_id', $this->form_subject_lesson_id)
            //           ->orWhereNull('subject_lesson_id');
            // })
            // ->get();
            // dd($doAction->pluck('id')->toArray());

            // $doAction = Schedule::where('school_year_id', 1)
            // ->whereIn('day_id', [4])
            // ->whereIn('timetable_id', [3, 2])
            // ->whereIn('classroom_id', [1, 3, 2])
            // ->where(function ($query) {
            //     $query->whereNotIn('teacher_id', [36])
            //           ->orWhereNull('teacher_id');
            // })
            // ->get();
            ->update([
                'teacher_id' => NULL,
                'subject_lesson_id' => NULL,
                'no_lesson' => $this->form_no_lesson
            ]);

            // if(!empty($get_teacher_timetable_based_on_day)){
            //     // Alert::error("Di jam ".$this->crud->getCurrentEntry()->Timetable->subject." ".$get_teacher_timetable_based_on_day->Teacher->teacher_name." sudah mengajar di kelas ".$get_teacher_timetable_based_on_day->Classroom->classname)->flash();
            //     // return redirect()->back()->withInput();
            // }

            // Get all timetable  based on teacher, day 
            // $get_teacher_timetable_based_on_day = Schedule::with('Timetable','Teacher','Classroom')
            // ->where('school_year_id', $this->form_school_year_id)
            // ->whereIn('day_id', $this->form_day_id)
            // ->whereIn('timetable_id', $this->form_timetable_id)
            // ->where('teacher_id', $this->form_teacher_id)
            // ->whereNotIn('id', $doAction->pluck('id')->toArray())
            // ->get();

            // dd($get_teacher_timetable_based_on_day);

            // if(!empty($get_teacher_timetable_based_on_day)){
            //     $this->send_alert('error',"Di jam ".$get_teacher_timetable_based_on_day->Timetable->subject." ".$get_teacher_timetable_based_on_day->Teacher->teacher_name." sudah mengajar di kelas ".$get_teacher_timetable_based_on_day->Classroom->classname);
            //     return false;
            // }

            
            // dd($get_teacher_timetable_based_on_day);

            // Send alert to script and reset All error
            if($doAction){
                $this->send_alert('success',"Success update schedule, total affected row = ".$doAction);
                $this->resetAll();
            }else {
                $this->send_alert('error',"Failed update schedule");
                return false;
            }
        }
    }
}
