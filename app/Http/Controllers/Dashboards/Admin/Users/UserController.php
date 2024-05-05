<?php

namespace App\Http\Controllers\Dashboards\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboards\Admin\Users\UserCreateRequest;
use App\Http\Requests\Dashboards\Admin\Users\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $parentView = 'dashboards.admin.';
    public function __construct(protected UserService $userService) {}

    public function index(Request $request)
    {
        $users = $this->userService->all($request)->get();
        return view($this->parentView . 'users.index', compact('users'));
    }

    public function create()
    {
        return view($this->parentView . 'users.create');
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->create($data);

        return redirect()->route('users.show', $user->id);
    }

    public function show($id)
    {
        $user = $this->userService->find($id);
        return view($this->parentView . 'users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->find($id);
        return view($this->parentView . 'users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $user = $this->userService->update($data, $id);

        return redirect()->route('users.show', $user->id);
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()->route('users.index');
    }
}
