<?php

namespace Modules\MasterData\App\Repositories\Currency;

interface CurrencyInterface
{

    public function index($request,$filter);

    public function store($request);
    public function show($currency);

    public function update($currency , $request);

    public function destroy($currency);

}
