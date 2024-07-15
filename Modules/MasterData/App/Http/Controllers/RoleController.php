<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\Role\StoreRequest;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\Role\UpdateRequest;
use Modules\MasterData\RoleAndPermission\App\Models\Role;
use Modules\MasterData\RoleAndPermission\App\Repositories\RoleInterface;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    public function index(Request $request)
    {
        return $this->role->index($request);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->role->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Role $role)
    {
        return $this->role->show($role);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Role $role , UpdateRequest $request)
    {
        return $this->role->update($role , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        return $this->role->destroy($role);
    }
}
