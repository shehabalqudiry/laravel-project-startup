<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use Modules\MasterData\App\Repositories\Dashboard\Admin\UserInterface;

class AdminService
{
    public function __construct(protected UserInterface $userRepository){}

    public function getAllUsers($request)
    {
        return $this->userRepository->getAllUsers($request);
    }

    public function store($request)
    {
        return $this->userRepository->store($request);
    }
    public function update($user, $request)
    {
        return $this->userRepository->update($user, $request);
    }

    public function destroy($user)
    {
        return $this->userRepository->destroy($user);
    }
}
