<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Material;
use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
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

    public function courses()
    {
        //TODO get class per period
        $classrooms = Classroom::all();
        $data = [
            'classrooms' => $classrooms,
            'userRole' => auth()->user()->role_id
        ];
        return view('pages.courses.my-courses', $data);
    }

    public function courseDetail($id)
    {
        $class = Classroom::find($id);
        $data = [
            'class' => $class,
            'userRole' => auth()->user()->role_id
        ];
        return view('pages.courses.detail', $data);
    }

    public function getSessionData(Request $request, $id)
    {
        $class = Classroom::find($id);
        $session = $class->Sessions->where('id', $request->sessionId)->first();
        $data = [
            'session' => $session,
            'materials' => $session->Materials,
            'threads' => $session->Threads,
        ];
        return response()->json($data);
    }

    public function getMaterialFile(Request $request, $id){
        $filePath = "materials/session_{$id}_{$request->sessionId}/" . $request->fileName;
        $materialPath = Storage::path($filePath);
        if (Storage::exists($filePath)) {
            return response()->download($materialPath);
        } else {
            abort(404);
        }
    }

    public function addMaterial(Request $request, $id){
        $validator = Validator::make(
            $request->all(),
            rules: [
                'type' => 'required',
                'sessionId' => 'required',
                'link' => 'required_if:type,link|url:http,https',
                'file' => 'required_if:type,file|file|mimes:txt,xlsx,pdf,doc,docx',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if ($request->type == 'file') {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // $fileName = str_replace(' ', '_', $fileName);
            // $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
            $filePath = "materials/session_{$id}_{$request->sessionId}/" . $fileName;
            Storage::put($filePath, file_get_contents($file));
            Material::create([
                'session_id' => $request->sessionId,
                'value' => $fileName,
                'is_file' => 1,
            ]);
        } else {
            Material::create([
                'session_id' => $request->sessionId,
                'value' => $request->link,
                'is_file' => 0,
            ]);
        }

        return response()->json(['success' => 'success']);
    }

    public function editMaterial(Request $request){
        $validator = Validator::make(
            $request->all(),
            rules: [
                'type' => 'required',
                'sessionId' => 'required',
                'link' => 'required_if:type,link|url:http,https',
                'file' => 'required_if:type,file|file|mimes:txt,xlsx,pdf,doc,docx',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if ($request->type == 'file') {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
            $filePath = "materials/session_{$classId}_{$request->sessionId}/" . $fileName;
            Storage::put($filePath, file_get_contents($file));
            $material = Material::find($request->materialId);
            $material->value = $fileName;
            $material->is_file = 1;
            $material->save();
        } else {
            $material = Material::find($request->materialId);
            $material->value = $request->link;
            $material->is_file = 0;
            $material->save();
        }

        return response()->json(['success' => 'success']);
    }

    public function deleteMaterial(Request $request){
        $material = Material::find($request->materialId);
        if ($material->is_file) {
            $classId = \App\Models\Session::where('id', $request->sessionId)->first()->classroom_id;
            $filePath = "materials/session_{$classId}_{$request->sessionId}/" . $material->value;
            Storage::delete($filePath);
        }
        $material->delete();

        return response()->json(['success' => 'success']);
    }
}
