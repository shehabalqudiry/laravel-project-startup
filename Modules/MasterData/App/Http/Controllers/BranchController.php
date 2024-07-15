<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Branch\App\Http\Requests\StoreRequest;
use Modules\MasterData\Branch\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Branch\App\Models\Branch;
use Modules\MasterData\Branch\App\Repositories\BranchInterface;
use Modules\MasterData\Branch\App\Filters\BranchFilter;
class BranchController extends Controller
{
    protected $branch;

    public function __construct(BranchInterface $branch)
    {
        $this->branch = $branch;
    }
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request,BranchFilter $filter)
     {
         return $this->branch->index($request,$filter);
     }

     /**
      * Show the form for creating a new resource.
      */

     public function store(StoreRequest $request)
     {
         return $this->branch->store($request);
     }

     /**
      * Show the specified resource.
      */
     public function show(Branch $branch)
     {
         return $this->branch->show($branch);
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function update(Branch $branch , UpdateRequest $request)
     {
         return $this->branch->update($branch , $request);
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy(Branch $branch)
     {
         return $this->branch->destroy($branch);

     }
}
