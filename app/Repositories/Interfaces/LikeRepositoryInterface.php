<?php

namespace App\Repositories\Interfaces;

interface LikeRepositoryInterface
{
    public function toggleLike($likeableType, $likeableId, $userId, $type);
}
