<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Organization;
use App\Models\OrganizationCategory;
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

    public function checkUserExisted()
    {
        $user = User::all();
        if (count($user) === 0) {
            return view('pages.auth.sign-up');
        }
    }

    public function signup()
    {
        $user = User::all();
        if (count($user) === 0) {
            return view('pages.auth.sign-up');
        }
        return redirect()->route('registration-organization');
    }

    public function createOrganization()
    {
        $this->checkUserExisted();
        $user = User::all();
        $organization = Organization::all();
        $organizationCategory = OrganizationCategory::all();
        if (count($user) === 0) {
            return redirect()->route('registration');
        } else if (count($organization) === 0) {
            return view('pages.auth.sign-up-organization', [
                'organizationCategory' => $organizationCategory
            ]);
        }
        return redirect()->route('login', 'student');
    }

    public function signin($role)
    {
        $user = User::all();
        $organization = Organization::all();
        if (count($user) === 0) {
            return redirect()->route('registration');
        } else if (count($organization) === 0) {
            return redirect()->route('registration-organization');
        }
        $organization = Organization::first();
        return view('pages.auth.' . $role, [
            'role' => $role,
            'organization' => $organization
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

    public function storeUser(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:password'],
        ]);

        if ($validation) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1,
                'image' => 'default.png',
            ]);

            Admin::create([
                'user_id' => $user->id
            ]);

            return redirect()->route('registration-organization')->with(['status' => 'success', 'message' => 'User admin successfully created.']);
        }
    }

    public function insertImage($request, $name)
    {
        $extension = $request->file($name)->getClientOriginalExtension();
        $imgName = $request->name . '-' . now()->timestamp . '-' . $name . '.' . $extension;
        $request->file($name)->move('assets/images/organization', $imgName);
        return $imgName;
    }

    public function storeOrganization(Request $request)
    {
        $validation = $request->validate([
            'web_name' => ['required', 'min:3', 'max:20'],
            'name' => ['required', 'min:3', 'max:50'],
            'category' => ['required'],
            'logo' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'favicon' => ['required', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        if ($validation) {
            $logo = $this->insertImage($request, 'logo');
            $favicon = $this->insertImage($request, 'favicon');

            Organization::create([
                'web_name' => $request->web_name,
                'name' => $request->name,
                'category_id' => $request->category,
                'logo' => $logo,
                'favicon' => $favicon,
            ]);

            return redirect()->route('login', 'student')->with(['status' => 'success', 'message' => 'Organization successfully created.']);
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
