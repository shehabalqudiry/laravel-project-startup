<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class AdminService
{
    public function __construct(protected UserRepositoryInterface $userRepository){}

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function index($request)
    {
        return $this->userRepository->index($request);
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }
}
