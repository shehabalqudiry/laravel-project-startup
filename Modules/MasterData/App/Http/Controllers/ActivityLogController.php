<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\MasterData\App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\App\Models\ActivityLog;

class ActivityLogController extends Controller
{


    public function __construct(protected ActivityLogService $activity_log){}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->activity_log->index($request->all());
    }


    /**
     * Show the specified resource.
     */
    public function show(ActivityLog $activity_log)
    {
        return $this->activity_log->show($activity_log);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityLog $activity_log)
    {
        return $this->activity_log->destroy($activity_log);

    }
}
