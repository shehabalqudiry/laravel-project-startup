<?php

namespace Modules\MasterData\App\Services\Dashboard;

use Modules\MasterData\App\Repositories\Dashboard\ActivityLogs\ActivityLogInterface;

class ActivityLogService
{
    public function __construct(protected ActivityLogInterface $activityLogRepository){}

    public function index(array $data)
    {
        return $this->activityLogRepository->index($data);
    }

    public function show($activityLogRepository)
    {
        return $this->activityLogRepository->show($activityLogRepository);
    }

    public function destroy($id)
    {
        return $this->activityLogRepository->destroy($id);
    }

}
