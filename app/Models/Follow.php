<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'followed_id'];

    public function followers()
    {
        return $this->hasMany(User::class);
    }
    public function following()
    {
        return $this->hasMany(User::class);
    }
}
