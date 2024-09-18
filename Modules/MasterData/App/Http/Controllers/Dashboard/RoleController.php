<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MasterData\App\Models\Role;
use Modules\MasterData\App\Services\Dashboard\RoleAndPermissionService;

class RoleController extends Controller
{
    public function __construct(protected RoleAndPermissionService $role_and_permission){}

    public function index(Request $request)
    {
        $data = $this->role_and_permission->getRoles($request)['data'];
        $options = [
            "isView" => true,
            "view" => 'masterdata::roles.index',
        ];
        return responseSuccess($data, options:$options);
    }


    public function store(Request $request)
    {
        return $this->role_and_permission->createRole($request);
    }

    public function show(Role $role)
    {
        return $this->role_and_permission->showRole($role);
    }

    public function update(Role $role , Request $request)
    {
        return $this->role_and_permission->updateRole($role , $request);
    }

    public function destroy(Role $role)
    {
        return $this->role_and_permission->destroy($role);
    }
}
