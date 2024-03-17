<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostReport;
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
        if ($post->user_id !== Auth::user()->id) {
            return back();
        }
        return view('pages.posts.edit', [
            'post' => $post
        ]);
    }

    public function checkFile($request, $requestImage)
    {
        if($request->hasFile($requestImage)) {
            $extension = $request->file($requestImage)->getClientOriginalExtension();
            $imgName = $requestImage . '-post-' . now()->timestamp . '.' . $extension;
            $request->file($requestImage)->move('assets/images/posts/'.$requestImage, $imgName);
            return $imgName;
        }
        return null;
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required'],
            'image' => ['mimes:png,jpg,jpeg', 'max:2048'],
            'image_2' => ['mimes:png,jpg,jpeg', 'max:2048'],
            'file' => ['mimes:pdf,zip,ppt,pptx,xlx,xlsx,docx,doc', 'max:2048'],
        ]);

        if ($validation) {
            $image = $this->checkFile($request, 'image');
            $image_2 = $this->checkFile($request, 'image_2');
            $file = $this->checkFile($request, 'file');
            
            Post::create([
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'title' => $request->title,
                'image' => $image,
                'image_2' => $image_2,
                'link' => $request->link,
                'link_2' => $request->link_2,
                'file' => $file,
            ]);
            $routeName = strtolower(Auth::user()->role->name);
            return redirect()->route($routeName . '-profile', Auth::user()->id)->with(['status' => 'success', 'message' => 'New post successfully created!']);
        }
    }

    public function detail($id)
    {
        $post = Post::with('user')->findOrFail($id);
        $comments = PostComment::with('post', 'user')->whereHas('post', function ($q) use ($id) {
            $q->where('post_id', $id);
        })->get();
        $reports = PostReport::with('post', 'user')->whereHas('post', function ($q) use ($id) {
            $q->where('post_id', $id);
        })->get();
        return view('pages.posts.detail', [
            'post' => $post,
            'comments' => $comments,
            'reports' => $reports
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

    public function report(Request $request, $id)
    {
        $reports = PostReport::with('post', 'user')->whereHas('post', function ($q) use ($id) {
            $q->where('post_id', $id);
        })->where('user_id', '=', Auth::user()->id)->get();

        if ($reports->isEmpty()) {
            PostReport::create([
                'user_id' => Auth::user()->id,
                'post_id' => $id,
                'report' => $request->report
            ]);
            $this->message('Reported successfully.', 'success');
            return back();
        }

        $this->message('You are already reported this post.', 'fail');
        return back();
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

            $this->message('Comment successfully uploaded.', 'success');
            return back();
        }
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $routeName = strtolower(Auth::user()->role->name);
        return redirect()->route($routeName . '-profile', Auth::user()->id)->with(['status' => 'success', 'message' => 'Post successfully deleted!']);
    }
}
