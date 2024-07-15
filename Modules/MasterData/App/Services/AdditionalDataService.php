<?php

namespace Modules\MasterData\App\Services;

use Modules\MasterData\App\Repositories\AdditionalData\AdditionalDataInterface;

class AdditionalDataService
{
    public function __construct(protected AdditionalDataInterface $additional_data){}
    public function index($request)
    {
        return $this->additional_data->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        return $this->additional_data->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show($additional_data)
    {
        return $this->additional_data->show($additional_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($additional_data , $request)
    {
        return $this->additional_data->update($additional_data , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($additional_data)
    {
        return $this->additional_data->destroy($additional_data);
    }
}
