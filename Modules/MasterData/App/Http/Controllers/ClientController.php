<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Modules\MasterData\Client\App\Filters\ClientFilter;
use Modules\MasterData\Client\App\Http\Requests\StoreRequest;
use Modules\MasterData\Client\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Client\App\Models\Client;
use Modules\MasterData\Client\App\Repositories\ClientInterface;


class ClientController extends Controller
{
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function index(Request $request,ClientFilter $filter)
    {
        return $this->client->index($request,$filter);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // return $request;
        return $this->client->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Client $client)
    {
        return $this->client->show($client);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Client $client , UpdateRequest $request)
    {
        return $this->client->update($client , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        return $this->client->destroy($client);
    }
}
