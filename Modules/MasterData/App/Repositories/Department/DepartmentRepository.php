<?php

namespace Modules\MasterData\App\Repositories\Department;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Department\App\Http\Requests\StoreRequest;
use Modules\MasterData\Department\App\Models\Department;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\Department\App\resources\DepartmentsResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DepartmentRepository implements DepartmentInterface
{
    public function getModel()
    {
        return new Department();
    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $data = $perPage == -1 ? $this->getModel()->search($request['search'])->orderBy('created_at', 'desc')->get() : $this->getModel()->search($request['search'])->orderBy('created_at', 'desc')->paginate($perPage);

        return (new API)
            ->isOk(__('Departments'))
            ->setData($perPage == -1 ? DepartmentsResource::collection($data) : (new API)->api_model_set_paginate(DepartmentsResource::collection($data), $data))
            ->build();
    }

    public function store($request)
    {
        try {

            $department = $this->getModel()->create($request->validated());

            //save image with department object

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

    public function show($department)
    {

        return (new API)
            ->isOk(__('Department Data'))
            ->setData(DepartmentsResource::make($department))
            ->build();
    }

    public function update($department, $request)
    {
        try {

            $department->update($request->validated());

            //save new image with department object and delete old image

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

    public function destroy($department)
    {
        $department->delete();
        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
