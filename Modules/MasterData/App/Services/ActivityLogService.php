<?php

namespace Modules\MasterData\App\Services;

use Modules\MasterData\App\Repositories\ActivityLogs\ActivityLogInterface;

class ActivityLogService
{
    public function __construct(protected ActivityLogInterface $activityLogRepository){}

    public function index(array $data)
    {
        return $this->activityLogRepository->index($data);
    }

    public function api($request)
    {
        return $this->activityLogRepository->api($request);
    }

    public function destroy($id)
    {
        return $this->activityLogRepository->destroy($id);
    }

}
