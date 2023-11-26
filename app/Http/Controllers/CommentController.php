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
    // public function store(Request $request, $postId)
    // {
    //     $request->validate([
    //         'body' => 'required|string|max:10000',
    //     ]);

    //     $comment = new Comment([
    //         'body' => $request->input('body'),
    //         'user_id' => auth()->user()->id, // Assuming you have authentication in place
    //         'post_id' => $postId,
    //     ]);

    //     $comment->save();

    //     return redirect()->back()->with('success', 'Comment added successfully.');
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentStoreRequest $request, $postId)
    {
        // Ensure that the user is authenticated before attempting to save the comment. If not, you might need to handle cases where the user is not authenticated.
        if (Auth::check()) {
            // User is authenticated, proceed with saving the comment
        } else {
            // User is not authenticated, handle accordingly
        }

        // Retrieve the post et on renvoie une erreur 404 si le post n'existe pas
        $post = Post::findOrFail($postId);

        // Create a new comment
        $comment = new Comment([
            'body' => $request->validated()['body'],
            'user_id' => Auth::id(),
        ]);

        // Associate the comment with the post
        $post->comments()->save($comment);

        // Flash a success message to the session
        session()->flash('success', 'Comment created successfully.');

        // Redirect back to the post or wherever you want
        return redirect()->route('posts.show', ['id' => $postId]);
    }

    // Other comment controller methods...
}
