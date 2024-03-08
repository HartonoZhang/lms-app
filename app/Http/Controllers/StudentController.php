<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function home()
    {
        return view('pages.dashboards.student');
    }

    public function profile()
    {
        return view('pages.profiles.student');
    }

    public function leaderboards()
    {
        return view('pages.leaderboards.student');
    }
}
