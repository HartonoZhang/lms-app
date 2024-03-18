<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    public function profile($id)
    {
        $student = Student::with('profile', 'user')->where('user_id', '=', $id)->first();
        $address = Address::where('id', '=', $student->profile->address_id)->first();
        $posts = Post::with('comment')->where('user_id', '=', $id)->paginate(5);
        return view('pages.profiles.student', [
            'student' => $student,
            'address' => $address,
            'posts' => $posts
        ]);
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
            $user->name = $request->name;
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
            $student->graduation_date = null;
            $student->save();

            return redirect()->route('student-list')->with(['status' => 'success', 'message' => 'New student successfully added!']);
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
            $user->name = $request->name;

            $profile = new Profile();
            $profile->dob = $request->dob;
            $profile->gender = $request->gender;
            $profile->phone_number = $request->phone_number;
            $profile->religion = $request->religion;

            $student->user()->update($user->toArray());
            $student->profile()->update($profile->toArray());
            $student->graduation_date = $request->graduation_date;
            $student->save();

            return redirect()->route('student-list')->with(['status' => 'success', 'message' => 'Student information successfully updated!']);
        }
    }

    public function delete($id)
    {
        $student = Student::with('user', 'profile')->findOrFail($id);
        $this->message('Successfully remove student "' . $student->user->name . '"', 'success');
        $student->user->delete();
        $student->profile->delete();
        $student->delete();
        return back();
    }

    public function saveProfiles(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
        ]);

        if ($validation) {
            $profile = Profile::with(['student', 'address'])->whereHas('student', function($q) {
                $q->where('user_id', Auth::user()->id);
            })->first();
            $user = User::findOrFail(Auth::user()->id);

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

    public function savePhoto(Request $request)
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
}
