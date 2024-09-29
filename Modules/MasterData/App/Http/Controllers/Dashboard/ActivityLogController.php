<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\MasterData\App\Models\ActivityLog;
use Modules\MasterData\App\Services\Dashboard\ActivityLogService;

class ActivityLogController extends Controller
{


    public function __construct(protected ActivityLogService $activity_log_service){}

    public function index(Request $request)
    {
        return $this->activity_log_service->index($request->all());
    }

    public function show(ActivityLog $activity_log)
    {
        return $this->activity_log_service->show($activity_log);
    }


    public function destroy(ActivityLog $activity_log)
    {
        return $this->activity_log_service->destroy($activity_log);

    }
}
