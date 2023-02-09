<?php

namespace App\Http\Livewire\TeacherSchedule;

use Alert;
use App\Models\Day;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\SubjectLesson;

class Index extends Component
{
    public $Teachers;
    public $SchoolYears;
    public $Days;

    public $Classrooms;
    public $SubjectLessons;

    public $form_school_year_id;
    public $form_day_id = [];
    public $form_classroom_id = [];
    public $form_teacher_id;
    public $form_subject_lesson_id;
    public $form_teaching_amount;
    
    protected $rules = [
        'form_school_year_id' => 'required',
        'form_day_id' => 'required|array',
        'form_classroom_id' => 'required|array',
        'form_teacher_id' => 'required',
        'form_subject_lesson_id' => 'required',
        'form_teaching_amount' => 'required'
    ];

    public function mount(){
        $this->SchoolYears = SchoolYear::latest()->get();
        
        $this->Teachers = Teacher::all();
        $this->SubjectLessons = SubjectLesson::all();
    }

    public function render()
    {
        $this->Days = Day::withCount('Schedules')->get();
        $this->Classrooms = Classroom::withCount('Schedules')->get();
        return view('livewire.teacher-schedule.index');
    }

    public function resetAll(){
        $this->resetValidation();
        $this->resetErrorBag();
        $this->form_school_year_id = '';
        $this->form_day_id = [];
        $this->form_classroom_id = [];
        $this->form_teacher_id = '';
        $this->form_subject_lesson_id = '';
        $this->form_teaching_amount = '';
    }

    public function send_alert($type,$text){
        $this->dispatchBrowserEvent('alert_dispatch', ['text' => $text,"type" => $type]);
    }

