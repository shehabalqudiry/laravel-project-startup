<?php

namespace Modules\MasterData\App\Repositories\Dashboard\ActivityLogs;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\MasterData\App\Models\ActivityLog;
use Modules\MasterData\App\Filters\ActivityLogFilters;
use Modules\MasterData\ActivityLog\App\resources\ActivityLogsResource;
use Modules\MasterData\App\Repositories\Dashboard\ActivityLogs\ActivityLogInterface;

class ActivityLogRepository implements ActivityLogInterface
{
    public function __construct(protected ActivityLog $model) {

    }



    public function index($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = ActivityLogFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data', options:["isView" => true, "view" => 'masterdata::activity-logs.index', 'columns' => ['log_name' => __("Name"), "user_name" => "User Name"]]);
    }

    public function store($request)
    {
        try {

            $activity_log = $this->model->create($request->validated());
            return responseSuccess($activity_log,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($activity_log)
    {

        return responseSuccess($activity_log,msg:__('data'));
    }

    public function update($activity_log, $request)
    {
        try {
            $activity_log = $this->model->update($request->validated());

            return responseSuccess($activity_log,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($activity_log)
    {
        $activity_log->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
