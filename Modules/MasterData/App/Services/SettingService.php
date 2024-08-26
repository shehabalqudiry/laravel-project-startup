<?php

namespace Modules\MasterData\App\Services;

use Modules\MasterData\App\Repositories\Setting\SettingInterface;

class SettingService
{
    public function __construct(protected SettingInterface $userRepository)
    {
    }

    public function index($data)
    {
        return $this->userRepository->index($data);
    }

    public function update($data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

}
