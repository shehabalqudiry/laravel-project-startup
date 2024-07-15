<?php

namespace Modules\MasterData\App\Repositories\Admin;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Admin\App\Http\Requests\StoreRequest;
use Modules\MasterData\Admin\App\Models\User;
use Modules\MasterData\RoleAndPermission\App\Models\Role;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\Admin\App\resources\UsersResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserRepository implements UserInterface
{
    public function getModel()
    {
        return new User();
    }



    public function index($request, $filter): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->getModel()->filter($filter)->orderBy('created_at', 'desc');
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return (new API)
            ->isOk(__('Users'))
            ->setData($perPage == -1 ? UsersResource::collection($data) : (new API)->api_model_set_paginate(UsersResource::collection($data), $data))
            ->build();
    }

    public function store($request)
    {
        try {

            $user = $this->getModel()->create($request->validated());

            if ($request->role_id) {
                $user->roles()->sync($request->role_id);
            }


            return (new API)
                ->isOk(__('Stored Successfully'))
                ->build();
        } catch (\Exception $e) {
            return (new API)
                ->isError('An Error occured')
                ->setStatus(500)
                ->build();
        }
    }

    public function show($user)
    {

        return (new API)
            ->isOk(__('User Data'))
            ->setData(UsersResource::make($user))
            ->build();
    }

    public function update($user, $request)
    {
        try {

            $user->update($request->validated());

            if ($request->role_id) {
                $user->roles()->sync($request->role_id);
            }

            return (new API)
                ->isOk(__('Updated Successfully'))
                ->build();
        } catch (\Exception $e) {
            return (new API)
                ->isError('An Error occured')
                ->setStatus(500)
                ->build();
        }
    }

    public function destroy($user)
    {
        $user->delete();
        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
