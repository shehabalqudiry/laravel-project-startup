<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\App\Services\Dashboard\RoleAndPermissionService;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\Permission\StoreRequest;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\Permission\UpdateRequest;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Modules\MasterData\RoleAndPermission\App\Repositories\PermissionInterface;

class PermissionController extends Controller
{

    public function __construct(protected RoleAndPermissionService $role_and_permission){}

    public function index(Request $request)
    {
        return $this->role_and_permission->getPermissions($request);
    }


}
