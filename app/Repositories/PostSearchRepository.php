<?php
namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\SearchRepositoryInterface;

class PostSearchRepository implements SearchRepositoryInterface
{
    public function search($query)
    {
        return Post::where('body', 'LIKE', "%{$query}%")->get();
    }
}
