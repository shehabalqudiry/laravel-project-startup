<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Client;

use App\Traits\API;
use App\Models\User;
use App\Traits\CustomFieldTrait;
use App\Http\Responses\ApiResponse;
use App\Traits\AdditionalDataTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Modules\MasterData\App\Models\Client;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\ClientFilters;
use Modules\MasterData\App\Models\Setting;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\MasterData\App\resources\Client\ClientsResource;
use Modules\MasterData\App\Http\Requests\Client\StoreRequest;
use Modules\MasterData\App\Models\Client as ModelsClient;

class ClientRepository implements ClientInterface
{
    use AdditionalDataTrait;
    use CustomFieldTrait;

    public function __construct(protected Client $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = ClientFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
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

            if ($request->custom_fields) {
                $client->addCustomField($request->custom_fields);
            }


            return responseSuccess($client,msg:__('created successfully'));

        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($client)
    {

        return responseSuccess($client,msg:__('data'));
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


            if ($request->custom_fields) {
                $client->updateCustomField($request->custom_fields);
            }
            return responseSuccess($client,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($client)
    {
        $client->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
