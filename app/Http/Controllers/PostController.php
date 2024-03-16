<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('pages.posts.index');
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
            return redirect()->route('student-profile')->with(['status' => 'success', 'message' => 'New Post Successfully Created!']);
        }
    }

    public function detail($id)
    {
        $post = Post::with('user')->findOrFail($id);
        $profile = Profile::where('user_id', '=',  $post->user_id)->get();
        return view('pages.posts.detail', [
            'post' => $post,
            'profile' => $profile
        ]);
    }
}
