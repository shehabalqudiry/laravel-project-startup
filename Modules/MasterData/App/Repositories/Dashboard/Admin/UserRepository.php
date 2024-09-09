<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Admin;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Admin\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Models\User;
use Modules\MasterData\RoleAndPermission\App\Models\Role;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\Admin\App\resources\UsersResource;
use Modules\MasterData\App\Filters\UserFilters;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserRepository implements UserInterface
{
    public function __construct(protected User $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = UserFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
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
