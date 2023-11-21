<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests\PostStoreRequest;
//use App\Http\Controllers\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        $post = Post::make();
        $post->caption = $request->validated()['caption'];
        // $post->body = $request->validated()['body'];
        $post->published_at = $request->validated()['published_at'];
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back();
    }
}
