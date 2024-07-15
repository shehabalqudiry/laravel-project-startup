<?php

namespace Modules\MasterData\App\Repositories\CustomField;

interface CustomFieldInterface
{

    public function index($request);

    public function store($request);
    public function show($city);

    public function update($city , $request);

    public function destroy($city);

}
