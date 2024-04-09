<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->createPost([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return response()->json($post, 201);
    }

    public function userPosts()
    {
        $userId = auth()->id();
        $posts = $this->postService->getPostsByUser($userId);

        return response()->json($posts);
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return response()->json('Post deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $post = $this->postService->updatePost($id, $request->all());
        return response()->json($post);
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return response()->json($posts);
    }
}
