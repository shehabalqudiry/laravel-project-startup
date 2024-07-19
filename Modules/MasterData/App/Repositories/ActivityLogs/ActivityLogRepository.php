<?php

namespace Modules\MasterData\App\Repositories\ActivityLogs;

use Modules\MasterData\ActivityLog\App\resources\ActivityLogsResource;
use Modules\MasterData\App\Models\ActivityLog;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityLogRepository implements ActivityLogInterface
{
    public function __construct(protected $model = new ActivityLog())
    {
    }



    public function index($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');

        $collection = QueryBuilder::for($this->model)
            ->allowedFilters(['event', 'log_name', 'subject_type', 'subject_id'])
            ->allowedSorts(['subject_type']);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);
        $columns = [
            "id" => 'ID',
            "user_name" => 'User Name',
            "log_name" => 'Log Name',
            "description" => 'Description',
            "event" => 'Event',
            "new" => 'New Data',
            "old" => 'Old Data',
        ];
        $actions = [
            // "edit" => ["label" => "Edit", "class" => 'btn btn-outline-primary', "href" => "#", "action_route" => 'activitylog.update'],
            "show" => ["label" => "Show", "class" => 'btn btn-outline-info', "href" => "#", "action_route" => 'activitylog.show'],
            // "delete" => ["label" => "Delete", "class" => 'btn btn-outline-danger', "href" => "#", "action_route" => 'activitylog.destroy'],
        ];
        $headerButtons = [
            // "add" => "<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#AddModal'>Add</button>",
        ];

        $modalInputs = [
            // [
            //     "modalId" => "AddModal",
            //     "formOptions" => "method=POST",
            //     "data" => [
            //         [
            //             "lable" => "Name",
            //             "type" => "text",
            //             "isButton" => false,
            //             "name" => "log_name",
            //         ],
            //         [
            //             "lable" => "Submit",
            //             "type" => "submit",
            //             "isButton" => true,
            //             "name" => "name",
            //         ],
            //     ]
            // ]

        ];

        $options = [
            'isView' => true,
            'view' => 'masterdata::index ',
            'columns' => $columns,
            'actions' => $actions,
            'page_title' => __('ActivityLog Data'),
            'headerButtons'   => $headerButtons,
            'modalInputs'   => $modalInputs,
        ];
        return responseSuccess($data, __('ActivityLog Data'), options: $options);
    }

    public function api($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');

        $collection = QueryBuilder::for($this->model)
            ->allowedFilters(['event', 'log_name', 'subject_type', 'subject_id'])
            ->allowedSorts(['subject_type']);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);
        return responseSuccess($data, __('ActivityLog Data'), options: ['isView' => false]);
    }



    public function destroy($activity_log)
    {
        $activity_log->delete();

        return back()->with(['success' => __('Destroyed Successfully')]);
    }
}
