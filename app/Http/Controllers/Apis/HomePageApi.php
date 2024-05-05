<?php
namespace App\Http\Controllers\Apis;
use App\Http\Controllers\Controller;


class HomePageApi extends Controller
{
    public function index()
    {
        $data = [];
        return responseSuccess($data, msg: 'Home Sections Api');
    }
}
