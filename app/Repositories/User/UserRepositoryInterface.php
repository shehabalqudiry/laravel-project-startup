<?php

namespace app\Repositories\User;

interface UserRepositoryInterface
{
    public function all($request);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}
