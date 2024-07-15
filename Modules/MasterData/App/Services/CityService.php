<?php

namespace Modules\MasterData\App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class CityService
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

    public function all($request)
    {
        return $this->userRepository->all($request);
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }
}
