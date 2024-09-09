<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Country;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Country\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Models\Country;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\CountryFilters;
use Modules\MasterData\Country\App\resources\CountriesResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CountryRepository implements CountryInterface
{
    public function __construct(protected Country $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = CountryFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {
            $country = $this->model->create($request->validated());

            //save image with country object
            if ($request->hasFile('image')) {

                $country->addMediaFromRequest('image')->toMediaCollection('country');
            }

            if ($request->hasFile('images')) {
                if ($images = $request->file('images')) {
                    $country->clearMediaCollection('images');
                    foreach ($images as $image) {
                        $country->addMedia($image)->toMediaCollection('images');
                    }
                }
            }

            return responseSuccess($country,msg:__('created successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($country)
    {

        return responseSuccess($country,msg:__('data'));
    }

    public function update($country, $request)
    {
        try {
            $country->update($request->validated());

            //save new image with country object and delete old image
            if ($request->hasFile('image')) {
                $file_name = $country->getMedia('country')->last()->file_name;
                $img_id = $country->getMedia('country')->last()->id;
                if ($img_id && $file_name) {

                    if (File::exists(public_path('storage/' . $img_id . '/' . $file_name))) {
                        unlink(public_path('storage/' . $img_id . '/' . $file_name));
                    }
                }
                Media::find($country->getMedia('country')->last()->id)->delete();

                $country->addMediaFromRequest('image')->toMediaCollection('country');
            }

            return responseSuccess($country,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($country)
    {
        $file_name = $country->getMedia('country')->last()->file_name ?? null;
        $img_id = $country->getMedia('country')->last()->id ?? null;
        if ($img_id && $file_name) {

            if (File::exists(public_path('storage/' . $img_id . '/' . $file_name))) {
                unlink(public_path('storage/' . $img_id . '/' . $file_name));
            }
        }
        if ($img_id) {

            Media::find($country->getMedia('country')->last()->id)->delete();
        }
        $country->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
