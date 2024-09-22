<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Admin\App\Http\Requests\StoreRequest;
use Modules\MasterData\Admin\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Admin\App\Models\User;
use Modules\MasterData\App\Filters\AdminFilters;
use Modules\MasterData\App\Repositories\Dashboard\Admin\UserInterface;
class UserController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request, AdminFilters $filter)
    {
        return $this->user->index($request, $filter);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->user->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(User $user)
    {
        return $this->user->show($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(User $user , UpdateRequest $request)
    {
        return $this->user->update($user , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $this->user->destroy($user);
    }
}
