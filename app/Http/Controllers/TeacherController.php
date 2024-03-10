<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function profile()
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
            'phone_number' => ['required', 'integer'],
            'dob' => ['required'],
            'gender' => ['required'],
            'religion' => ['required'],
            'last_education' => ['required']
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

            $teacher = new Teacher();
            $teacher->user()->associate($user);
            $teacher->profile()->associate($profile);
            $teacher->name = $request->name;
            $teacher->latest_education = $request->last_education;
            $teacher->save();

            return redirect()->route('teacher-list')->with(['status' => 'success', 'message' => 'New Teacher Successfully Added!']);
        }
    }

    public function delete($id)
    {
        $teacher = Teacher::with('user', 'profile')->findOrFail($id);
        $this->message('Successfully Remove Teacher "' . $teacher->name . '"', 'success');
        $teacher->user->delete();
        $teacher->profile->delete();
        $teacher->delete();
        return back();
    }
}
