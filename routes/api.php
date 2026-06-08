<?php

use App\Http\Controllers\allimge;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\imgeController;
use App\Http\Controllers\prodectcontroller;
use App\Http\Controllers\reviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::apiResource('prodect',prodectcontroller::class);
route::apiResource('img',allimge::class);
route::apiResource('review',reviewController::class);
route::apiResource('/Auth',authcontroller::class,);

