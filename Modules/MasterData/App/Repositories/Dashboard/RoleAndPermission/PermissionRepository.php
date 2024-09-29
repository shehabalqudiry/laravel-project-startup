<?php

namespace Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\StoreRequest;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Models\Permission;
use Modules\MasterData\RoleAndPermission\App\resources\PermissionsResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class PermissionRepository implements PermissionInterface
{

    public function __construct(protected Permission $model){}

    public function index($request)
    {
        $data = $this->model->groupBy('module')->get();
        return $data;
    }
}
