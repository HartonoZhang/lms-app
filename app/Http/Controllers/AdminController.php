<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Course;
use App\Models\Organization;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function home()
    {
        $profile = Admin::with('user')->where('user_id', '=',  Auth::user()->id)->get();
        return view('pages.dashboards.admin', [
            'profile' => $profile
        ]);
    }

    public function profile()
    {
        return view('pages.profiles.admin');
    }

    public function setting()
    {
        $organization= Organization::first();
        return view('pages.setting.index', [
            'organization' => $organization
        ]);
    }

    public function studentList()
    {
        $listStudent = Student::with('profile', 'user')->get();
        return view('pages.students.list', [
            'listStudent' => $listStudent
        ]);
    }

    public function studentAdd()
    {
        return view('pages.students.add');
    }

    public function studentEdit($id)
    {
        $student = Student::with('profile', 'user')->findOrFail($id);
        return view('pages.students.edit', [
            'student' => $student
        ]);
    }

    public function studentDetail($id)
    {
        $student = Student::with('profile', 'user')->findOrFail($id);
        return view('pages.students.detail', [
            'student' => $student
        ]);
    }

    public function teacherList()
    {
        $listTeacher = Teacher::with('profile', 'user')->get();
        return view('pages.teachers.list', [
            'listTeacher' => $listTeacher
        ]);
    }

    public function teacherAdd()
    {
        return view('pages.teachers.add');
    }

    public function teacherEdit($id)
    {
        $teacher = Teacher::with('profile', 'user')->findOrFail($id);
        return view('pages.teachers.edit', [
            'teacher' => $teacher
        ]);
    }

    public function teacherDetail($id)
    {
        $teacher = Teacher::with('profile', 'user')->findOrFail($id);
        return view('pages.teachers.detail', [
            'teacher' => $teacher
        ]);
    }

    public function courseList()
    {
        $data = Course::all();
        return view('pages.courses.list')->with([
            'datas' => $data,
        ]);
    }

    public function courseAdd()
    {
        return view('pages.courses.add');
    }

    public function courseEdit($id)
    {
        $data = Course::find($id);
        return view('pages.courses.edit')->with(['data' => $data]);
    }

    public function classList()
    {
        $classrooms = Classroom::with(['course'])->get();
        return view('pages.classes.list')->with([
            'classrooms' => $classrooms
        ]);
    }

    public function classDetail($id)
    {
        $data = Classroom::with(['course','teacherClassroom.teacher.user','studentClassroom.student.user'])->where('id', $id)->get()[0];
        $studentLists = $data->studentClassroom->pluck('student');
        $teacherLists = $data->teacherClassroom->pluck('teacher');
        return view('pages.classes.detail')->with([
            'data' => $data,
            'studentLists' => $studentLists,
            'teacherLists' => $teacherLists,
        ]);
    }

    public function classAdd()
    {
        $courses = Course::all();
        $students = Student::with(['user'])->get();
        $teachers = Teacher::with(['user'])->get();
        return view('pages.classes.add')->with([
            'courses' => $courses,
            'students'=> $students,
            'teachers'=> $teachers,
        ]);
    }

    public function classEdit($id)
    {
        $courses = Course::all();
        $students = Student::with(['user'])->get();
        $teachers = Teacher::with(['user'])->get();
        $data = Classroom::with(['course','teacherClassroom','studentClassroom'])->where('id', $id)->get()[0];
        $checkedStudent = $data->studentClassroom->pluck('student_id')->all();
        $checkedTeacher = $data->teacherClassroom->pluck('teacher_id')->all();
        return view('pages.classes.edit')->with([
            'data' => $data,
            'courses' => $courses,
            'students'=> $students,
            'teachers'=> $teachers,
            'checkedStudent' => $checkedStudent,
            'checkedTeacher'=> $checkedTeacher
        ]);
    }

    public function saveProfiles(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
        ]);

        if ($validation) {
            $user = User::with('admin')->findOrFail(Auth::user()->id);
            $user->email = $request->email;
            $user->update();
            
            $data = new Admin(['name' => $request->name]);
            $user->admin()->update($data->toArray());
    
            $this->message('Profile Successfully Updated!', 'success');
            return back();
        }
    }

    public function savePassword(Request $request)
    {
        $validation = $request->validate([
            'oldPassword' => ['required', 'current_password'],
            'newPassword' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        if ($validation) {
            User::find(Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);

            $this->message('Password Successfully Updated!', 'success');
            return back();
        }
    }

    public function savePhoto(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => ['required']
        ]);

        if ($validate->fails()) {
            Session::flash('failUpload');
            return back()
                ->withErrors($validate);;
        } else {
            $user = User::find(Auth::user()->id);
            $extension = $request->file('image')->getClientOriginalExtension();
            $imgName = Auth::user()->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move('assets/images/profile', $imgName);

            $user->update([
                'image' => $imgName
            ]);

            $this->message('Profile Photo Successfully Updated.', 'success');
            return back();
        }
    }
}
