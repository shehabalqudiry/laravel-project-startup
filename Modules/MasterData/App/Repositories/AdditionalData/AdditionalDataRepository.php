<?php

namespace Modules\MasterData\App\Repositories\AdditionalData;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\AdditionalData\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Models\AdditionalData;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\AdditionalData\App\resources\AdditionalDataResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;

class AdditionalDataRepository implements AdditionalDataInterface
{

    public function __construct(protected $model = new AdditionalData())
    {
    }



    public function index($request)
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');

        $collection = QueryBuilder::for($this->model)
            ->allowedFilters(['key'])
            ->allowedSorts(['key']);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);
        $columns = [
            "id" => 'ID',
            "key" => 'Key Name',
            "value"  => __("Value")
        ];
        $actions = [
            "edit" => "<button class='btn btn-primary'>Edit</button>",
            "delete" => "<button class='btn btn-danger'>Delete</button>",
        ];

        $options = [
            'isView' => true,
            'view' => 'masterdata::index',
            'columns' => $columns,
            'actions' => $actions,
            'page_title' => __('Additional Data'),
        ];
        return responseSuccess($data, __('Additional Data'), options: $options);
        // return (new API)
        //     ->isOk(__('AdditionalData'))
        //     ->setData($perPage == -1 ? AdditionalDataResource::collection($data) : (new API)->api_model_set_paginate(AdditionalDataResource::collection($data), $data))
        //     ->build();
    }

    public function store($request)
    {
        try {

            $country = $this->getModel()->create($request->validated());

            //save image with country object
            if ($request->hasFile('image')) {

                $country->addMediaFromRequest('image')->toMediaCollection('country');
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

    public function show($country)
    {

        return (new API)
            ->isOk(__('AdditionalData Data'))
            ->setData(AdditionalDataResource::make($country))
            ->build();
    }

    public function update($country, $request)
    {
        try {

            $country->update($request->validated());

            //save new image with country object and delete old image
            if ($request->hasFile('image')) {
                if (File::exists(storage_path('storage/' . $country->getMedia('country')->last()->id))) {
                    unlink(storage_path('storage/' . $country->getMedia('country')->last()->id));
                }
                Media::find($country->getMedia('country')->last()->id)->delete();

                $country->addMediaFromRequest('image')->toMediaCollection('country');
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

    public function destroy($country)
    {
        $country->delete();
        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
