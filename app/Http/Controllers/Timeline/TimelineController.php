<?php
/**
 * Created by PhpStorm.
 * User: wheatleyjj
 * Date: 13/01/2018
 * Time: 00:41
 */

namespace App\Http\Controllers\Timeline;


use App\Http\Controllers\APIInterface;
use App\Models\Post;

class TimelineController extends APIInterface
{
    public function getTimeline() {
        $posts = Post::with('likes')->get();

        return $this->APIResponse(true, null, $posts, 200);
    }
}