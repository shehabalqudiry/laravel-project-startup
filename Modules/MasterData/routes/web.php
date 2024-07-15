<?php

use App\Http\Controllers\Apis\Users\UserController;
use Illuminate\Support\Facades\Route;
use Modules\MasterData\App\Http\Controllers\ActivityLogController;
use Modules\MasterData\App\Http\Controllers\AdditionalDataController;
use Modules\MasterData\App\Http\Controllers\AreaController;
use Modules\MasterData\App\Http\Controllers\AuthController;
use Modules\MasterData\App\Http\Controllers\BranchController;
use Modules\MasterData\App\Http\Controllers\CityController;
use Modules\MasterData\App\Http\Controllers\ClientController;
use Modules\MasterData\App\Http\Controllers\CountryController;
use Modules\MasterData\App\Http\Controllers\CurrencyController;
use Modules\MasterData\App\Http\Controllers\CustomFieldController;
use Modules\MasterData\App\Http\Controllers\DepartmentController;
use Modules\MasterData\App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'theme:default'], function () {
    // general config
    Route::resource('activitylog', ActivityLogController::class)->names('activitylog');
    Route::resource('additionaldata', AdditionalDataController::class)->names('additionaldata');
    Route::resource('customfield', CustomFieldController::class)->names('customfield');
    Route::resource('setting', SettingController::class)->names('setting');

    // zone config
    Route::resource('country', CountryController::class)->names('country');
    Route::resource('city', CityController::class)->names('city');
    Route::resource('area', AreaController::class)->names('area');
    Route::resource('currency', CurrencyController::class)->names('currency');


    // client config
    Route::resource('client', ClientController::class)->names('client');

    // admin config
    Route::resource('user', UserController::class)->names('user');
    Route::resource('auth', AuthController::class)->names('auth');

    // company config
    Route::resource('branch', BranchController::class)->names('branch');
    Route::resource('department', DepartmentController::class)->names('department');

});
