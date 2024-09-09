<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Admin;

interface UserInterface
{

    public function index($request );

    public function store($request);
    public function show($user);

    public function update($user , $request);

    public function destroy($user);

}
