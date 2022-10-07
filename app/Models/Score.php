<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    // (hasMany)1つのスコアは複数の記事に紐付いている
    public function photo()
    {
        return $this->hasMany(Post::class);
    }
}
