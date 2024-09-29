<?php

namespace Modules\MasterData\App\Services\Dashboard;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Currency\CurrencyInterface;

class CurrencyService
{
    public function __construct(protected CurrencyInterface $currency_interface)
    {
    }

    public function store(array $data)
    {
        return $this->currency_interface->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->currency_interface->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->currency_interface->destroy($id);
    }

    public function index($request)
    {
        return $this->currency_interface->index($request);
    }

    public function show($id)
    {
        return $this->currency_interface->show($id);
    }
}
