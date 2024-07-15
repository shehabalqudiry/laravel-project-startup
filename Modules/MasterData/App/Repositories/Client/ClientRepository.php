<?php

namespace Modules\MasterData\App\Repositories\Client;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Modules\MasterData\App\Http\Requests\Client\StoreRequest;
use Modules\MasterData\App\Models\Client;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\resources\Client\ClientsResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\AdditionalDataTrait;
use App\Traits\CustomFieldTrait;
use Modules\MasterData\Setting\App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class ClientRepository implements ClientInterface
{
    use AdditionalDataTrait;
    use CustomFieldTrait;

    public function getModel()
    {
        return new Client();
    }



    public function index($request, $filter): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->getModel()->filter($filter)->orderBy('created_at', 'desc');
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return (new API)
            ->isOk(__('Clients'))
            ->setData($perPage == -1 ? ClientsResource::collection($data) : (new API)->api_model_set_paginate(ClientsResource::collection($data), $data))
            ->build();
    }

    public function store($request)
    {
        // return $request->custom_fields;
        try {
            $userData = $request->validated(); // Assuming you have validation rules in your form request
            if (!$request->has('password')) {
                $request['password'] = "12345678";
            }
            // Create or update the user record excluding 'type' field
            $user = User::create(
                $request->except('type')
            );

            // Create the client record associated with the user
            $client = $user->client()->create([
                'type' => $userData['type'],
            ]);

            if ($request->additional_data) {
                $client->addAdditionalData($request->additional_data);
            }
            if (Schema::hasColumn('clients', 'chart_account_id')) {
                $client->update([
                    'chart_account_id' => $userData['chart_account_id'] ?? null,
                ]);
                if (!$request->chart_account_id) {
                    $general_client_account = Setting::Where('key', 'client_account_id')->first();
                    $client->update(['chart_account_id' => $general_client_account ? $general_client_account->value : null]);
                }
            }
            if ($request->custom_fields) {
                $client->addCustomField($request->custom_fields);
            }


            return (new API)
                ->isOk(__('Stored Successfully'))
                ->build();
        } catch (\Exception $e) {
            return (new API)
                ->isError('An Error occurred')
                ->setStatus(500)
                ->build();
        }
    }

    public function show($client)
    {

        return (new API)
            ->isOk(__('Client Data'))
            ->setData(ClientsResource::make($client))
            ->build();
    }

    public function update($client, $request)
    {
        try {

            $userData = $request->validated(); // Assuming you have validation rules in your form request
            // Create or update the user record excluding 'type' field
            $client->user->update(
                $request->except('type')
            );

            // Create the client record associated with the user
            $client->update([
                'type' => $userData['type'],
            ]);



            if ($request->additional_data) {
                $client->updateAdditionalData($request->additional_data);
            }

            if (Schema::hasColumn('clients', 'chart_account_id')) {
                $client->update([
                    'chart_account_id' => $userData['chart_account_id'] ?? null,
                ]);
                if (!$request->chart_account_id) {
                    $general_client_account = Setting::Where('key', 'client_account_id')->first();
                    $client->update(['chart_account_id' => $general_client_account ? $general_client_account->value : null]);
                }
            }
            if ($request->custom_fields) {
                $client->updateCustomField($request->custom_fields);
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

    public function destroy($client)
    {
        $client->user->delete();
        $client->delete();

        return (new API)
            ->isOk(__('Destroyed Successfully'))
            ->build();
    }
}
