<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function home()
    {
        return view('pages.dashboards.teacher');
    }

    public function profile()
    {
        return view('pages.profiles.teacher');
    }
}
