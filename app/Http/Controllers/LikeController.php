<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function togglePostLike(Request $request, Post $post)
    {
        $type = $request->input('type', 'like');
        $like = $this->likeService->toggleLike(Post::class, $post->id, auth()->id(), $type);

        return response()->json($like);
    }

    public function toggleCommentLike(Request $request, Comment $comment)
    {
        $type = $request->input('type', 'like');
        $like = $this->likeService->toggleLike(Comment::class, $comment->id, auth()->id(), $type);

        return response()->json($like);
    }
}
