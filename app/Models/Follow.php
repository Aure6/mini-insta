<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'followed_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'followed_id', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // // Define the inverse relationship
    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }

    // public function follower()
    // {
    //     return $this->belongsTo(User::class, 'follower_id');
    // }
}
