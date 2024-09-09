<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Client\ClientInterface;

class ClientService
{
    public function __construct(protected ClientInterface $client_interface){}

    public function store(array $data)
    {
        return $this->client_interface->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->client_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->client_interface->destroy($id);
    }

    public function index($request)
    {
        return $this->client_interface->index($request);
    }

    public function show($id)
    {
        return $this->client_interface->show($id);
    }
}
