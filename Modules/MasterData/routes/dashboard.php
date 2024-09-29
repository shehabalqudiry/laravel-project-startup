<?php

use Illuminate\Support\Facades\Route;
use Modules\MasterData\App\Http\Controllers\Dashboard\CountryController;
use Modules\MasterData\App\Http\Controllers\MasterDataController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {

});

Route::prefix('destinations')->name('activity-log.')->group(function () {
  Route::resource('/countries', CountryController::class);
});
