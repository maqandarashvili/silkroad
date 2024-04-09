<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\SearchRepositoryInterface;

class UserSearchRepository implements SearchRepositoryInterface
{
    public function search($query)
    {
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->with('posts', 'comments')
            ->get();

        $users->each(function ($user) {
            $userRank = 0;

            foreach ($user->posts as $post) {
                $likes = $post->likes->where('type', 'like')->count();
                $dislikes = $post->likes->where('type', 'dislike')->count();
                $userRank += ($likes * 5) - $dislikes;
            }

            foreach ($user->comments as $comment) {
                $likes = $comment->likes->where('type', 'like')->count();
                $dislikes = $comment->likes->where('type', 'dislike')->count();
                $userRank += ($likes * 3) - $dislikes;
            }

            $user->rank = $userRank;
        });

        return $users;
    }
}

