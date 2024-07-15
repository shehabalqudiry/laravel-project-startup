<?php

namespace Modules\MasterData\App\Repositories\ActivityLogs;

use Modules\MasterData\ActivityLog\App\resources\ActivityLogsResource;
use Modules\MasterData\App\Models\ActivityLog;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityLogRepository implements ActivityLogInterface
{
    public function __construct(protected $model = new ActivityLog()){}



    public function index($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');

        $collection = QueryBuilder::for($this->model)
            ->allowedFilters(['event', 'log_name', 'subject_type', 'subject_id'])
            ->allowedSorts(['subject_type']);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);
        $columns = [
            "id" => 'ID',
            "log_name" => 'Key Name',
        ];
        $actions = [
            "edit" => "<button class='btn btn-primary'>Edit</button>",
            "delete" => "<button class='btn btn-danger'>Delete</button>",
        ];

        $options = [
            'isView' => true,
            'view' => 'masterdata::index',
            'columns' => $columns,
            'actions' => $actions,
            'page_title' => __('ActivityLog Data'),
        ];
        return responseSuccess($data, __('ActivityLog Data'), options: $options);

    }



    public function show($activity_log)
    {

        $data = $activity_log;
        return responseSuccess($data, __('ActivityLog Data'), options: ['isView' => true , 'view' => 'masterdata::activity-logs.show']);

    }



    public function destroy($activity_log)
    {
        $activity_log->delete();

        return back()->with(['success' => __('Destroyed Successfully')]);

    }

}
