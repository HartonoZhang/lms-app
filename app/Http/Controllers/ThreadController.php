<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function postThread(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'sessionId' => ['required'],
            'title' => ['required'],
            'description' => ['required']
        ]);

        if ($validate->fails()) {
            Session::flash('failPostThread');
            return back()->withInput($request->input())
                ->withErrors($validate);
        } else {
            Thread::create([
                'session_id' => $request->sessionId,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $this->message('New thread successfully posted!', 'success');
            $previousUrl = app('url')->previousPath();
            return redirect()->to($previousUrl . '?' . http_build_query(['session' => $request->sessionId]));
        }
    }

    public function detail($id)
    {
        $thread = Thread::with('user', 'comments')->findOrFail($id);
        $comments = Comment::with('thread', 'user')->whereHas('thread', function ($q) use ($id) {
            $q->where('thread_id', $id);
        })->get();

        return view('pages.threads.detail', [
            'thread' => $thread,
            'comments' => $comments,
            'session' => $thread->session
        ]);
    }

    public function postThreadComment(Request $request, $id)
    {
        $validation = $request->validate([
            'comment' => ['required'],
        ]);

        if ($validation) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'thread_id' => $id,
                'description' => $request->comment,
            ]);

            $this->message('Comment successfully uploaded.', 'success');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required']
        ]);

        if ($validate->fails()) {
            Session::flash('failUpdateThread');
            return back()->withInput($request->input())
                ->withErrors($validate);
        } else {
            $thread = Thread::findOrFail($id);
            $thread->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $this->message('Thread successfully updated!', 'success');
            return back();
        }
    }

    public function delete($session, $thread)
    {
        $thread = Thread::findOrFail($thread);
        $thread->delete();
        $role = strtolower(Auth::user()->role->name);
        return redirect()->route($role . '-course-detail', $session)->with(['status' => 'success', 'message' => 'Successfully remove thread']);
    }
}
