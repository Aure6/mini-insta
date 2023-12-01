<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Follow
    public function followers()
    {
        return $this->hasMany(User::class);
    }
    public function following()
    {
        return $this->hasMany(User::class);
    }

    // public function followers()
    // {
    //     return $this->hasMany(Follow::class, 'followed_id', 'id');
    // }

    // public function followed(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_id')
    //         ->withTimestamps();
    // }

    // // Check if the user is followed by another user
    // public function isFollowedByUser(User $user): bool
    // {
    //     //return $this->followers->contains($user);
    //     return $this->followers->contains('user_id', $user->id);
    // }
}
