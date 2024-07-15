<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\MasterData\RoleAndPermission\App\Http\Requests\Permission\StoreRequest;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\Permission\UpdateRequest;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Modules\MasterData\RoleAndPermission\App\Repositories\PermissionInterface;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        return $this->permission->index($request);
    }


}
