<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Currency\App\Filters\CurrencyFilter;
use Modules\MasterData\Currency\App\Http\Requests\StoreRequest;
use Modules\MasterData\Currency\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Currency\App\Models\Currency;
use Modules\MasterData\Currency\App\Repositories\CurrencyInterface;

class CurrencyController extends Controller
{
    protected $currency;

    public function __construct(CurrencyInterface $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,CurrencyFilter $filter)
    {
        return $this->currency->index($request,$filter);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->currency->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Currency $currency)
    {
        return $this->currency->show($currency);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Currency $currency , UpdateRequest $request)
    {
        return $this->currency->update($currency , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        return $this->currency->destroy($currency);

    }
}
