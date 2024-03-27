<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function message($msg, $status)
    {
        FacadesSession::flash('status', $status);
        FacadesSession::flash('message', $msg);
    }

    public function createSession($id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('pages.sessions.create', [
            'classroom' => $classroom
        ]);
    }

    public function addSession(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'start_time' => ['required', 'date', 'after_or_equal:now'],
            'end_time' => ['required', 'date', 'after_or_equal:start_time']
        ]);

        if ($validation) {
            Session::create([
                'classroom_id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return redirect()->route('teacher-course-detail', $id)->with(['status' => 'success', 'message' => 'Successfully add new session']);
        }

    }

    public function updateSession ($id)
    {
        $session = Session::findOrFail($id);
        return view('pages.sessions.edit', [
            'session' => $session,
            'classroom' => $session->classroom,
        ]);
    }

    public function editSession (Request $request, $id)
    {
        $validation = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'start_time' => ['required', 'date', 'after_or_equal:now'],
            'end_time' => ['required', 'date', 'after_or_equal:start_time']
        ]);

        if ($validation) {
            $session = Session::findOrFail($id);
            $session->update([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return redirect()->route('teacher-course-detail', $session->classroom_id)->with(['status' => 'success', 'message' => 'Successfully update session']);
        }
    }

    public function deleteSession($id)
    {
        $session = Session::findOrFail($id);
        $this->message('Successfully remove session "'.$session->title.'"', 'success');
        $session->delete();
        return back();
    }
}
