<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Department\DepartmentInterface;

class DepartmentService
{
    public function __construct(protected DepartmentInterface $userRepository)
    {
    }

    public function store(array $data)
    {
        return $this->userRepository->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    public function index($request)
    {
        return $this->userRepository->index($request);
    }

    public function show($id)
    {
        return $this->userRepository->show($id);
    }
}
