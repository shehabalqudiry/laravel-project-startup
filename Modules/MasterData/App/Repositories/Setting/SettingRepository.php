<?php

namespace Modules\MasterData\App\Repositories\Setting;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Setting\App\Http\Requests\StoreRequest;
use Modules\MasterData\Setting\App\Models\Setting;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\Setting\App\resources\SettingResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SettingRepository implements SettingInterface
{
    public function getModel()
    {
        return new Setting();
    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->getModel()->distinct();
        $data = $perPage == -1 ? $collection->get(['title']) : $collection->select(['title'])->paginate($perPage);
        // $grouped_setting_data = $this->getModel()->distinct()->get(['title']);
        $grouped_setting_data = $data->map(function ($item) {
            // Fetch additional data based on the title
            $setting_data_by_title = $this->getModel()->where('title', $item->title)->get();

            // Append the additional data to the item
            $item->data = SettingResource::collection($setting_data_by_title);
            $item->title = $item->custom_title;

            return $item;
        });


        // return response()->json($grouped_setting_data);
        return (new API)
            ->isOk(__('Setting'))
            ->setData($perPage == -1 ? $data : (new API)->api_model_set_paginate($data, $data))
            ->build();
    }

    public function store($request)
    {
        try {

            $setting = $this->getModel()->create($request->validated());

            //save image with setting object
            if ($request->hasFile('image')) {

                $setting->addMediaFromRequest('image')->toMediaCollection('setting');
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

    public function show($setting)
    {

        return (new API)
            ->isOk(__('Setting Data'))
            ->setData(SettingResource::make($setting))
            ->build();
    }

    public function update($setting, $request)
    {
        try {
            // return $setting;
            $setting->update($request->validated());
            if ($setting->value && $setting->type == 'file') {
                $file = $request->file('value');
                $filename = $file->getClientOriginalName();
                $path = '/uploads/settings/';
                $file->move($path, $filename);
                $setting->update(['value' => $path . $filename]);
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

    public function destroy($setting)
    {
        $setting->delete();
        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
