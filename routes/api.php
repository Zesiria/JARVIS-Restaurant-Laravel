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

Route::apiResource('/reviews', \App\Http\Controllers\Api\ReviewController::class);

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

Route::get('/order-from/{id}', [\App\Http\Controllers\Api\OrderController::class, 'order_from']);
Route::get('/orders-today',[\App\Http\Controllers\Api\OrderController::class, 'pending_order']);

Route::post('/image-upload', [\App\Http\Controllers\Api\ImageUploadController::class, 'upload']);
Route::get('/bill/{table_id}', [\App\Http\Controllers\Api\ReportController::class, 'getBill']);
Route::post('/report/foodSale', [\App\Http\Controllers\Api\ReportController::class, 'getFoodSale']);
Route::get('/report/foodSale', [\App\Http\Controllers\Api\ReportController::class, 'getReport']);
Route::get('/report/foodSaleWeek', [\App\Http\Controllers\Api\ReportController::class, 'getSaleFoodOneWeekAgo']);
Route::get('report/foodSaleAll', [\App\Http\Controllers\Api\ReportController::class, 'getFoodSaleAllTime']);
Route::get('report/incomeToday', [\App\Http\Controllers\Api\ReportController::class, 'getIncomeToday']);
Route::get('report/incomeWeek', [\App\Http\Controllers\Api\ReportController::class, 'getIncomeWeek']);

