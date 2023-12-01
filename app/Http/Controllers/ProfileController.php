<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(User $user): View
    {
        // Les posts publiés par l'utilisateur
        $posts = $user
            ->posts()
            ->where('published_at', '<', now())
            ->withCount('comments')
            ->orderByDesc('published_at')
            ->get();

        // Les commentaires de l'utilisateur triés par date de création
        $comments = $user
            ->comments()
            ->orderByDesc('created_at')
            ->get();

        /* followCount */
        // $followCount = $user->follows()->count(); // replace this line with your logic to count follows
        // $followCount = auth()->user()->following()->count(); // replace this line with your logic to count follows

        // On renvoie la vue avec les données
        // return view('profile.show', [
        //     'user' => $user,
        //     'posts' => $posts,
        //     'comments' => $comments,
        // ]);
        // return view('profile.show',
        //     compact('user', 'posts', 'comments', 'followCount')
        // );
        // return view('profile.show', compact('user', 'posts', 'comments'));

        // The user id of the user to be followed or unfollowed
        $user_id = $user->id;

        return view('profile.show', compact('user', 'posts', 'comments', 'user_id'));
    }

    /* follow */
    public function isFollowing($user_id)
    {
        return Follow::where('user_id', auth()->id())
            ->where('followed_id', $user_id)
            ->exists();
    }
    public function follow($user_id)
    {
        if ($this->isFollowing($user_id)) {
            // unfollow the user
            Follow::where('user_id', auth()->id())
                ->where('followed_id', $user_id)
                ->delete();
        } else {
            // follow the user
            Follow::create([
                'user_id' => auth()->id(),
                'followed_id' => $user_id
            ]);
        }
        return back();
    }


    // public function follow(User $user)
    // {
    //     if (auth()->user()->isFollowing($user)) {
    //         auth()->user()->unfollow($user);
    //     } else {
    //         auth()->user()->follow($user);
    //     }

    //     return back();
    // }

    // public function follow(Request $request, User $user)
    // {
    //     $user = auth()->user();

    //     // Calculate the follow count for the current user²
    //     // $followCount = $user->following()->count();
    //     $followCount = $user()->isFollowedByUser->count();

    //     // Update the follow count for the target user
    //     $totalFollows = $user->following()->count();
    //     $totalFollowers = $user->followers()->count();

    //     // Your logic to handle the follow action goes here
    //     // Example: $user->followers()->attach(auth()->user());

    //     // On renvoie la vue avec les données
    //     return view('profile.show', [
    //         'followCount' => $followCount,
    //         'totalFollows' => $totalFollows,
    //         'totalFollowers' => $totalFollowers,
    //         'user' => $user, // You may need to pass the $user variable if it's used in the 'profile.show' view
    //     ]);
    // }

    /**
     * updateBio
     */
    public function updateBio(Request $request): RedirectResponse
    {
        // Validation sans passer par une form request
        $request->validate([
            'bio' => ['required', 'string', 'max:10000'], // Ajustez les règles de validation selon vos besoins
        ]);

        // Si la biographie est valide, on la sauvegarde
        $user = $request->user();
        $user->bio = $request->input('bio');
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'bio-updated');
    }

    /**
     * updateAvatar
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        // Validation de l'image sans passer par une form request
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        // Si l'image est valide, on la sauvegarde
        if ($request->hasFile('avatar')) {
            $user = $request->user();
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_path = $path;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
