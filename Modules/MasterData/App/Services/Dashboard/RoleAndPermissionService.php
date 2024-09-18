<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission\PermissionInterface;
use Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission\RoleInterface;

class RoleAndPermissionService
{
    public function __construct(
        protected RoleInterface $role,
        protected PermissionInterface $permission
        )
    {
    }

    public function getPermissions($request)
    {
        return $this->permission->index($request);
    }

    public function getRoles($request)
    {
        return $this->role->index($request);
    }

    public function createRole($request)
    {
        return $this->role->store($request);
    }


    public function showRole($role)
    {
        return $this->role->show($role);
    }

    public function updateRole($role , $request)
    {
        return $this->role->update($role , $request);
    }

    public function destroy($role)
    {
        return $this->role->destroy($role);
    }
}
