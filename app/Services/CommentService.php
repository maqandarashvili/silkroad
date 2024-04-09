<?php

namespace App\Services;

use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(array $data)
    {
        return $this->commentRepository->create($data);
    }
    public function getCommentsByPost($postId)
    {
        return $this->commentRepository->findByPost($postId);
    }

    public function updateComment($id, array $data)
    {
        return $this->commentRepository->update($id, $data);
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->delete($id);
    }

}
