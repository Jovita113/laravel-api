<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\JointableController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// user and admin
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware'=>'api'],function(){
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
});


//product routes
Route::controller(ProductController::class)->group(function () {
    Route::get('/products','index');
    Route::post('/product','store');
    Route::get('/product/{id}','show');
    Route::put('/product/{id}','update');
    Route::delete('/product/{id}','destroy');

});

//restorant routes
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/restaurants','index');
    Route::post('/restaurant','store');
    Route::get('/restaurant/{id}','show');
    Route::put('/restaurant/{id}','update');
    Route::delete('/restaurant/{id}','destroy');

});

//restoranai ir meniu
Route::get('join_table', [JointableController::class, 'index']);