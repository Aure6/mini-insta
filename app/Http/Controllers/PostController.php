<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests\PostStoreRequest;
//use App\Http\Controllers\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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
    // public function store(Request $request)
    public function store(PostStoreRequest $request)
    {
        // On crée un nouveau post
        $post = Post::make();

        // On ajoute les propriétés du post
        $post->caption = $request->validated()['caption'];

        // Utilisation de Carbon pour définir la date actuelle
        $post->published_at = Carbon::now();

        $post->user_id = Auth::id();

        // Si il y a une image, on la sauvegarde
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('posts', 'public');
            $post->img_path = $path;
        }

        // On sauvegarde le post en base de données
        $post->save();

        // return redirect()->route('posts.index');

        // Flash a success message to the session
        // session()->flash('success', 'Post created successfully.');
        session()->flash('success', 'Post créé avec succès.');

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
