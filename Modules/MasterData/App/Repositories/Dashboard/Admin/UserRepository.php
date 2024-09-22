<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Admin;

use App\Traits\API;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\File;
use Modules\MasterData\App\Models\User;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\UserFilters;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\MasterData\Admin\App\resources\UsersResource;
use Modules\MasterData\RoleAndPermission\App\Models\Role;
use Modules\MasterData\Admin\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Repositories\Dashboard\Admin\UserInterface;

class UserRepository implements UserInterface
{
    public function __construct(protected User $model) {}



    public function index($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = UserFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);


        // return responseSuccess($data,msg:'data', options:["isView" => true, "view" => 'masterdata::index', 'columns' => ['name' => __("Name"), "email" => "User Name"]]);
        $columns = [
            "id" => 'ID',
            "name" => 'Name',
            "email" => 'Email',

        ];
        $modalInputs = [
            "id" => 'ID',
            "name" => 'Name',
            "email" => 'Email',

        ];
        $actions = [
            // "edit" => ["label" => "Edit", "class" => 'btn btn-outline-primary', "href" => "#", "action_route" => 'activitylog.update'],
            "show" => ["label" => "Show", "class" => 'btn btn-outline-info', "href" => "#", "action_route" => 'user.show'],
            // "delete" => ["label" => "Delete", "class" => 'btn btn-outline-danger', "href" => "#", "action_route" => 'activitylog.destroy'],
        ];
        $headerButtons = [
            // "add" => "<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#AddModal'>Add</button>",
        ];



        $options = [
            'isView' => true,
            'view' => 'masterdata::index',
            'columns' => $columns,
            'modalInputs' => $modalInputs,
            'actions' => $actions,
            'page_title' => __('Admins'),
            'headerButtons'   => $headerButtons,
        ];
        return responseSuccess($data, __('Admins'), options: $options);
    }

    public function store($request)
    {
        try {

            $user = $this->model->create($request->validated());
            return responseSuccess($user,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($user)
    {

        return responseSuccess($user,msg:__('data'));
    }

    public function update($user, $request)
    {
        try {
            $user = $this->model->update($request->validated());

            return responseSuccess($user,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($user)
    {
        $user->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
