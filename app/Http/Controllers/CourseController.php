<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Session as ModelsSession;
use App\Models\Student;
use App\Models\StudentClassroom;
use App\Models\TaskUpload;
use App\Models\TeacherClassroom;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function upsert($data)
    {
        if ($data->id == null) {
            $result = Course::create([
                'name' => str($data->course_name)->title(),
                'code' => strtoupper($data->course_code),
            ]);
        } else {
            $result = Course::find($data->id)->update([
                'name' => str($data->course_name)->title(),
                'code' => strtoupper($data->course_code),
            ]);
        }
        return $result;
    }

    public function update(Request $request, $id)
    {
        $oldData = Course::find($id);
        $validation = $request->validate([
            'course_code' => ['max:10'],
            'course_name' => ['required', 'unique:courses,name,' . $id],
        ], [
            'course_name.unique' => '"' . $request->course_name . '" course already has been created',
        ]);
        if ($validation) {
            $request->merge(['id' => $id]);
            $this->upsert($request);
            return redirect()->route('course-list')->with(['status' => 'success', 'message' => 'Course successfully updated.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'course_code' => ['max:10'],
            'course_name' => ['required', 'unique:courses,name'],
        ], [
            'course_name.unique' => '"' . $request->course_name . '" course already has been created',
        ]);
        if ($validation) {
            $this->upsert($request);
            return redirect()->route('course-list')->with(['status' => 'success', 'message' => 'Course successfully created.']);
        }
        $request->flash();
        return redirect()->back()->withErrors($validation);
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $this->message('Successfully remove course "' . $course->name . '"', 'success');
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
        return view('pages.courses.teacher.my-courses', $data);
    }

    public function courseDetail($id)
    {
        $class = Classroom::find($id);
        $data = [
            'class' => $class,
            'userRole' => auth()->user()->role_id
        ];
        return view('pages.courses.teacher.detail', $data);
    }

    public function studentCourse()
    {
        $classrooms = Classroom::with('studentClassroom.student', 'course', 'sessions')->whereHas('studentClassroom.student', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->get();

        return view('pages.courses.student.my-courses', [
            'classrooms' => $classrooms
        ]);
    }

    public function studentCourseDetail($id)
    {
        $classroom = Classroom::with('course', 'tasks.category', 'tasks.uploads')->findOrFail($id);
        $sessions = ModelsSession::with('materials', 'attendances.student.user', 'threads.user', 'threads.comments')->where('classroom_id', '=', $id)->get();
        $teacherClassroom = TeacherClassroom::with('teacher.user')->where('classroom_id', '=', $id)->get();
        return ['classroom' => $classroom, 'sessions' => $sessions, 'teacherClassroom' => $teacherClassroom];
    }

    public function studentCourseDetailSession($id)
    {
        $data = $this->studentCourseDetaiL($id);
        return view('pages.courses.student.detail-session', [
            'classroom' => $data['classroom'],
            'sessions' => $data['sessions'],
            'teacherClassroom' => $data['teacherClassroom']
        ]);
    }

    public function studentCourseDetailPeople($id)
    {
        $data = $this->studentCourseDetaiL($id);
        $listStudent = StudentClassroom::with('student.user')->where('classroom_id', '=', $id)->paginate(15);
        return view('pages.courses.student.people', [
            'classroom' => $data['classroom'],
            'sessions' => $data['sessions'],
            'teacherClassroom' => $data['teacherClassroom'],
            'listStudent' => $listStudent
        ]);
    }

    public function studentCourseDetailAttendace($id)
    {
        $data = $this->studentCourseDetaiL($id);
        return view('pages.courses.student.attendance', [
            'classroom' => $data['classroom'],
            'sessions' => $data['sessions'],
            'teacherClassroom' => $data['teacherClassroom']
        ]);
    }

    public function studentCourseDetailAssignment($id)
    {
        $data = $this->studentCourseDetaiL($id);
        return view('pages.courses.student.assignment', [
            'classroom' => $data['classroom'],
            'sessions' => $data['sessions'],
            'teacherClassroom' => $data['teacherClassroom']
        ]);
    }

    public function getPeopleData(Request $request, $id)
    {
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
