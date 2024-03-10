<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function create(Request $request){
        $validation = $request->validate([
            'course_code' => ['max:10'],
            'course_name' => ['required','unique:courses,name'],
            'min_score' => ['required','integer','min:0','max:100'],
        ],[
            'course_name.unique' => '"'.$request->course_name.'" course already has been created',
        ]);
        if($validation){
            Course::create([
                'name' => str($request->course_name)->title(),
                'code' => strtoupper($request->course_code),
                'min_score' => $request->min_score,
            ]);
            return redirect()->route('course-list')->with(['status'=> 'success','message'=> 'Item successfully created.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function delete($id){
        $course = Course::findOrFail($id);
        $this->message('Successfully remove course "'.$course->name.'"', 'success');
        $course->delete();
        return back();
    }
}
