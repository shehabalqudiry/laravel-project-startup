<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\MasterData\App\Services\AdditionalDataService;
use Illuminate\Http\Request;
use Modules\MasterData\AdditionalData\App\Models\AdditionalData;

class AdditionalDataController extends Controller
{

    public function __construct(protected AdditionalDataService $additional_data){}

    public function index(Request $request)
    {
        return $this->additional_data->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->additional_data->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(AdditionalData $additional_data)
    {
        return $this->additional_data->show($additional_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdditionalData $additional_data , UpdateRequest $request)
    {
        return $this->additional_data->update($additional_data , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalData $additional_data)
    {
        return $this->additional_data->destroy($additional_data);
    }
}
