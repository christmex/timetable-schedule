{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('teacher') }}"><i class="nav-icon la la-question"></i> Teachers</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('classroom') }}"><i class="nav-icon la la-question"></i> Classrooms</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('subject-lesson') }}"><i class="nav-icon la la-question"></i> Subject lessons</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('day') }}"><i class="nav-icon la la-question"></i> Days</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('school-year') }}"><i class="nav-icon la la-question"></i> School years</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('timetable') }}"><i class="nav-icon la la-question"></i> Timetables</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('schedule') }}"><i class="nav-icon la la-question"></i> Schedules</a></li>