<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Area;

interface AreaInterface
{

    public function index($request);

    public function store($request);
    public function show($area);

    public function update($area , $request);

    public function destroy($area);

}
