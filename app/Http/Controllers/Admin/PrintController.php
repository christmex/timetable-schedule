<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Day;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    //
    public function student(Request $request){
        // dd(Teacher::withCount('Schedules')->get());

        // Use this for assign the homeroom teacher for every class with school year
        // $tc = Teacher::find(1);
        // $ClassroomTeacher = Classroom::find($request->classroom_id);

        // if(!$ClassroomTeacher->teachers()->where('school_year_id',$request->school_year_id)->count()){

            // syncWithoutDetaching -> use this insted of use if for check if value already exist
        //     dd($ClassroomTeacher->teachers()->attach($tc, ['school_year_id' => $request->school_year_id]));
        // }else {
        //     dd('sudah ada');
        // }
        // Use this for assign the homeroom teacher for every class with school year
        
        

        // $schedule = Schedule::with('SchoolYear', 'Classroom', 'Teacher', 'SubjectLesson', 'Timetable', 'Day')
        // ->orderBy('Timetable.start','asc')
        // ->where('school_year_id',$request->school_year_id)
        // ->where('classroom_id',$request->classroom_id)
        // ->get();

        $schedule = Schedule::where('schedules.school_year_id', $request->school_year_id)
        ->where('schedules.classroom_id', $request->classroom_id)
        ->leftJoin('school_years', 'schedules.school_year_id', '=', 'school_years.id')
        ->leftJoin('classrooms', 'schedules.classroom_id', '=', 'classrooms.id')
        ->leftJoin('teachers', 'schedules.teacher_id', '=', 'teachers.id')
        ->leftJoin('subject_lessons', 'schedules.subject_lesson_id', '=', 'subject_lessons.id')
        ->leftJoin('timetables', 'schedules.timetable_id', '=', 'timetables.id')
        ->leftJoin('days', 'schedules.day_id', '=', 'days.id')
        ->select('schedules.*')
        // pakai ini kalau mau query ke db lebih baik dan optimal
        ->with('SchoolYear', 'Classroom', 'Teacher', 'SubjectLesson', 'Timetable', 'Day')
        ->get();

        
        // dd($schedule);
        if($schedule->count()){

            $Days = Day::all();
            $ActiveSchoolyear = $schedule->first()->SchoolYear->school_year_name;
            $ActiveClassroom = $schedule->first()->Classroom->classname;
    
            // Kirim classname
            // $classname = $schedule;
            // DD($classname);
            
            // return $schedule -> groupBy('Day.day_name') -> map(function (Collection $DayName) {
            //     return $DayName -> groupBy('Classroom.classname') -> map(
            //         function (Collection $ClassroomName) {
            //             return $ClassroomName -> map(function ($schedule) {
            //                 return [
            //                     'subject_lesson' => $schedule -> SubjectLesson,
            //                     'timetable' => $schedule -> Timetable ->only('subject')
            //                 ];
            //             });
            //         }
            //     );
            // });
    
            // $result = $schedule -> groupBy('Day.day_name') -> map(function (Collection $DayName) {
            //     return $DayName -> groupBy('classroom_id') -> map(
            //         function (Collection $ClassroomName) {
            //             return $ClassroomName -> map(function ($schedule) {
            //                 return [
            //                     'subject_lesson' => $schedule -> SubjectLesson,
            //                     'timetable' => $schedule -> Timetable ->only('subject')
            //                 ];
            //             });
            //         }
            //     );
            // });
    
            // $result = $schedule->groupBy('Day.day_name')->map(function (Collection $DayName) {
            //     return $DayName->groupBy('Timetable.subject')->map(
    
            //         function (Collection $TimetableSubject) {
            //             return $TimetableSubject->sortBy('start')->map(function ($schedule) {
            //                 // return $schedule->SubjectLesson;
            //                 return [
            //                     // 'subject_lesson' => $schedule -> SubjectLesson,
            //                     'subject_lesson' => $schedule -> SubjectLesson ? $schedule -> SubjectLesson -> only('subject_name')['subject_name'] : null,
            //                     'teacher_name' => $schedule -> Teacher ? $schedule -> Teacher -> only('teacher_name')['teacher_name'] : null
            //                 ];
            //             });
            //         }
                    
            //     );
            // });
    
            // $result = $schedule->groupBy('timetable_id')->map(function (Collection $TimetableSubject) {
            // dd($schedule->sortBy('Timetable.start')->groupBy('Timetable.subject'));
            // not order
            // $result = $schedule->groupBy('Timetable.subject')->sortBy('Timetables.start')->map(function (Collection $TimetableSubject) {
                //with order Timetable.start
                $result = $schedule->sortBy('Timetable.start')->groupBy('Timetable.subject')->map(function (Collection $TimetableSubject) {
                return $TimetableSubject->sortBy('start')->groupBy('Day.day_name')->map(
    
                    function (Collection $DayName) {
                        return $DayName->sortBy('day_id')->map(function ($schedule) {
                            return [
                                // 'subject_lesson' => $schedule -> SubjectLesson,
                                'subject_lesson' => $schedule -> SubjectLesson ? $schedule -> SubjectLesson -> only('subject_name')['subject_name'] : null,
                                'teacher_name' => $schedule -> Teacher ? $schedule -> Teacher -> only('teacher_name')['teacher_name'] : null,
                                'is_break' => $schedule->no_lesson,
                                'timetable' => $schedule -> timetable_id 
                            ];
                        });
                    }
                    
                );
            });
    
    
    
            // $collect = [
            //     [
            //         'timetable' => 'Pelajaran 13:30:00',
            //         'Monday' => 'Tematik (Mr. Eduard)',
            //         'Tuesday' => 'Tematik (Mr. Eduard)',
            //     ],
            // ];
    
            // $convertedData = [];
    
            // foreach ($result as $day => $dayData) {
            //     $dayArray = [];
            //     foreach ($dayData as $time => $timeData) {
            //         foreach ($timeData as $subjectData) {
            //             $subject = $subjectData["subject_lesson"];
            //             $teacher = $subjectData["teacher_name"];
            //             $dayArray[] = [
            //                 "time" => $time,
            //                 "subject" => $subject,
            //                 "teacher" => $teacher
            //             ];
            //         }
            //     }
            //     $convertedData[$day] = $dayArray;
            // }
    
            // return $convertedData;
    
            // return $result;
            // dd($result);
            return view('custom.print-student-schedule',compact('result','Days','ActiveSchoolyear','ActiveClassroom'));
        }else {
            Alert::add('warning', 'No data!')->flash();

            return redirect()->back();
        }

    }

    public function teacher(Request $request){
        $schedule = Schedule::with('SchoolYear', 'Classroom', 'Teacher', 'SubjectLesson', 'Timetable', 'Day')
        // ->rightJoin('days', 'schedules.day_id', '=', 'days.id')
        // ->select('schedules.*', 'days.day_name','days.id')
        // ->crossJoin("days")
        ->where('school_year_id',$request->school_year_id)
        ->where('teacher_id',$request->teacher_id)
        ->get();

        // Gunakan cross join or push untuk memasukkan hari yang tidak ada di dalam data
        // return $schedule;
        // dd($schedule);
        if($schedule->count()){

            $Days = Day::get();
            $ActiveSchoolyear = $schedule->first()->SchoolYear->school_year_name;
            $ActiveClassroom = $schedule->first()->Classroom->classname;
            // return $Days;
            $result = $schedule->groupBy('Timetable.subject')->sortBy('start')->map(function (Collection $TimetableSubject) {
                // return $Days;
                return $TimetableSubject->groupBy('Day.day_name')->map(function (Collection $DayName) {
                        // return $DayName->sortBy('day_id')->map(function ($schedule) {
                        return $DayName->sortBy('day_id')->map(function ($schedule) {
                            return [
                                // 'subject_lesson' => $schedule -> SubjectLesson,
                                'subject_lesson' => $schedule -> SubjectLesson ? $schedule -> SubjectLesson -> only('subject_name')['subject_name'] : null,
                                'classroom' => $schedule -> Classroom ? $schedule -> Classroom -> only('classname')['classname'] : null,
                                // 'is_break' => $schedule->no_lesson,
                                // 'timetable' => $schedule -> timetable_id 
                            ];
                        });
                    }
                );
            });

            return $result;
            // dd($result);
            return view('custom.print-teacher-schedule',compact('result','Days','ActiveSchoolyear','ActiveClassroom'));
        }else {
            Alert::add('warning', 'No data!')->flash();

            return redirect()->back();
        }
    }
}
