<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Department;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\App\Models\Department;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\DepartementFilters;
use Modules\MasterData\Department\App\resources\DepartmentsResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DepartmentRepository implements DepartmentInterface
{
    public function __construct(protected Department $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = DepartementFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {

            $departement = $this->model->create($request->validated());
            return responseSuccess($departement,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($departement)
    {

        return responseSuccess($departement,msg:__('data'));
    }

    public function update($departement, $request)
    {
        try {
            $departement = $this->model->update($request->validated());

            return responseSuccess($departement,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($departement)
    {
        $departement->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
