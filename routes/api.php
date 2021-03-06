<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\MerchantStoreController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\StoreController;
use App\Http\Controllers\Api\v1\UserController;
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

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register/{type}', [AuthController::class, 'register']);
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('me', [UserController::class, 'me']);
        Route::apiResources([
            'stores' => MerchantStoreController::class,
        ]);
        Route::post('products', [ProductController::class, 'store']);
        Route::post('cart', [CartController::class, 'store']);
    });
});
