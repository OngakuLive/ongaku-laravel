<?php
/**
 * Created by PhpStorm.
 * User: wheatleyjj
 * Date: 14/01/2018
 * Time: 20:34
 */

namespace App\Http\Controllers\Comments;


use App\Http\Controllers\APIInterface;
use App\Http\Requests\StoreComment;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class CommentDetailController extends APIInterface
{
    public function replyToComment(Comment $comment, StoreComment $request) {
        $comment = $comment->child_comments()->save(new Comment(array_merge($request->all(), [
            'created_by_id' => Auth::id(),
            'post_id' => $comment->post_id
        ])));

        return $this->APIResponse(true, null, $comment->id, 201);
    }

    public function like(Comment $comment) {
        $existingLike = Like::where('likeable_id', $comment->id)->where('likeable_type', 'App\\Models\\Comment')->where('created_by_id', Auth::id())->first();

        if (isset($existingLike)) {
            $existingLike->delete();
            return $this->APIResponse(true);
        }

        $like = $comment->likes()->create(['created_by_id' => Auth::id()]);
        return $this->APIResponse(true);
    }
}