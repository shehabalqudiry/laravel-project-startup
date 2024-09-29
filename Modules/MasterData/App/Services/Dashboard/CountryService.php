<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Country\CountryInterface;

class CountryService
{
    public function __construct(protected CountryInterface $country_interface)
    {
    }

    public function store(array $data)
    {
        return $this->country_interface->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->country_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->country_interface->destroy($id);
    }

    public function index($request)
    {
        return $this->country_interface->index($request);
    }

    public function show($id)
    {
        return $this->country_interface->show($id);
    }
}
