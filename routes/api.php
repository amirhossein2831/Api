<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('company', CompanyController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('producer', ProducerController::class);
Route::post('product/addProducer/{product}',[ProductController::class,'addProducer']);
Route::post('product/removeProducer/{product}',[ProductController::class,'removeProducer']);
Route::post('producer/addProduct/{producer}',[ProducerController::class,'addProduct']);
Route::post('producer/removeProduct/{producer}',[ProducerController::class,'removeProduct']);

