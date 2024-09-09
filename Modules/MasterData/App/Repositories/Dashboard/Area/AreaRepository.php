<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Area;

use App\Traits\API;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\File;
use Modules\MasterData\App\Models\Area;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\AreaFilters;
use Modules\MasterData\App\Filters\AreaFilter;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\MasterData\App\resources\Area\AreasResource;
use Modules\MasterData\App\Http\Requests\Area\StoreRequest;

class AreaRepository implements AreaInterface
{
    public function __construct(protected Area $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = AreaFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {

            $area = $this->model->create($request->validated());
            return responseSuccess($area,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($area)
    {

        return responseSuccess($area,msg:__('data'));
    }

    public function update($area, $request)
    {
        try {
            $area = $this->model->update($request->validated());

            return responseSuccess($area,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($area)
    {
        $area->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
