<?php

namespace Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\StoreRequest;
use App\Repositories\Dashboard\BaseRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\AdditionalDataTrait;
use Modules\MasterData\App\Models\Permission;
use Modules\MasterData\App\Models\Role;

class RoleRepository implements RoleInterface
{
    use AdditionalDataTrait;

    public function __construct(protected Role $model){}



    public function index($request)
    {
        $data = $this->model->orderBy('created_at', 'desc')->get();
        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function store($request)
    {
        try {
            $data = $request->validated();
            $data['name'] = slug($data['display_name']);
            $role = $this->model->create($data);

            if ($request->permission_ids) {
                $permissions = Permission::whereIn('id', $request->permission_ids)->pluck('name');
                $role->syncPermissions($permissions);
            }

            return [
                'status' => true,
                'data' => $role
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'data' => "An Error occurred : " . $e->getMessage()
            ];
        }
    }

    public function show($role)
    {
        return [
            'status' => true,
            'data' => $role
        ];
    }

    public function update($role, $request)
    {
        try {
            $data = $request->validated();
            $data['name'] = str_slug(l($data['display_name']), '_');

            $role->update($data);

            if ($request->permission_ids) {
                $permissions = Permission::whereIn('id', $request->permission_ids)->pluck('name');
                $role->syncPermissions($permissions);
            }


            return [
                'status' => true,
                'data' => "Role updated successfully"
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'data' => "An Error occurred : " . $e->getMessage()
            ];
        }
    }

    public function destroy($role)
    {
        $role->delete();
        return [
            'status' => true,
            'data' => "Role deleted successfully"
        ];
    }
}
