<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentStoreRequest $request, $postId)
    {
        // On crée un nouveau commentaire / Create a new comment
        $comment = Comment::make();

        // Retrieve the post et on renvoie une erreur 404 si le post n'existe pas
        $post = Post::findOrFail($postId);

        // On ajoute les propriétés du post
        $comment->body = $request->validated()['body'];

        $comment->user_id = Auth::id();

        // Associate the comment with the post
        $post->comments()->save($comment);

        // Flash a success message to the session
        // session()->flash('success', 'Comment created successfully.');
        session()->flash('success', 'Commentaire créé avec succès.');


        // Redirect back to the post or wherever you want
        return redirect()->route('posts.show', ['id' => $postId]);
    }
}
