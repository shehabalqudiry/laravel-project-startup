<?php

namespace Modules\MasterData\App\Repositories\CustomField;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\CustomField\App\Http\Requests\StoreRequest;
use Modules\MasterData\CustomField\App\Models\CustomField;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\CustomField\App\resources\CurrenciesResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomFieldRepository implements CustomFieldInterface
{
    public function getModel()
    {
        return new CustomField();
    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $data = $perPage == -1 ? $this->getModel()->search($request['search'])->orderBy('created_at', 'desc')->get() : $this->getModel()->search($request['search'])->orderBy('created_at', 'desc')->paginate($perPage);

        return (new API)
            ->isOk(__('Currencies'))
            ->setData($perPage == -1 ? CurrenciesResource::collection($data) : (new API)->api_model_set_paginate(CurrenciesResource::collection($data), $data))
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
            ->isOk(__('CustomField Data'))
            ->setData(CurrenciesResource::make($city))
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
