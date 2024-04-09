<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function findByPost($postId)
    {
        return Comment::where('post_id', $postId)->with('user')->get();
    }

    public function update($id, array $data)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        return $comment->delete();
    }
}
