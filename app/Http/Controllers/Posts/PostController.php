<?php
/**
 * Created by PhpStorm.
 * User: wheatleyjj
 * Date: 13/01/2018
 * Time: 13:57
 */

namespace App\Http\Controllers\Posts;


use App\Http\Controllers\APIInterface;
use App\Http\Requests\StorePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends APIInterface
{
    public function create(StorePost $request) {
        $post = Post::create(array_merge($request->all(), [
            'created_by_id' => Auth::id()
        ]));

        return $this->APIResponse(true, null, $post->id, 201);
    }
}