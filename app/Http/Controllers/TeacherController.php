<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Address;
use App\Models\Organization;
use App\Models\Period;
use App\Models\Post;
use App\Models\Profile;
use App\Models\QuestQuestion;
use App\Models\Teacher;
use App\Models\TeacherClassroom;
use App\Models\User;
use Carbon\Carbon;
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

    public function getPeriodClassroom($request, $periods)
    {
        if ($periods->all() == null) {
            $periodClassrooms = null;
        } else {
            if ($request->period != null) {
                $period_id = $request->period;
                $request->flash();
            } else {
                $period_id = $periods[0]->id;
            }
            $periodClassrooms = Classroom::with('sessions', 'period', 'tasks')->where('period_id', (int)$period_id)
                ->whereHas('teacherClassroom', function ($x) {
                    return $x->where('teacher_id', auth()->user()->teacher[0]->id);
                })
                ->get();
        }
        return $periodClassrooms;
    }

    public function myListClassroom()
    {
        $classroom = Classroom::with('sessions', 'period', 'tasks.uploads')
            ->whereHas('teacherClassroom', function ($x) {
                return $x->where('teacher_id', auth()->user()->teacher[0]->id);
            })->get();
        return $classroom;
    }

    public function getFistSchedule($listClassroom)
    {
        $result = [];
        if (!$listClassroom) {
            return 0;
        }
        $current = Carbon::now()->toDateTimeString();
        foreach ($listClassroom as $classroom) {
            foreach ($classroom->sessions as $session) {
                if ($session->start_time > $current) {
                    array_push($result, $session);
                }
            }
        }
        if (count($result) === 0) {
            return 0;
        }
        $sortedDate = collect($result)->sortBy('start_time')->all();
        return $sortedDate[0];
    }

    public function getListTask($listClassroom)
    {
        $result = [];
        if (!$listClassroom) {
            return 0;
        }
        foreach ($listClassroom as $classroom) {
            foreach ($classroom->tasks as $task) {
                array_push($result, $task);
            }
        }
        if (count($result) === 0) {
            return 0;
        }
        $sortedDate = collect($result)->sortBy('created_at')->take(5);
        return $sortedDate;
    }


    public function home(Request $request)
    {
        $teacher = Teacher::with('user')->where('user_id', '=', Auth::user()->id)->first();
        $organization = Organization::first();
        $teacherClassroom = TeacherClassroom::with('classroom.studentClassroom')->where('teacher_id', '=', $teacher->id)->get();
        $teacherQuestion = QuestQuestion::where('teacher_id', '=', $teacher->id)->get();
        $teacherPost = Post::where('user_id', '=', Auth::user()->id)->get();

        $periods = Period::whereHas('classroom', function ($x) {
            return $x->whereHas('teacherClassroom', function ($y) {
                return $y->where('teacher_id', '=', auth()->user()->teacher[0]->id);
            });
        })->get()->sortByDesc('id')->values();
        $periodClassrooms = $this->getPeriodClassroom($request, $periods);
        $listPost = Post::with('user')->orderBy('created_at', 'DESC')->take(4)->get();

        $myListClassroom = $this->myListClassroom();
        $firstSchedule = $this->getFistSchedule($myListClassroom);
        $listTask = $this->getListTask($myListClassroom);

        return view('pages.dashboards.teacher', [
            'organization' => $organization,
            'teacherClassroom' => $teacherClassroom,
            'teacherQuestion' => $teacherQuestion,
            'teacherPost' => $teacherPost,
            'periodClassrooms' => $periodClassrooms,
            'periods' => $periods,
            'firstSchedule' => $firstSchedule,
            'listPost' => $listPost,
            'listTask' => $listTask,
        ]);
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
        $datas = Teacher::with(['user', 'profile'])
            ->get()
            //sort by exp descending
            ->sortByDesc(function ($teacher) {
                return $teacher->profile->current_exp;
            })
            ->values();
        $first = array_key_exists(0, $datas->all()) ? $datas[0] : null;
        $second = array_key_exists(1, $datas->all()) ? $datas[1] : null;
        $third = array_key_exists(2, $datas->all()) ? $datas[2] : null;
        $isCurrentRole = auth()->user()->role_id == 2 ? true : false;
        return view('pages.leaderboards.teacher')->with([
            'first' => $first,
            'second' => $second,
            'third' => $third,
            'datas' => $datas,
            'isCurrentRole' => $isCurrentRole
        ]);
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
            $user->role_id = 2;
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

    public function saveProfiles(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'min:3'],
            'phone_number' => ['required', 'regex:/^[0-9]+$/'],
            'latest_education' => ['required'],
        ]);

        if ($validation) {
            $profile = Profile::with(['teacher', 'address'])->whereHas('teacher', function ($q) {
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

            if ($profile->address === null) {
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
