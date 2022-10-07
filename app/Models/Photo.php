<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class Photo extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'email',
        'body',
        'score_id',
    ];

    // 検索用のスコープ
    public function scopeSearch(Builder $query, $params)
    {
        if (!empty($params['title'])) {
            $query->where('title', 'like', '%' . $params['title'] . '%');
        }

        if (!empty($params['score_id'])) {
            $query->whereHas('score', function ($q) use ($params) {
                $q->where('score_id', 'like',  '%' . $params['score_id'] . '%');
            });
        }
        return $query;
    }

    // (belongsTo)1件の写真は1人のユーザーに紐付いている
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1つのスコアは1件の記事に紐付いている
    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    // 画像のパスを読み出し
    public function getImagePathAttribute()
    {
        return 'images/photos/' . $this->image;
    }
}
