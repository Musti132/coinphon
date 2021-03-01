<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WalletController;
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



Route::group([
    'prefix' => 'v1',
], function(){

    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function(){

        /**
         * Register routes
         */
        Route::post('register', [AuthController::class, 'register'])->name('register');

        /**
         * Login route
         */

        Route::post('login', [AuthController::class, 'login'])->name('login');

    });

    Route::middleware('api')->group(function (){

        /**
         * User details route
         */

        Route::get('user', [AuthController::class, 'user'])->name('user');

        /**
         * Refresh details route
         */

        Route::get('refresh', [AuthController::class, 'refresh'])->name('refresh');

        /**
         * Wallet controller
         */
        Route::apiResource('wallet', WalletController::class);

        Route::group([
            'prefix' => 'wallet',
            'as' => 'wallet.'
        ], function(){
            Route::get('{wallet}/balance', [WalletController::class, 'balance'])->name('balance');
            Route::get('{wallet}/address', [WalletController::class, 'address'])->name('address');
        });

        /**
         * Order controller
         */
        Route::apiResource('order', OrderController::class);
    });
});