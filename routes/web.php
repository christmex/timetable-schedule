<?php

use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug', function () {
    $schedule = Schedule::with('SchoolYear','Classroom','Teacher','SubjectLesson','Timetable','Day')->where('school_year_id',1)->get();


    // return $schedule->groupBy('day_id')->map(function (Collection $day_id) {
    //     return $day_id->groupBy('classroom_id')->map(function (Collection $classroom_id) {
    //         // return $classroom_id->pluck('subject_lesson_id');
    //         return $classroom_id->map->only(['subject_lesson_id','timetable_id'])->values();
    //     });
    // });

    // return $schedule -> groupBy('day_id') -> map(function (Collection $day_id) {
    //     return $day_id -> groupBy('classroom_id') -> map(
    //         function (Collection $classroom_id) {
    //             // return $classroom_id->pluck('subject_lesson_id');
    //             return $classroom_id -> map(function ($item) {
    //                 return [
    //                     'subject_lesson_id' => $item->subject_lesson->only(['subject_name']),
    //                     'timetable' => $item -> timetable -> only(['subject'])
    //                 ];
    //             }) -> values();
    //         }
    //     );
    // });

    // return $schedule->groupBy('day_id')->map(function (Collection $day_id) {
    //     return $day_id->groupBy('classroom_id')->map(function (Collection $classroom_id) {
    //         $classroom_id->load('timetable', 'subjectLesson');
    //         return $classroom_id->map->only(['subject_lesson_id', 'timetable_id', 'timetable.subject', 'subjectLesson.subject_name'])->values();
    //     });
    // });


   $schedule = Schedule::with('SchoolYear', 'Classroom', 'Teacher', 'SubjectLesson', 'Timetable', 'Day')->where('school_year_id',1)->get();

    return $schedule -> groupBy('Day.day_name') -> map(function (Collection $DayName) {
        return $DayName -> groupBy('Classroom.classname') -> map(
            function (Collection $ClassroomName) {
                return $ClassroomName -> map(function ($schedule) {
                    return [
                        'subject_lesson' => $schedule -> SubjectLesson,
                        'timetable' => $schedule -> Timetable ->only('subject')
                    ];
                });
            }
        );
    });
        

        // dd($schedule);
});
