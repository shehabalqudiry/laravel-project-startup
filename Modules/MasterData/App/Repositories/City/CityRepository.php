<?php

namespace Modules\MasterData\App\Repositories\City;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\City\App\Http\Requests\StoreRequest;
use Modules\MasterData\City\App\Models\City;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\resources\City\CitiesResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CityRepository implements CityInterface
{
    public function getModel()
    {
        return new City();
    }



    public function index($request, $filter): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->getModel()->filter($filter)->orderBy('created_at', 'desc');
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return (new API)
            ->isOk(__('Cities'))
            ->setData($perPage == -1 ? CitiesResource::collection($data) : (new API)->api_model_set_paginate(CitiesResource::collection($data), $data))
            ->build();
    }

    public function store($request)
    {
        try {

            $this->getModel()->create($request->validated());

            //save image with city object

            return (new API)
                ->isCreated(__('Stored Successfully'))
                ->build();
        } catch (\Exception $e) {
            return (new API)
                ->isError('An Error occured')
                ->setStatus(500)
                ->build();
        }
    }

    public function show($city)
    {

        return (new API)
            ->isOk(__('City Data'))
            ->setData(CitiesResource::make($city))
            ->build();
    }

    public function update($city, $request)
    {
        try {

            $city->update($request->validated());

            //save new image with city object and delete old image

            return (new API)
                ->isCreated(__('Updated Successfully'))
                ->build();
        } catch (\Exception $e) {
            return (new API)
                ->isError('An Error occured')
                ->setStatus(500)
                ->build();
        }
    }

    public function destroy($city)
    {
        $city->delete();
        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
