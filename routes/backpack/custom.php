<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('classroom', 'ClassroomCrudController');
    Route::crud('day', 'DayCrudController');
    Route::crud('school-year', 'SchoolYearCrudController');
    Route::crud('subject-lesson', 'SubjectLessonCrudController');
    Route::crud('teacher', 'TeacherCrudController');
    Route::crud('timetable', 'TimetableCrudController');
    Route::crud('schedule', 'ScheduleCrudController');
    Route::crud('user', 'UserCrudController');

    Route::get('teacher-schedule', 'TeacherScheduleController@index')->name('teacher-schedule.index');
}); // this should be the absolute last line of this file