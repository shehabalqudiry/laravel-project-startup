<?php

namespace Modules\MasterData\App\Repositories\Dashboard\AdditionalData;

interface AdditionalDataInterface
{

    public function index($request);

    public function store($request);
    public function show($country);

    public function update($country , $request);

    public function destroy($country);

}
