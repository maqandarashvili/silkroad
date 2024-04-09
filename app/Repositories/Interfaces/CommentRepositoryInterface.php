<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function create(array $data);
    public function findByPost($postId);
    public function update($id, array $data);
    public function delete($id);
}
