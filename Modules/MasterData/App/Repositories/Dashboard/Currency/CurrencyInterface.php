<?php

namespace Modules\MasterData\App\Repositories\Dashboard\Currency;

interface CurrencyInterface
{

    public function index($request);

    public function store($request);
    public function show($currency);

    public function update($currency , $request);

    public function destroy($currency);

}
