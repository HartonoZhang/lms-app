<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function signin(Request $request, $role)
    {
        return view('pages.auth.' . $role, [
            'role' => $role
        ]);
    }

    public function getRoleId($role)
    {
        if ($role === 'admin') {
            return 1;
        }
        if ($role === 'teacher') {
            return 2;
        }
        return 3;
    }

    public function authentication(Request $request, $role)
    {
        $request->merge([
            'role_id' => $this->getRoleId($role)
        ]);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role_id' => ['required']
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/' . $role);
        }
        $this->message('Incorrect username or password', 'failed');
        return redirect('/' . $role . '/signin');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:password'],
        ]);

        if ($validation) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => 'default.png',
                'role_id' => 1
            ]);

            $this->message('Your account have been created successfully!', 'success');
            return redirect('/signin');
        }
    }

    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/student/signin');
    }
}
