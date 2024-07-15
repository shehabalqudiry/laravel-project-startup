<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\Setting\App\Http\Requests\StoreRequest;
use Modules\MasterData\Setting\App\Http\Requests\UpdateRequest;
use Modules\MasterData\Setting\App\Models\Setting;
use Modules\MasterData\Setting\App\Repositories\SettingInterface;
class SettingController extends Controller
{
    protected $setting;

    public function __construct(SettingInterface $setting)
    {
        $this->setting = $setting;
    }

    public function index(Request $request)
    {
        return $this->setting->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->setting->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(Setting $setting)
    {
        return $this->setting->show($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Setting $setting , UpdateRequest $request)
    {
        return $this->setting->update($setting , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        return $this->setting->destroy($setting);
    }
}
