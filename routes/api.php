<?php

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

Route::apiResource('/foods', \App\Http\Controllers\Api\FoodController::class);
Route::get('foods/{id}', [\App\Http\Controllers\Api\FoodController::class, 'show']);

Route::apiResource('/customers', \App\Http\Controllers\Api\CustomerController::class);
Route::get('customers/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'show']);

Route::apiResource('/tables', \App\Http\Controllers\Api\TableController::class);
Route::get('tables/{id}', [\App\Http\Controllers\Api\TableController::class, 'show']);
