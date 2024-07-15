<?php

namespace Modules\MasterData\App\Repositories\Area;

interface AreaInterface
{

    public function index($request,$filter);

    public function store($request);
    public function show($area);

    public function update($area , $request);

    public function destroy($area);

}
