<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Branch;

use App\Http\Responses\ApiResponse;
use App\Traits\API;
use Illuminate\Support\Facades\File;
use Modules\MasterData\Branch\App\Http\Requests\StoreRequest;
use Modules\MasterData\App\Models\Branch;
use Modules\MasterData\App\Models\Client;
use App\Models\User;
use Modules\MasterData\App\Models\Supplier;
use App\Repositories\Dashboard\BaseRepository;
use Modules\MasterData\App\Filters\BranchFilters;
use Modules\MasterData\Branch\App\resources\BranchesResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BranchRepository implements BranchInterface
{
    public function __construct(protected Branch $model) {

    }



    public function index($request): \Illuminate\Http\JsonResponse
    {
        $perPage = $request['per_page'] ?? config('myConfig.paginationCount');
        $collection = $this->model->orderBy('created_at', 'desc');
        $collection = BranchFilters::apply($this->model);
        $data = $perPage == -1 ? $collection->get() : $collection->paginate($perPage);

        return responseSuccess($data,msg:'data');
    }

    public function store($request)
    {
        try {


            switch ($request->user_type) {
                case 'our_branch':
                    break;
                case 'client':
                    $item = Client::find($request->item_id);
                    break;
                case 'supplier':
                    $item = Supplier::find($request->item_id);
                    break;
            }

            if ($request->user_type == 'our_branch') {
                $branch = $this->model->create($request->validated());
            } else {
                $branch = $item->branchable()->create($request->validated());
            }


            return responseSuccess($branch,msg:__('created successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function show($branch)
    {

        return responseSuccess($branch,msg:__('data'));
    }

    public function update($branch, $request)
    {
        try {
            switch ($request->user_type) {
                case 'our_branch':
                    break;
                case 'client':
                    $item = Client::find($request->item_id);
                    break;
                case 'supplier':
                    $item = Supplier::find($request->item_id);
                    break;
            }

            if ($request->user_type == 'our_branch') {
                $branch = $this->model->update($request->validated());
            } else {
                $branch = $item->branchable()->update($request->validated());
            }

            //save new image with branch object and delete old image

            return responseSuccess($branch,msg:__('updated successfully'));
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    public function destroy($branch)
    {
        $branch->delete();
        return responseSuccess([],msg:__('destoried successfully'));
    }
}
