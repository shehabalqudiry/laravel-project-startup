<?php

namespace Modules\MasterData\App\Repositories\City;

interface CityInterface
{

    public function index($request,$filter);

    public function store($request);
    public function show($city);

    public function update($city , $request);

    public function destroy($city);

}
