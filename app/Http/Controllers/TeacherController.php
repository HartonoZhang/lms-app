<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
        $teacher = Teacher::with('profile', 'user')->where('user_id', '=', $id)->first();
        $address = Address::where('id', '=', $teacher->profile->address_id)->first();
        $posts = Post::with('comment')->where('user_id', '=', $id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('pages.profiles.teacher', [
            'teacher' => $teacher,
            'address' => $address,
            'posts' => $posts
        ]);
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

            return redirect()->route('teacher-list')->with(['status' => 'success', 'message' => 'New teacher successfully added!']);
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

            return redirect()->route('teacher-list')->with(['status' => 'success', 'message' => 'Teacher information successfully updated!']);
        }
    }

    public function savePhoto (Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        if ($validate->fails()) {
            Session::flash('failUpload');
            return back()
                ->withErrors($validate);;
        } else {
            $user = User::find(Auth::user()->id);
            $extension = $request->file('image')->getClientOriginalExtension();
            $imgName = $user->id . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move('assets/images/profile', $imgName);

            $user->update([
                'image' => $imgName
            ]);

            $this->message('Profile photo successfully updated.', 'success');
            return back();
        }
    }

    public function saveProfiles(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'latest_education' => ['required'],
        ]);

        if ($validation) {
            $profile = Profile::with(['teacher', 'address'])->whereHas('teacher', function($q) {
                $q->where('user_id', Auth::user()->id);
            })->first();
            $user = User::findOrFail(Auth::user()->id);
            $teacher = Teacher::where('user_id', '=', Auth::user()->id)->first();

            $teacher->latest_education = $request->latest_education;
            $teacher->save();

            $profile->dob = $request->dob;
            $profile->gender = $request->gender;
            $profile->phone_number = $request->phone_number;
            $profile->religion = $request->religion;
            $profile->save();

            $user->name =  $request->name;
            $user->save();

            $address = new Address([
                'line' => $request->line,
                'city' => $request->city,
                'province' => $request->province,
                'zip' => $request->zip,
                'country' => $request->country
            ]);
            
            if($profile->address === null) {
                $address->save();
                $profile->address()->associate($address);
                $profile->save();
            } else {
                $profile->address()->update($address->toArray());
            }

            $this->message('Profile successfully updated!', 'success');
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

            $this->message('Password successfully updated!', 'success');
            return back();
        }
    }

    public function delete($id)
    {
        $teacher = Teacher::with('user', 'profile')->findOrFail($id);
        $this->message('Successfully remove teacher "' . $teacher->user->name . '"', 'success');
        $teacher->user->delete();
        $teacher->profile->delete();
        $teacher->delete();
        return back();
    }
}
