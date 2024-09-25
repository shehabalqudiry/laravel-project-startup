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
            "id" => __('ID'),
            "name" => __('Name'),
            "email" => __('Email'),
            "status_colored" => __('Status'),
        ];

        $actions = [
            "edit" => ["label" => __("Edit"), "class" => 'btn btn-outline-primary', "href" => "#", "action_route" => 'user.update'],
            "show" => ["label" => __("Show"), "class" => 'btn btn-outline-info', "href" => "#", "action_route" => 'user.show'],
            "delete" => ["label" => __("Delete"), "class" => 'btn btn-outline-danger', "href" => "#", "action_route" => 'user.destroy'],
        ];
        $headerButtons = [
            "add" => "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#AddModal'>Add</button>",
        ];

        $translatableFields = $this->model->getTranslatableFields();
        $translatableInputs=[];
        foreach ($translatableFields as $field) {
            foreach (config('myConfig.langs') as $lang) {
                $translatableInputs[]=[
                    "tagtype" => "input",
                    "label" => __(ucfirst($field)) . " (" . $lang . ")",
                    "type" => "text",
                    "required" => "required",
                    "placeholder" => __("Please Enter " . ucfirst($field)) . " (" . $lang . ")",
                    "isButton" => false,
                    "name" => "{$field}_{$lang}", // Use field name with language suffix
                    "value" => "old('{$field}_{$lang}')",
                ];
            }
        };
        // Get non-translatable fields
        $nonTranslatableFields = $this->model->getNonTranslatableFields();

        // Generate non-translatable inputs
        $nonTranslatableInputs = [];
        foreach ($nonTranslatableFields as $fieldConfig) {
            $nonTranslatableInputs[] = $fieldConfig; // Append the field configuration directly
        }

        // Merge both translatable and non-translatable inputs into modal configuration
        $modalInputs = [
            [
                "modalId" => "AddModal",
                "modalName" => "AddModal",
                "formOptions" => "action=" . route('user.store') . " method=POST enctype=multipart/form-data",
                "data" => array_merge($translatableInputs, $nonTranslatableInputs, [
                    [
                        "tagtype" => "button",
                        "label" => "Add New",
                        "type" => "submit",
                        "isButton" => true,
                        "name" => "submit",
                        "value" => "Add New",
                    ],
                ]),
            ],
        ];

        $modalInputsUpdate = [
            [
                "modalId" => "UpdateModal",
                "formOptions" => "method=POST enctype=multipart/form-data",
                "route" => 'user.update',
                "relation" => "colorproduct",
                "data" => [
                    [
                        "tagtype" => "input",
                        "label" => __("Name"),
                        "type" => "text",
                        "required" => "required",
                        "placeholder" => __("Please Enter Name"),
                        "isButton" => false,
                        "name" => "name",
                        "value" => "old('name')",
                    ],

                    [
                        "tagtype" => "input",
                        "label" => __("Email"),
                        "type" => "email",
                        "required" => "required",
                        "placeholder" => __("Please Enter Email"),
                        "isButton" => false,
                        "name" => "email",
                        "value" => "old('email')",
                    ],

                    [
                        "tagtype" => "checkbox",
                        "label" => __("Status"),
                        "type" => "checkbox",
                        "additional_class"=>"form-check-input",
                        "required" => "",
                        "placeholder" => __("Please Enter Email"),
                        "isButton" => false,
                        "name" => "status",
                        "value" => "old('status')",
                    ],


                    [
                        "tagtype" => "input",
                        "label" => __("Password"),
                        "type" => "password",
                        "required" => "required",
                        "placeholder" => __("Please Enter Password"),
                        "isButton" => false,
                        "name" => "password",
                        // "value" => "old('password')",
                    ],
                    [
                        "tagtype" => "button",
                        "label" => "Update User",
                        "type" => "submit",
                        "isButton" => true,
                        "name" => "buttonupdate",
                        "value" => "old('button')",
                    ],
                ]
            ]
        ];
        $modaldelete = [
            "modalId" => "DeleteModal",
            "formOptions" => "method=POST",
            "route" => 'user.destroy',
        ];

        $options = [
            'isView' => true,
            'view' => 'masterdata::index',
            'columns' => $columns,
            'updateRoute' => 'user.update',
            'deleteRoute' => 'user.destroy',
            'actions' => $actions,
            'page_title' => __('User Data'),
            'headerButtons'   => $headerButtons,
            'modalInputs'   => $modalInputs,
            'modalInputsUpdate' => $modalInputsUpdate,
            'modaldelete' => $modaldelete
        ];
        return responseSuccess($data, __('User Data'), options: $options);
    }

    public function store($request)
    {
        try {
            // return $request;
            $user = $this->model->create($request->validated());
            return redirect()->back();
            // return responseSuccess($user,msg:__('created successfully'));

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
