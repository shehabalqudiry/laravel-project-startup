<?php

namespace Modules\MasterData\App\Repositories\Dashboard\City;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\City\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Models\City;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\CityFilters;
use Modules\MasterData\App\resources\City\CitiesResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CityRepository implements CityInterface
{
    public function __construct(protected City $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = CityFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {

            $city = $this->model->create($request->validated());
            return responseSuccess($city,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($city)
    {

        return responseSuccess($city,msg:__('data'));
    }

    public function update($city, $request)
    {
        try {
            $city = $this->model->update($request->validated());

            return responseSuccess($city,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($city)
    {
        $city->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
