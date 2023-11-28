<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

//follow
use App\Models\Follow;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    //follow
    public function follow(User $user)
    {
        // auth()->user()->following()->create(['follower_id' => $user->id]);

        // return back();
        // Check if the authenticated user is not already following the given user
        if (!auth()->user()->following->contains('follower_id', $user->id)) {
            // Create a new follow record
            $follow = new Follow();
            $follow->user_id = auth()->user()->id; // Set the follower's user_id
            $follow->follower_id = $user->id;     // Set the user being followed as follower_id
            $follow->save();
        }

        return back();
    }
    //unfollow
    public function unfollow(User $user)
    {
        auth()->user()->following()->where('follower_id', $user->id)->delete();

        return back();
    }
}
