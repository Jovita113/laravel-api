<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// user
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::get('/user', [AuthController::class, 'user']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::controller(ProductController::class)->group(function () {
    Route::get('/products','index');
    Route::post('/product','store');
    Route::get('/product/{id}','show');
    Route::put('/product/{id}','update');
    Route::delete('/product/{id}','destroy');

});