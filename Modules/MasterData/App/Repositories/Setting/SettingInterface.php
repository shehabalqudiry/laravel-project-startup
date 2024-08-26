<?php

namespace Modules\MasterData\App\Repositories\Setting;

interface SettingInterface
{

    public function index($request);

    public function update($setting , $request);

}
