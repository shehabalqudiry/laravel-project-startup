<?php

namespace Modules\MasterData\App\Repositories\Setting;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Setting\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Models\Setting;
use Modules\MasterData\App\resource\Settings\SettingResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;

class SettingRepository implements SettingInterface
{
    public function __construct(protected $model = new Setting()) {}
    public function index($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        // $collection = $this->model->distinct();
        $collection = QueryBuilder::for($this->model->distinct())
            ->allowedFilters(['event', 'log_name', 'subject_type', 'subject_id'])
            ->allowedSorts(['subject_type']);
        $data = $perPage == -1 ? $collection->get(['title']) : $collection->select(['title'])->paginate($perPage);
        // $grouped_setting_data = $this->model->distinct()->get(['title']);
        $grouped_setting_data = $data->map(function ($item) {
            // Fetch additional data based on the title
            $setting_data_by_title = $this->model->where('title', $item->title)->get();

            // Append the additional data to the item
            $item->data = SettingResource::collection($setting_data_by_title);
            $item->title = $item->custom_title;

            return $item;
        });

        $columns = [
            "id" => 'ID',
            "key" => 'Key',
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



        $options = [
            'isView' => true,
            'view' => 'masterdata::settings',
            'columns' => $columns,
            'actions' => $actions,
            'page_title' => __('Settings'),
            'headerButtons'   => $headerButtons,
        ];
        return responseSuccess($data, __('Settings'), options: $options);
    }
    public function update($setting, $request)
    {
        try {
            // return $setting;
            $setting->update($request->validated());
            if ($setting->value && $setting->type == 'file') {
                $file = $request->file('value');
                $filename = $file->getClientOriginalName();
                $path = '/uploads/settings/';
                $file->move($path, $filename);
                $setting->update(['value' => $path . $filename]);
            }



            return back()->with('success', "Setting Updated Successfully");
        } catch (\Exception $e) {
            return back()->with('fail', "Error : " . $e->getMessage());
        }
    }
}
