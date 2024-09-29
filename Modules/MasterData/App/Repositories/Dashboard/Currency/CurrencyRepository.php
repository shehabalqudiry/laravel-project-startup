<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Currency;

use App\Traits\API;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\File;
use Modules\MasterData\App\Models\Currency;
use App\Repositories\Dashboard\BaseRepository;
use Modules\Accounting\Order\App\Models\Order;
use Modules\Accounting\Receipt\App\Models\Receipt;
use Modules\MasterData\App\Filters\CurrencyFilters;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Accounting\GlTransaction\App\Models\GlTransaction;
use Modules\MasterData\Currency\App\Http\Requests\StoreRequest;
use Modules\MasterData\Currency\App\resources\CurrenciesResource;

class CurrencyRepository implements CurrencyInterface
{
    public function __construct(protected Currency $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = CurrencyFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {

            $currency = $this->model->create($request->validated());

            //save image with currency object

            return responseSuccess($currency,msg:__('created successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($currency)
    {

        return responseSuccess($currency,msg:__('data'));
    }

    public function update($currency, $request)
    {
        try {

            if ($currency->base == 1) {


            } else {
                $currency->update($request->validated());
            }
            return responseSuccess($currency,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($currency)
    {
        if ($currency->base == 1) {
                return responseError(__('Cannot delete the base currency '));
        }
        $currency->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
