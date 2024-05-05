<?php

use App\Http\Controllers\Apis\HomePageApi;
use App\Http\Controllers\Apis\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('home', [HomePageApi::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
