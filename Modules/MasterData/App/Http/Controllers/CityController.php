<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\City\App\Http\Requests\StoreRequest;
use Modules\MasterData\City\App\Http\Requests\UpdateRequest;
use Modules\MasterData\City\App\Models\City;
use Modules\MasterData\City\App\Repositories\CityInterface;
use Modules\MasterData\City\App\Filters\CityFilter;
class CityController extends Controller
{
    protected $city;

    public function __construct(CityInterface $city)
    {
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request,CityFilter $filter)
    {
        return $this->city->index($request,$filter);
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
