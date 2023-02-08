<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    public function index()
    {
        $data['something'] = 'Something';

        return view('custom.teacher-schedule', $data);
    }
}
