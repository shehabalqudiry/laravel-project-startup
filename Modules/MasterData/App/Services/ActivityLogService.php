<?php

namespace Modules\MasterData\App\Services;

use Modules\MasterData\App\Repositories\ActivityLogs\ActivityLogInterface;

class ActivityLogService
{
    public function __construct(protected ActivityLogInterface $userRepository){}

    public function index(array $data)
    {
        return $this->userRepository->index($data);
    }

    public function show($id)
    {
        return $this->userRepository->show($id);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

}
