<?php

namespace Modules\MasterData\App\Repositories\Admin;

interface UserInterface
{

    public function index($request , $filter);

    public function store($request);
    public function show($user);

    public function update($user , $request);

    public function destroy($user);

}
