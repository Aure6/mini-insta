<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //pour éviter une certaine erreur
    protected $casts = ["published_at" => "datetime"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
