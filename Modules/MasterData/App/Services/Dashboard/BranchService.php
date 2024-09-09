<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Branch\BranchInterface;
use Modules\MasterData\App\Repositories\Dashboard\Branch\BranchRepository;

class BranchService
{
    public function __construct(protected BranchInterface $branch_interface){}

    public function store(array $data)
    {
        return $this->branch_interface->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->branch_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->branch_interface->destroy($id);
    }

    public function index($request)
    {
        return $this->branch_interface->index($request);
    }

    public function show($id)
    {
        return $this->branch_interface->show($id);
    }
}
