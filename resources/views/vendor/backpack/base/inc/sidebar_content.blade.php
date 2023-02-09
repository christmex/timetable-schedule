{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('teacher') }}"><i class="nav-icon la la-chalkboard-teacher"></i> Teachers</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('classroom') }}"><i class="nav-icon la la-chalkboard"></i> Classrooms</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('subject-lesson') }}"><i class="nav-icon la la-book-open"></i> Subject lessons</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('day') }}"><i class="nav-icon la la-calendar"></i> Days</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('school-year') }}"><i class="nav-icon la la-graduation-cap"></i> School years</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('timetable') }}"><i class="nav-icon la la-clock"></i> Timetables</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('schedule') }}"><i class="nav-icon la la-calendar-check"></i> Schedules</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('teacher-schedule') }}"><i class="nav-icon la la-calendar-check"></i> Teacher Schedule</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-user-cog"></i> Settings</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-users"></i> Users</a></li>
    </ul>
</li>