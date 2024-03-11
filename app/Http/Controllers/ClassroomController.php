<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\StudentClassroom;
use App\Models\TeacherClassroom;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassroomController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function upsertClassroom ($data){
        if ($data->id == null) {
            $result = Classroom::create([
                "code"=> $data->code,
                "name"=> $data->name,
                "course_id" => $data->course,
                "student_capacity" => $data->student_capacity
            ]);
        } else {
            $result = Classroom::find($data->id)->update([
                "code"=> $data->code,
                "name"=> $data->name,
                "course_id"=> $data->course,
                "student_capacity" => $data->student_capacity
            ]);
        }
        return $result;
    }

    public function upsertTeacherClassroom ($data){
        TeacherClassroom::where('classroom_id', $data->id)->delete();
        foreach ($data->teachers as $teacher) {
            $result = TeacherClassroom::create([
                "classroom_id"=> $data->classroom_id,
                "teacher_id"=> $teacher
            ]);
        }
    }

    public function upsertStudentClassroom ($data){
        StudentClassroom::where('classroom_id', $data->id)->delete();
        foreach ($data->students as $student) {
            $result = StudentClassroom::create([
                "classroom_id"=> $data->classroom_id,
                "student_id"=> $student
            ]);
        }
    }

    public function create(Request $request){
        $validation = $request->validate([
            "code" => ["max:10"],
            "name" => ["required"],
            "course" => ["required"],
            "student_capacity" => ['integer','nullable','regex:/^[1-9]+$/'],
            "students" => [
                "required",
                'array',
                function(string $attribute, mixed $value, Closure $fail) use ($request) {
                    if ($request->student_capacity != null) {
                        if (count($value) > $request->student_capacity) {
                            $fail("Total student must not exceed max capacity for student");
                        }
                    }
                }
            ],
            "teachers"=> ["required"],
        ],[
            "students.required" => "Must be at least 1 student in the class",
            "teachers.required" => "Must be at least 1 teacher in the class"
        ]);
        if($validation){

            $classroom = $this->upsertClassroom($request);
            $request->merge(['classroom_id' => $classroom->id]);  

            $this->upsertTeacherClassroom($request);
            $this->upsertStudentClassroom($request);

            return redirect()->route('class-list')->with(['status'=> 'success','message'=> 'Class successfully created.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function delete($id){
        $classroom = Classroom::findOrFail($id);
        $this->message('Successfully remove classroom "'.$classroom->name.'"', 'success');
        $classroom->delete();
        return back();
    }
}
