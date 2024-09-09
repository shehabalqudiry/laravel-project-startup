<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Modules\MasterData\App\Models\AdditionalData;
use Modules\MasterData\App\Services\Dashboard\AdditionalDataService;
use Modules\MasterData\App\Http\Requests\Dashboard\AdditionalData\StoreRequest;
use Modules\MasterData\App\Http\Requests\Dashboard\AdditionalData\UpdateRequest;

class AdditionalDataController extends Controller
{

    public function __construct(protected AdditionalDataService $additional_data_service){}

    public function index(Request $request)
    {
        return $this->additional_data_service->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->additional_data_service->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(AdditionalData $additional_data)
    {
        return $this->additional_data_service->show($additional_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdditionalData $additional_data , UpdateRequest $request)
    {
        return $this->additional_data_service->update($additional_data , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalData $additional_data)
    {
        return $this->additional_data_service->destroy($additional_data);
    }
}
