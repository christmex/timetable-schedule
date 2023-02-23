<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Day;
use Livewire\Component;
use App\Models\Schedule;
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
        // 'form_day_id' => 'required|array',
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

    public function send_alert($type,$text){
        $this->dispatchBrowserEvent('alert_dispatch', ['text' => $text,"type" => $type]);
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
        // dd($validate);
        if($validate) {
            
            $doAction = Schedule::where('school_year_id',$this->form_school_year_id)
            // ->whereIn('day_id', $this->form_day_id)
            ->whereIn('timetable_id', $this->form_timetable_id)
            ->whereIn('classroom_id', $this->form_classroom_id)
            ->delete();

            // dd($this->form_timetable_id);

            // Send alert to script and reset All error
            if($doAction){
                $this->send_alert('success',"Success deleted schedule, total affected row = ".$doAction);
                $this->resetAll();
            }else {
                $this->send_alert('error',"Failed deleted schedule");
                return false;
            }
        }
    }
}
