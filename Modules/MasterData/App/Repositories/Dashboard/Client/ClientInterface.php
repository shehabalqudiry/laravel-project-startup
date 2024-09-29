<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Client;

interface ClientInterface
{

    public function index($request);

    public function store($request);
    public function show($client);

    public function update($client , $request);

    public function destroy($client);

}
