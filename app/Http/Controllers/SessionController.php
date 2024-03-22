<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function getSessionData(Request $request, $id){
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

    public function updateDescription(Request $request, $id){
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
}
