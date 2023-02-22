<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Day;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Models\SchoolYear;

class BulkDeleteSchedules extends Component
{
    public $form_school_year_id;
    public $form_day_id = [];
    public $form_classroom_id = [];
    public $form_timetable_id = [];

    protected $rules = [
        'form_school_year_id' => 'required',
        'form_day_id' => 'required|array',
        'form_classroom_id' => 'required|array',
        'form_timetable_id' => 'required|array',
    ];

    public function resetAll(){
        $this->resetValidation();
        $this->resetErrorBag();
        $this->form_school_year_id = '';
        $this->form_day_id = [];
        $this->form_classroom_id = [];
        $this->form_timetable_id = [];
    }

    public function render()
    {
        $SchoolYears = SchoolYear::all();
        $Classrooms = Classroom::withCount('schedules')->get();
        $Days = Day::all();
        $Timetables = Timetable::all();

        return view('livewire.widgets.bulk-delete-schedules',compact('Classrooms','SchoolYears','Days','Timetables'));
    }

    public function delete(){
        $validate = $this->validate();

        if($validate) {
            
        }
    }
}
