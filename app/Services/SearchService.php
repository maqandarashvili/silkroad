<?php

namespace App\Services;

use App\Repositories\UserSearchRepository;
use App\Repositories\PostSearchRepository;
use App\Repositories\CommentSearchRepository;

class SearchService
{
    protected $userSearchRepository;
    protected $postSearchRepository;
    protected $commentSearchRepository;

    public function __construct(
        UserSearchRepository    $userSearch,
        PostSearchRepository    $postSearch,
        CommentSearchRepository $commentSearch
    )
    {
        $this->userSearchRepository = $userSearch;
        $this->postSearchRepository = $postSearch;
        $this->commentSearchRepository = $commentSearch;
    }

    public function search($query)
    {
        return [
            'users' => $this->userSearchRepository->search($query),
            'posts' => $this->postSearchRepository->search($query),
            'comments' => $this->commentSearchRepository->search($query),
        ];
    }
}
