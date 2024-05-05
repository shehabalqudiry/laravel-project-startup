<?php

namespace App\Http\Controllers\Apis\Users;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserResource;

class UserController extends Controller
{
    public function __construct(protected UserService $userService){}
    public function index(Request $request)
    {
        $users = $this->userService->all($request)->paginate(2);
        $users = UserResource::collection($users);
        return responseSuccess(data: $users, msg: __("Users Data Returned Successfully"), status_code: 200);
    }

    public function show($id)
    {
        $user = $this->userService->find($id);
        return responseSuccess(data: $user, msg: __("Users Data Returned Successfully"), status_code: 200);
    }
}
