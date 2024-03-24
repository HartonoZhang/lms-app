<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function studentView()
    {
        return view('pages.quests.student.index');
    }
}
