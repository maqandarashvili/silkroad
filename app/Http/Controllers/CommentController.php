<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCommentRequest;
use App\Http\Requests\EditCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreCommentRequest $request, $postId)
    {
        $comment = $this->commentService->createComment([
            'body' => $request->body,
            'post_id' => $postId,
            'user_id' => auth()->user()->getAuthIdentifier()
        ]);
        return response()->json($comment, 201);
    }

    public function index($postId)
    {
        $comments = $this->commentService->getCommentsByPost($postId);
        return response()->json($comments);
    }

    public function update(EditCommentRequest $request, $id)
    {
        $updatedComment = $this->commentService->updateComment($id, $request->all());
        return response()->json($updatedComment);
    }

    public function destroy(DeleteCommentRequest $request, $id)
    {
        $this->commentService->deleteComment($id);
        return response()->json(['message' => 'Comment deleted']);
    }
}
