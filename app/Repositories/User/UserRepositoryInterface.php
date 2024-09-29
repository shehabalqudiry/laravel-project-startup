<?php

namespace app\Repositories\User;

interface UserRepositoryInterface
{
    public function index($request);

    public function store(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
