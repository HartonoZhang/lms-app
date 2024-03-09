<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Profile;
use App\Models\Student;
use App\Models\Course;
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
        return view('pages.setting.index');
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

    public function teacherList()
    {
        return view('pages.teachers.list');
    }

    public function teacherAdd()
    {
        return view('pages.teachers.add');
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

    public function classList()
    {
        return view('pages.classes.list');
    }

    public function classAdd()
    {
        return view('pages.classes.add');
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

    public function storeStudent(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'phone_number' => ['required', 'integer'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required'],
            'gradution_date' => ['required']
        ]);

        if ($validation) {
            $user = new User();
            $user->role_id = 3;
            $user->email = $request->email;
            $user->image = 'default.png';
            $user->password = Hash::make($request->password);
            $user->save();

            $profile = new Profile();
            $profile->address_id = null;
            $profile->dob = $request->dob;
            $profile->gender = $request->gender;
            $profile->phone_number = $request->phone_number;
            $profile->religion = $request->religion;
            $profile->level = 1;
            $profile->current_exp = 0;
            $profile->badge_name = 'bronze';
            $profile->save();

            $student = new Student();
            $student->user()->associate($user);
            $student->profile()->associate($profile);
            $student->name = $request->name;
            $student->graduation_date = $request->gradution_date;
            $student->save();

            $this->message('New Student Successfully Added!', 'success');
            return back();
        }
    }
}
