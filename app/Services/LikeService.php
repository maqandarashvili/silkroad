<?php

namespace App\Services;

use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function toggleLike($likeableType, $likeableId, $userId, $type)
    {
        return $this->likeRepository->toggleLike($likeableType, $likeableId, $userId, $type);
    }
}
