<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

use App\Http\Requests\PostStoreRequest;
//use App\Http\Controllers\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('published_at', '<', now())
            ->where('caption', 'LIKE', '%' . $request->query('search') . '%')
            // ->orWhere('caption', 'LIKE', '%' . $request->query('search') . '%')
            ->orWhereHas('user', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->query('search') . '%');
            })
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }
    /* public function index()
    {
        $posts = Post::paginate(12);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    } */
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // On récupère le post et on renvoie une erreur 404 si le post n'existe pas
        $post = Post::findOrFail($id);
        // On récupère les commentaires du post, avec les utilisateurs associés (via la relation)
        // On les trie par date de création (le plus ancien en premier)
        $comments = $post
            ->comments()
            ->with('user')
            ->orderBy('created_at')
            ->get();

        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }
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

    /* Like */
    public function like(Post $post)
    {
        $user = auth()->user();

        if ($post->isLikedByUser($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        }

        return back();
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
