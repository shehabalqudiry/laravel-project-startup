<?php

namespace Modules\MasterData\App\Repositories\RoleAndPermission;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Modules\MasterData\RoleAndPermission\App\Http\Requests\StoreRequest;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\RoleAndPermission\App\resources\PermissionsResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class PermissionRepository implements PermissionInterface
{

    public function getModel()
    {
        return new Permission();
    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $data = $perPage == -1 ? $this->getModel()->search($request['search'])->orderBy('created_at', 'desc')->get() : $this->getModel()->search($request['search'])->orderBy('created_at', 'desc')->paginate($perPage);

        return (new API)
            ->isOk(__('Permissions'))
            ->setData($perPage == -1 ? PermissionsResource::collection($data) : (new API)->api_model_set_paginate(PermissionsResource::collection($data), $data))
            ->build();
    }
}
