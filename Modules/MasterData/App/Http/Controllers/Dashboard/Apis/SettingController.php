<?php

namespace Modules\MasterData\App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\App\Http\Requests\Settings\StoreRequest;
use Modules\MasterData\App\Http\Requests\Settings\UpdateRequest;
use Modules\MasterData\App\Models\Setting;
use Modules\MasterData\App\Services\SettingService;
use Modules\MasterData\Setting\App\Repositories\SettingInterface;
class SettingController extends Controller
{
    protected $setting;

    public function __construct(SettingService $setting)
    {
        $this->setting = $setting;
    }

    public function index(Request $request)
    {
        return $this->setting->index($request);
    }

    public function update(Setting $setting, UpdateRequest $request)
    {
        return $this->setting->update($setting, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        return $this->setting->destroy($setting);
    }
}
