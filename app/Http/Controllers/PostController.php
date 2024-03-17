<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function index()
    {
        return view('pages.posts.index');
    }

    public function postUpdate($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id !== Auth::user()->id) {
            return back();
        }
        return view('pages.posts.edit', [
            'post' => $post
        ]);
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required'],
        ]);

        if ($validation) {
            Post::create([
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'title' => $request->title,
                'image' => null
            ]);
            $routeName = strtolower(Auth::user()->role->name);
            return redirect()->route($routeName.'-profile', Auth::user()->id)->with(['status' => 'success', 'message' => 'New Post Successfully Created!']);
        }
    }

    public function detail($id)
    {
        $post = Post::with('user')->findOrFail($id);
        $comments = PostComment::with('post', 'user')->whereHas('post', function ($q) use ($id) {
            $q->where('post_id', $id);
        })->get();
        return view('pages.posts.detail', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required'],
        ]);

        if ($validation) {
            $post = Post::with('user')->findOrFail($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->update();

            return redirect()->route('post-detail', $id)->with(['status' => 'success', 'message' => 'Post Successfully Updated!']);
        }
    }

    public function comment(Request $request, $id)
    {
        $validation = $request->validate([
            'comment' => ['required'],
        ]);

        if ($validation) {
            PostComment::create([
                'user_id' => Auth::user()->id,
                'post_id' => $id,
                'comment' => $request->comment
            ]);

            $this->message('Comment Successfully Uploaded.', 'success');
            return back();
        }
    }

    public function delete($id){
        $post = Post::findOrFail($id);
        $post->delete();
        $routeName = strtolower(Auth::user()->role->name);
        return redirect()->route($routeName.'-profile', Auth::user()->id)->with(['status' => 'success', 'message' => 'Post Successfully Deleted!']);
    }
}
