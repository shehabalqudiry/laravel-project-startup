<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Setting;

interface SettingInterface
{

    public function index($request);

    public function update($setting , $request);

    public function destroy($setting);


}
