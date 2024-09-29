<?php

namespace Modules\MasterData\App\Repositories\Dashboard\AdditionalData;

use App\Traits\API;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\File;
use Spatie\QueryBuilder\QueryBuilder;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Models\AdditionalData;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\MasterData\App\Filters\AdditionalDataFilters;
use Modules\MasterData\AdditionalData\App\Http\Requests\StoreRequest;
use Modules\MasterData\AdditionalData\App\resources\AdditionalDataResource;

class AdditionalDataRepository implements AdditionalDataInterface
{

    public function __construct(protected AdditionalData $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = AdditionalDataFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {

            $additional_data = $this->model->create($request->validated());
            return responseSuccess($additional_data,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($additional_data)
    {

        return responseSuccess($additional_data,msg:__('data'));
    }

    public function update($additional_data, $request)
    {
        try {
            $additional_data = $this->model->update($request->validated());

            return responseSuccess($additional_data,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($additional_data)
    {
        $additional_data->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
