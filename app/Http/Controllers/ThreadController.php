<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    public function postThread(Request $request){
        $validator = Validator::make(
            $request->all(),
            rules: [
                'sessionId' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }
        $userId = auth()->user()->id;

        $thread = Thread::create([
            'session_id' => $request->sessionId,
            'user_id' => $userId,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $data = [
            'success' => 'success',
        ];

        return response()->json($data);
    }

    public function postComment(Request $request){
        $validator = Validator::make(
            $request->all(),
            rules: [
                'threadId' => 'required',
                'description' => 'required',
            ]
        );

        if ($validator->fails()) {
            $errorInput = ['description' => $validator->errors()->has('description') ? true : false];
            return response()->json(['success' => false, 'errors' => $validator->errors()->all(), 'errorInput' => $errorInput]);
        }
        $userId = auth()->user()->id;

        $comment = Comment::create([
            'user_id' => $userId,
            'thread_id' => $request->threadId,
            'description' => $request->description,
        ]);

        $comment->load('User');
        $comment->created_at_format = $comment->getFormattedDate();

        $data = [
            'success' => 'success',
            'threadId' => $request->threadId,
            'comment' => $comment,
        ];

        return response()->json($data);
    }
}
