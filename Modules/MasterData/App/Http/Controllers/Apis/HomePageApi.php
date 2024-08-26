<?php
namespace Modules\MasterData\App\Http\Controllers\Apis;
use App\Http\Controllers\Controller;
use Modules\MasterData\App\Models\Slider;
use Modules\MasterData\App\resource\Slider\SliderResource;

class HomePageApi extends Controller
{
    public function index()
    {
        $sliders = SliderResource::collection(Slider::get());
        $data = [
            'title'         => 'Home Page',
            'sliders'       => $sliders,
            'brands'        => $sliders,
            'services'      => $sliders,
            'vehicles'      => $sliders,
        ];
        return responseSuccess($data, msg: 'Home Sections Api');
    }
}
