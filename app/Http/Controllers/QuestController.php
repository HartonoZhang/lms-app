<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{
    public function studentView()
    {
        return view('pages.quests.student.index');
    }

    public function teacherView()
    {
        return view('pages.quests.teacher.index');
    }

    public function addQuestion()
    {
        $listCourse = Course::all();
        $teacher = Teacher::with('user')->where('user_id', '=', Auth::user()->id)->first();
        return view('pages.quests.teacher.create', [
            'listCourse' => $listCourse,
            'teacher' => $teacher
        ]);
    }

    public function updateQuestion(Request $request, $id)
    {
        return view('pages.quests.teacher.index');
    }

    public function deleteQuestion($id)
    {
        return view('pages.quests.teacher.index');
    }
}
