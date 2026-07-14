<?php

use App\Http\Controllers\allimge;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\imgeController;
use App\Http\Controllers\prodectcontroller;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\signUpController;
use App\Http\Controllers\user;
use App\Http\Controllers\userController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) { 
    return $request->user();
})->middleware('auth:sanctum');

route::prefix('dashbored')->group(function(){
    Route::get('/review',[reviewController::class, 'GetCurrentReview']);
    Route::get('/GetlatestReview',[reviewController::class, 'GetlatestReview']);
    Route::get('/LatestCustomers',[userController::class, 'LatestCustomers']);
    Route::get('/CurrentCustomers',[userController::class, 'CurrentCustomers']);
    Route::get('/latestprodect',[prodectcontroller::class, 'getlatestprodect']);
    Route::get('/Currentprodect',[prodectcontroller::class, 'CurrentProdect']);
    Route::get('/GetAllProdect',[prodectcontroller::class, 'GetAllProdect']);
    Route::post('/addProdect',[prodectcontroller::class, 'store']);
    });
// Route::get('Customers',[userController::class,]);
route::apiResource('prodect',prodectcontroller::class);
route::apiResource('img',allimge::class);
route::apiResource('review',reviewController::class);
route::apiResource('Auth',authcontroller::class)->only('store');
route::apiResource('check-token',authcontroller::class);
route::apiResource('SignUp',signUpController::class);
route::apiResource('customer',userController::class);
Route::put('/customer/{id}', [userController::class, 'update']);
// route::get('cus',userController::class)->only('customers');
// route::apiResource('register',authcontroller::class)->only('register');
 