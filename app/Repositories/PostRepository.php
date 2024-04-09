<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function create(array $data)
    {
        return Post::create($data);
    }
    public function findByUser($userId)
    {
        return Post::where('user_id', $userId)->latest()->get();
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }

    public function update($id, array $data)
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function all()
    {
        return Post::orderBy('created_at', 'DESC')->get();
    }
}
