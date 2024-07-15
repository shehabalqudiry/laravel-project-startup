<?php

namespace Modules\MasterData\App\Repositories\Currency;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Currency\App\Http\Requests\StoreRequest;
use Modules\MasterData\Currency\App\Models\Currency;
use App\Repositories\Dashboard\BaseRepository;
use Modules\Accounting\Order\App\Models\Order;
use Modules\Accounting\Receipt\App\Models\Receipt;
use Modules\MasterData\Currency\App\resources\CurrenciesResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Accounting\GlTransaction\App\Models\GlTransaction;

class CurrencyRepository implements CurrencyInterface
{
    public function getModel()
    {
        return new Currency();
    }



    public function index($request, $filter): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->getModel()->filter($filter)->orderBy('created_at', 'desc');
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return (new API)
            ->isOk(__('Currencies'))
            ->setData($perPage == -1 ? CurrenciesResource::collection($data) : (new API)->api_model_set_paginate(CurrenciesResource::collection($data), $data))
            ->build();
    }

    public function store($request)
    {
        try {

            $this->getModel()->create($request->validated());

            //save image with currency object

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

    public function show($currency)
    {

        return (new API)
            ->isOk(__('Currency Data'))
            ->setData(CurrenciesResource::make($currency))
            ->build();
    }

    public function update($currency, $request)
    {
        try {

            if ($currency->base == 1) {

                $orders = Order::all();
                $receipts = Receipt::all();
                $gls = GlTransaction::all();
                //return $gls;
                foreach ($gls as $gl) {
                    $current_gl = $gl->currency;
                    //   return $current->base;
                    if ($current_gl->base == 1) {
                        return (new API)
                            ->isError(__('Cannot update the base currency because it has gl transactions belongs to it'))
                            ->build();
                    }
                }
                foreach ($receipts as $receipt) {
                    $current_receipt = $receipt->safe->currency;
                    //   return $current->base;
                    if ($current_receipt->base == 1) {
                        return (new API)
                            ->isError(__('Cannot update the base currency because it has receipts belongs to it'))
                            ->build();
                    }
                }
                foreach ($orders as $order) {
                    $current_order = $order->safe->currency;
                    //   return $current->base;
                    if ($current_order->base == 1) {
                        return (new API)
                            ->isError(__('Cannot update the base currency because it has orders belongs to it'))
                            ->build();
                    }
                }
            } else {
                $currency->update($request->validated());
            }
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

    public function destroy($currency)
    {
        if ($currency->base == 1) {
            return (new API)
                ->isError(__('Cannot delete the base currency '))
                ->build();
        }
        $currency->delete();
        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
