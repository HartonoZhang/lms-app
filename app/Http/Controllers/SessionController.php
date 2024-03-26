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
    
    public function getSessionData(Request $request, $id)
    {
        $class = Classroom::find($id);
        $session = $class->sessions->where('id', $request->sessionId)->first();
        $students = $class->studentClassroom->load([
            'student.user',
            'student.attendanceBySession' => function ($query) use ($request) {
                $query->where('session_id', $request->sessionId);
            },
        ]);
        $session->load([
            'materials',
            'threads' => function ($query) {
                $query->orderByDesc('id');
            },
            'threads.user',
            'threads.comments.user'
        ]);
        foreach ($session->threads as $thread) {
            $thread->created_at_format = $thread->getFormattedDate();
            foreach ($thread->comments as $comment) {
                $comment->created_at_format = $comment->getFormattedDate();
            }
        }
        $data = [
            'session' => $session,
            'students' => $students,
        ];
        return response()->json($data);
    }

    public function updateDescription(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            rules: [
                'description' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }

        $session = Session::find($request->sessionId);
        $session->description = $request->description;
        $session->save();

        return response()->json(['success' => 'success']);
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
