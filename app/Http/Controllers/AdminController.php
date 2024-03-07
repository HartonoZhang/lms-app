<?php

namespace App\Http\Controllers;

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
        return view('pages.dashboards.admin');
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
        return view('pages.students.list');
    }

    public function studentAdd()
    {
        return view('pages.students.add');
    }

    public function saveProfiles(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
        ]);

        if ($validation) {
            User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
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
