<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
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

    public function upsert($data){
        if($data->id == null){
            $result = Course::create([
                'name' => str($data->course_name)->title(),
                'code' => strtoupper($data->course_code),
                'min_score' => $data->min_score,
            ]);
        } else {
            $result = Course::find($data->id)->update([
                'name' => str($data->course_name)->title(),
                'code' => strtoupper($data->course_code),
                'min_score' => $data->min_score,
            ]);
        }
        return $result;
    }

    public function update(Request $request, $id){
        $oldData = Course::find($id);
        $validation = $request->validate([
            'course_code' => ['max:10'],
            'course_name' => ['required','unique:courses,name,'.$id],
            'min_score' => ['required','integer','min:0','max:100'],
        ],[
            'course_name.unique' => '"'.$request->course_name.'" course already has been created',
        ]);
        if($validation){
            $request->merge(['id' => $id]);
            $this->upsert($request);
            return redirect()->route('course-list')->with(['status'=> 'success','message'=> 'Course successfully updated.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
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
            $this->upsert($request);
            return redirect()->route('course-list')->with(['status'=> 'success','message'=> 'Course successfully created.']);
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

    public function courses()
    {
        //TODO get class per period
        $classrooms = Classroom::all();
        $data = [
            'classrooms' => $classrooms,
            'userRole' => auth()->user()->role_id
        ];
        return view('pages.courses.my-courses', $data);
    }

    public function courseDetail($id)
    {
        $class = Classroom::find($id);
        $data = [
            'class' => $class,
            'userRole' => auth()->user()->role_id
        ];
        return view('pages.courses.detail', $data);
    }

    public function getPeopleData(Request $request, $id){
        $class = Classroom::find($id);
        $students = $class->studentClassroom->load([
            'student.user'
        ]);
        $data = [
            'students' => $students,
        ];
        return response()->json($data);
    }
}
