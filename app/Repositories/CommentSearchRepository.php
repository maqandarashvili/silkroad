<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\SearchRepositoryInterface;

class CommentSearchRepository implements SearchRepositoryInterface
{
    public function search($query)
    {
        return Comment::where('body', 'LIKE', "%{$query}%")->get();
    }
}
