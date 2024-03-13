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

    public function leaderboards()
    {
        return view('pages.leaderboards.teacher');
    }

    public function courses()
    {
        return view('pages.courses.my-courses');
    }

    public function courseDetail()
    {
        return view('pages.courses.detail');
    }
}
