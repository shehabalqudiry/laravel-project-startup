<?php

namespace Modules\MasterData\App\Repositories\Client;

interface ClientInterface
{

    public function index($request,$filter);

    public function store($request);
    public function show($client);

    public function update($client , $request);

    public function destroy($client);

}
