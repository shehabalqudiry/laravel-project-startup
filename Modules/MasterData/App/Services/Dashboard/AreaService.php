<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Area\AreaInterface;
use Modules\MasterData\App\Repositories\Dashboard\Area\AreaRepository;

class AreaService
{
    public function __construct(protected AreaInterface $area_interface){}


    public function store(array $data)
    {
        return $this->area_interface->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->area_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->area_interface->destroy($id);
    }

    public function index($request)
    {
        return $this->area_interface->index($request);
    }

    public function show($id)
    {
        return $this->area_interface->show($id);
    }
}
