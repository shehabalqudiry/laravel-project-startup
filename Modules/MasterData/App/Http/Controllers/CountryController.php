<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Country\App\Http\Requests\StoreRequest;
use Modules\MasterData\Country\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Country\App\Models\Country;
use Modules\MasterData\Country\App\Repositories\CountryInterface;

class CountryController extends Controller
{
    protected $country;

    public function __construct(CountryInterface $country)
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
