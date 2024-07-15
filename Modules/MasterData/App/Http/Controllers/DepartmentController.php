<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Department\App\Http\Requests\StoreRequest;
use Modules\MasterData\Department\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Department\App\Models\Department;
use Modules\MasterData\Department\App\Repositories\DepartmentInterface;

class DepartmentController extends Controller
{
    protected $department;

    public function __construct(DepartmentInterface $department)
    {
        $this->department = $department;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return $this->department->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(StoreRequest $request)
    {
        return $this->department->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Department $department)
    {
        return $this->department->show($department);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Department $department , UpdateRequest $request)
    {
        return $this->department->update($department , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        return $this->department->destroy($department);

    }
}
