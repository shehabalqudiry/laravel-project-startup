<?php

namespace Modules\MasterData\App\Repositories\Setting;

interface SettingInterface
{

    public function index($request);

    public function store($request);
    public function show($setting);

    public function update($setting , $request);

    public function destroy($setting);

}
