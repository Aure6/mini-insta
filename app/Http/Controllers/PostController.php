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
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
    //à partir d'ici, c'est copié de l'ancien admin postcontroller
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::make();
        $post->caption = $request->validated()['caption'];
        // $post->body = $request->validated()['body'];
        $post->published_at = $request->validated()['published_at'];
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
