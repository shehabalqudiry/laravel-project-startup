<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\MasterData\App\Models\Area;
use Modules\MasterData\App\Filters\AreaFilters;
use Modules\MasterData\App\Services\Dashboard\AreaService;
use Modules\MasterData\App\Http\Requests\Dashboard\Area\StoreRequest;
use Modules\MasterData\App\Http\Requests\Dashboard\Area\UpdateRequest;


class AreaController extends Controller
{
    public function __construct(protected AreaService $area_service){}

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return $this->area_service->index($request->all());
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(StoreRequest $request)
    {
        return $this->area_service->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Area $area)
    {

        return $this->area_service->show($area);
    }


    public function update(Area $area , UpdateRequest $request)
    {
        return $this->area_service->update($area , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        return $this->area->destroy($area);

    }
}
