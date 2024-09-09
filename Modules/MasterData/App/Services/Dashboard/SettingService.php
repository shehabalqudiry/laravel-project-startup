<?php

namespace Modules\MasterData\App\Services\Dashboard;

use Modules\MasterData\App\Repositories\Dashboard\Setting\SettingInterface;

class SettingService
{
    public function __construct(protected SettingInterface $setting_interface)
    {
    }

    public function index($data)
    {
        return $this->setting_interface->index($data);
    }

    public function update($data, $id)
    {
        return $this->setting_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->setting_interface->destroy($id);
    }

}
