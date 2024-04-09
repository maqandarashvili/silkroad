<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost($data)
    {
        return $this->postRepository->create($data);
    }

    public function getPostsByUser($userId)
    {
        return $this->postRepository->findByUser($userId);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }

    public function updatePost($id, array $data)
    {
        return $this->postRepository->update($id, $data);
    }

    public function getAllPosts()
    {
        return $this->postRepository->all();
    }
}
