<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MasterData\App\Http\Requests\Dashboard\Roles\StoreRequest;
use Modules\MasterData\App\Http\Requests\Dashboard\Roles\UpdateRequest;
use Modules\MasterData\App\Models\Permission;
use Modules\MasterData\App\Models\Role;
use Modules\MasterData\App\Services\Dashboard\RoleAndPermissionService;

class RoleController extends Controller
{
    public function __construct(protected RoleAndPermissionService $role_and_permission) {}

    public function index(Request $request)
    {
        $data = $this->role_and_permission->getRoles($request)['data'];
        $permissions = Permission::groupBy(
            'module',
        )->get();
        $columns = [
            "id" => 'ID',
            "display_name" => 'Display Name',
        ];

        $actions = [
            // "edit" => ["label" => "Edit", "class" => 'btn btn-outline-primary', "href" => "#", "action_route" => 'activitylog.update'],
            "show" => ["label" => "Show", "class" => 'btn btn-outline-info', "href" => "#", "action_route" => 'roles.show'],
            "delete" => ["label" => "Delete", "class" => 'btn btn-outline-danger', "href" => "#", "action_route" => 'roles.destroy'],
        ];
        $headerButtons = [
            "add" => "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#AddModal'>Add</button>",
        ];

        $modalInputs = [
            [
                "modalId" => "AddModal",
                "modalName" => "AddModal",
                "formOptions" => "action=" . route('roles.store') . " method=POST enctype=multipart/form-data",
                "data" => [
                    [
                        "tagtype" => "input",
                        "label" => "Display Name",
                        "type" => "text",
                        "required" => "required",
                        "isButton" => false,
                        "name" => "display_name",
                        "value" => "old('email')",
                    ],

                    [
                        "tagtype" => "button",
                        "label" => "Add New",
                        "type" => "submit",
                        "isButton" => true,
                        "name" => "name",
                        "value" => "old('name')",
                    ],
                ]
            ]
        ];
        $modalInputsUpdate = [
            [
                "modalId" => "UpdateModal",
                "formOptions" => "method=POST enctype=multipart/form-data",
                "route" => 'roles.update',
                "relation" => "colorproduct",
                "data" => [
                    [
                        "tagtype" => "input",
                        "label" => "Display Name",
                        "type" => "text",
                        "isButton" => false,
                        "name" => "display_name",
                        "value" => "old('email')",
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
            "route" => 'roles.destroy',
        ];
        $options = [
            'isView' => true,
            'view' => 'masterdata::roles.index',
            'columns' => $columns,
            'permissions' => $permissions,
            'updateRoute' => 'roles.update',
            'deleteRoute' => 'roles.destroy',
            'actions' => $actions,
            'page_title' => __('Role Data'),
            'headerButtons'   => $headerButtons,
            'modalInputs'   => $modalInputs,
            'modalInputsUpdate' => $modalInputsUpdate,
            'modaldelete' => $modaldelete
        ];
        return responseSuccess($data, options: $options);
    }


    public function store(StoreRequest $request)
    {
        $data = $this->role_and_permission->createRole($request);
        if ($data['status'] == true) {
            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        }
        return redirect()->route('roles.index')->with('error', 'an error on create.');
    }

    public function show(Role $role)
    {
        $data = $this->role_and_permission->showRole($role);
        if ($data['status'] == true) {
            return redirect()->route('roles.show');
        }
        return redirect()->route('roles.index')->with('error', "Role Not Found");
    }

    public function update(Role $role, UpdateRequest $request)
    {
        $data = $this->role_and_permission->updateRole($role, $request);
        if ($data['status'] == true) {
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        }
        return redirect()->route('roles.index')->with('error', 'an error on update.');
    }

    public function destroy(Role $role)
    {
        $data = $this->role_and_permission->destroy($role);
        if ($data['status'] == true) {
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        }
        return redirect()->route('roles.index')->with('error', 'Role not found');
    }
}
