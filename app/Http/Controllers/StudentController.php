<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

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

    public function create(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required']
        ]);

        if ($validation) {
            $user = new User();
            $user->role_id = 3;
            $user->email = $request->email;
            $user->image = 'default.png';
            $user->password = Hash::make('student123');
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
            $student->graduation_date = null;
            $student->save();

            return redirect()->route('student-list')->with(['status' => 'success', 'message' => 'New Student Successfully Added!']);
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . $student->user_id],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required']
        ]);

        if ($validation) {
            $user = new User();
            $user->email = $request->email;

            $profile = new Profile();
            $profile->dob = $request->dob;
            $profile->gender = $request->gender;
            $profile->phone_number = $request->phone_number;
            $profile->religion = $request->religion;

            $student->user()->update($user->toArray());
            $student->profile()->update($profile->toArray());
            $student->name = $request->name;
            $student->graduation_date = $request->graduation_date;
            $student->save();

            return redirect()->route('student-list')->with(['status' => 'success', 'message' => 'Student Information Successfully Updated!']);
        }
    }

    public function delete($id)
    {
        $student = Student::with('user', 'profile')->findOrFail($id);
        $this->message('Successfully Remove Student "' . $student->name . '"', 'success');
        $student->user->delete();
        $student->profile->delete();
        $student->delete();
        return back();
    }
}
