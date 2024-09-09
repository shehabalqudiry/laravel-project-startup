<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\MasterData\App\Models\Country;
use Modules\MasterData\App\Services\Dashboard\CountryService;
use Modules\MasterData\App\Http\Requests\Dashboard\Country\StoreRequest;
use Modules\MasterData\App\Http\Requests\Dashboard\Country\UpdateRequest;
use Modules\MasterData\App\Repositories\Dashboard\Country\CountryInterface;

class CountryController extends Controller
{
    protected $country;

    public function __construct(CountryService $country)
    {
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return $this->country->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(StoreRequest $request)
    {
        return $this->country->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Country $country)
    {
        return $this->country->show($country);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Country $country , UpdateRequest $request)
    {
        return $this->country->update($country , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        return $this->country->destroy($country);

    }
}