    public function submit(){
        
        // syntax ini digunakan untuk melakukan validasi
        $validate = $this->validate();

        // Cek apakah validasi berhasil dilakukan
        if($validate) {

            // Pilih semua data dari tabel schedule berdasarkan school_year_id dan classroom_id
            // $querySchedule = Schedule::with('Classroom','Teacher','SubjectLesson')
            // ->where('school_year_id', $this->form_school_year_id)
            // ->whereIn('classroom_id', $this->form_classroom_id)
            // ->get();

            // Cek jika mata pelajaran yang dipilih sudah terdapat guru yang mengajar di kelas itu
            $check_subject_lesson = Schedule::with('Classroom','Teacher','SubjectLesson')
            ->where('school_year_id', $this->form_school_year_id)
            ->whereIn('classroom_id', $this->form_classroom_id)
            ->where('subject_lesson_id',$this->form_subject_lesson_id)->get();
            if($check_subject_lesson->count()){
                $this->send_alert("warning","Pelajaran ".$check_subject_lesson->first()->SubjectLesson->subject_name." di kelas ".$check_subject_lesson->first()->Classroom->classname." sudah di ajarkan oleh ".$check_subject_lesson->first()->Teacher->teacher_name);
                return false;
            }

            // Cek data berdasarkan guru dan mata pelajaran berdasarkan classroom
            $check_teacher_and_subject_lesson = Schedule::where('school_year_id', $this->form_school_year_id)
            ->whereIn('classroom_id', $this->form_classroom_id)
            ->where('subject_lesson_id',$this->form_subject_lesson_id)
            ->where('teacher_id',$this->form_teacher_id)
            ->whereIn('day_id',$this->form_day_id)->get();
            if($check_teacher_and_subject_lesson->count()){
                $this->send_alert('warning',"data sudah ada silahkan masukkan manual di menu schedule, fitur untuk melengkapi sisa jam pelajaran yang belum terisi atau kurang berdasarkan jam pelajaran guru secara otomatis belum tersedia, ini juga untuk menghindari duplikasi data");
                return false;
            }

            // ambil data berdasarkan, school_year,classroom,day,no_lesson=0, teacher_id = null, subject_lesson = null
            $query_to_select = Schedule::where('school_year_id', $this->form_school_year_id)
            ->whereIn('classroom_id', $this->form_classroom_id)
            ->whereIn('day_id', $this->form_day_id)
            ->where('no_lesson', 0)
            ->whereNull('teacher_id')
            ->whereNull('subject_lesson_id')->get();
            // dd($query_to_select);
            // Cek apakah jumlah jam pelajaran yang kosong tersedia dan tidak kurang dari jam mengajar guru 
            if($this->form_teaching_amount > $query_to_select->count()){
                $this->send_alert('warning',"jam pelajaran yang tersedia kurang dari waktu jam mengajar guru di hari yang telah dipilih, silahkan cek secara manual jumlah jam kosong di hari yang dipilih untuk memastikan");
                return false;
            }else {
                // Cek apakah kelas yang di ajar lebih banyak dibanding jumlah jam mengajar
                if(count($this->form_classroom_id) > $this->form_teaching_amount){
                    $this->send_alert('warning',"jam mengajar lebih sedikit dari kelas yang akan di ajar");
                    return false;
                }else {
                    // Bagi total jam mengajar dengan banyaknya kelas yang akan di ajar
                    $jp_bagi_kelas = floor($this->form_teaching_amount / count($this->form_classroom_id));
                    // sisa hasil pembagian di atas
                    $cek_selisih = $jp_bagi_kelas * count($this->form_classroom_id) == $this->form_teaching_amount ? 0 : $this->form_teaching_amount - $jp_bagi_kelas * count($this->form_classroom_id) ;

                    // Cek apakah jam pelajaran tiap kelas tidak kurang dari hari" yang dipilih, semisal satu kelas hanya mendapatkan 4 jam pelajaran dan user memilih 5 hari maka ini tidak bisa dilanjutkan.
                    if(count($this->form_day_id) > $jp_bagi_kelas){
                        $this->send_alert('warning',"hari yang dipilih terlalu banyak dari pada hasil pembagian jam pelajaran dalam tiap kelas yang di ajar");
                        return false;
                    }else {
                        if($cek_selisih){
                            // Lakukan penamnahan selisih yang ada, dari hasil pemeriksaan di jadal mengajar sepertinya semuanya harus sama jadi tidak ada selisih jam mengajar, semisal ngajar di mathew 1 dan 2, tidak ada case yang menampilkan guru a mengajar di mathew 1 5 jam pelajaran sedangkan di mathew 2 hanya 4 jam
                            $this->send_alert('warning',"Silahkan cek kembali, jam mengajar tidak balance dengan jumlah kelas yang di ajar");
                            return false;
                        }else {
                            $total_jp_bagi_kelas_dibagi_hari = $jp_bagi_kelas / count($this->form_day_id);
                            $convert_query_to_select = $query_to_select->groupBy('day_id')->all();//convert or group by day

                            $collection_jp_id = [];
                            $final_collection_jp_id = [];

                            foreach ($convert_query_to_select as $Byday) {
                                for ($j=0; $j < count($this->form_classroom_id); $j++) {
                                    
                                    $select_class = $Byday->where('classroom_id', $this->form_classroom_id[$j]);
                                    $random = rand(0, count($select_class) - $total_jp_bagi_kelas_dibagi_hari);

                                    array_push($collection_jp_id, collect($select_class->skip($random)->take($total_jp_bagi_kelas_dibagi_hari)->modelKeys())->toArray());
                                }
                            }

                            for ($i=0; $i < count($collection_jp_id); $i++) {
                                for ($j=0; $j < count(array_values($collection_jp_id[$i])); $j++) { 
                                    array_push($final_collection_jp_id, array_values($collection_jp_id[$i])[$j]);
                                    
                                }
                            }

                            // update the data
                            $update_data = Schedule::whereIn('id', $final_collection_jp_id)->update([
                                'teacher_id' => $this->form_teacher_id,
                                'subject_lesson_id' => $this->form_subject_lesson_id,
                            ]);

                            // Send alert to script and reset All error
                            if($update_data){
                                $this->send_alert('success',"Success adding new teacher schedule");
                                $this->resetAll();
                            }else {
                                $this->send_alert('error',"Failed");
                                return false;
                            }

                            // dd($final_collection_jp_id);


                        }


                    }

                }
            }

        }
    }
}
