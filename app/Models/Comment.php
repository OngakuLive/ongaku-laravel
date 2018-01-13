<?php

namespace App;

use App\Models\CommentLike;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'parent_comment_id',
        'created_by_id',
        'content'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function parent_comment() {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function likes() {
        return $this->morphMany(Like::class,'likeable');
    }

    public function created_by() {
        return $this->belongsTo(User::class);
    }
}
