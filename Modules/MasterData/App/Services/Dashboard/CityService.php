<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\City\CityInterface;

class CityService
{
    public function __construct(protected CityInterface $city_interface){}

    public function store(array $data)
    {
        return $this->city_interface->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->city_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->city_interface->destroy($id);
    }

    public function index($request)
    {
        return $this->city_interface->index($request);
    }

    public function show($id)
    {
        return $this->city_interface->show($id);
    }
}
