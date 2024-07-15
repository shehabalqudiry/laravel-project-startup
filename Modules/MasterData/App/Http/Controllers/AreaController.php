<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\MasterData\App\Services\AreaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Area\App\Http\Requests\StoreRequest;
use Modules\MasterData\Area\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Area\App\Models\Area;
use Modules\MasterData\Area\App\Repositories\AreaInterface;
use Modules\MasterData\Area\App\Filters\AreaFilter;
class AreaController extends Controller
{
    public function __construct(protected AreaService $area){}

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return $this->area->index($request->all());
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(StoreRequest $request)
    {
        return $this->area->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Area $area)
    {
        
        return $this->area->show($area);
    }


    public function update(Area $area , UpdateRequest $request)
    {
        return $this->area->update($area , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        return $this->area->destroy($area);

    }
}
