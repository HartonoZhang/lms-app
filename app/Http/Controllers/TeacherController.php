<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Material;
use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function home()
    {
        return view('pages.dashboards.teacher');
    }

    public function profile($id)
    {
        return view('pages.profiles.teacher');
    }

    public function leaderboards()
    {
        return view('pages.leaderboards.teacher');
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required'],
            'latest_education' => ['required']
        ]);

        if ($validation) {
            $user = new User();
            $user->role_id = 3;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = 'default.png';
            $user->password = Hash::make('teacher123');
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

            $teacher = new Teacher();
            $teacher->user()->associate($user);
            $teacher->profile()->associate($profile);
            $teacher->latest_education = $request->latest_education;
            $teacher->save();

            return redirect()->route('teacher-list')->with(['status' => 'success', 'message' => 'New Teacher Successfully Added!']);
        }
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . $teacher->user_id],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required'],
            'latest_education' => ['required']
        ]);

        if ($validation) {
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;

            $profile = new Profile();
            $profile->dob = $request->dob;
            $profile->gender = $request->gender;
            $profile->phone_number = $request->phone_number;
            $profile->religion = $request->religion;

            $teacher->user()->update($user->toArray());
            $teacher->profile()->update($profile->toArray());
            $teacher->latest_education = $request->latest_education;
            $teacher->save();

            return redirect()->route('teacher-list')->with(['status' => 'success', 'message' => 'Teacher Information Successfully Updated!']);
        }
    }

    public function delete($id)
    {
        $teacher = Teacher::with('user', 'profile')->findOrFail($id);
        $this->message('Successfully Remove Teacher "' . $teacher->user->name . '"', 'success');
        $teacher->user->delete();
        $teacher->profile->delete();
        $teacher->delete();
        return back();
    }
}
