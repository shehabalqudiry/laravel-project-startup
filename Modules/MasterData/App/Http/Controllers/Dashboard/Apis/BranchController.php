<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\MasterData\App\Models\Branch;
use Modules\MasterData\App\Filters\BranchFilter;

use Modules\MasterData\App\Services\Dashboard\BranchService;
use Modules\MasterData\App\Http\Requests\Dashboard\Branch\StoreRequest;
use Modules\MasterData\App\Http\Requests\Dashboard\Branch\UpdateRequest;
use Modules\MasterData\App\Repositories\Dashboard\Branch\BranchInterface;


class BranchController extends Controller
{
    protected $branch;

    public function __construct(protected BranchService $branch_service)
    {

    }
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
         return $this->branch_service->index($request);
     }

     /**
      * Show the form for creating a new resource.
      */

     public function store(StoreRequest $request)
     {
         return $this->branch_service->store($request);
     }

     /**
      * Show the specified resource.
      */
     public function show(Branch $branch)
     {
         return $this->branch_service->show($branch);
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function update(Branch $branch , UpdateRequest $request)
     {
         return $this->branch_service->update($branch , $request);
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy(Branch $branch)
     {
         return $this->branch_service->destroy($branch);

     }
}
