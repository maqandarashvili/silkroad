<?php

namespace App\Repositories;

use App\Models\Like;
use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggleLike($likeableType, $likeableId, $userId, $type)
    {
        $likeableModel = $likeableType::findOrFail($likeableId);

        $like = $likeableModel->likes()
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            if ($like->type === $type) {
                $like->delete();
                return null;
            } else {
                $like->update(['type' => $type]);
                return $like;
            }
        } else {
            return $likeableModel->likes()->create([
                'user_id' => $userId,
                'type' => $type,
            ]);
        }
    }
}
