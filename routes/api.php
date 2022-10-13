<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthCustomerController;
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

Route::apiResource('/orders', \App\Http\Controllers\Api\OrderController::class);
Route::get('orders/{id}', [\App\Http\Controllers\Api\OrderController::class, 'show']);

Route::apiResource('/food-orders', \App\Http\Controllers\Api\FoodOrderController::class);
Route::get('food-orders/{id}', [\App\Http\Controllers\Api\FoodOrderController::class, 'show']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/customer'
], function ($router) {
    Route::post('login', [AuthCustomerController::class, 'login']);
    Route::post('logout', [AuthCustomerController::class, 'logout']);
    Route::post('refresh', [AuthCustomerController::class, 'refresh']);
    Route::post('me', [AuthCustomerController::class, 'me']);
});
