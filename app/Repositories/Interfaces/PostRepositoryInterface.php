<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function create(array $data);
    public function findByUser($userId);
    public function delete($id);
    public function update($id, array $data);

    public function all();

}
