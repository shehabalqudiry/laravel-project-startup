<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\MasterData\App\Models\City;
use Modules\MasterData\City\App\Filters\CityFilter;
use Modules\MasterData\App\Repositories\Dashboard\City\CityInterface;
use Modules\MasterData\App\Http\Requests\Dashboard\City\StoreRequest;
use Modules\MasterData\App\Http\Requests\Dashboard\City\UpdateRequest;

class CityController extends Controller
{
    protected $city;

    public function __construct(protected CityInterface $cityInterface)
    {
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return $this->city->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(StoreRequest $request)
    {
        return $this->city->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(City $city)
    {
        return $this->city->show($city);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(City $city , UpdateRequest $request)
    {
        return $this->city->update($city , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        return $this->city->destroy($city);

    }
}
