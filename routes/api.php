<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
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
    'namespace' => 'Api',
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

        /**
         * User details route
         */

        Route::get('user', [AuthController::class, 'user'])->name('user');

        /**
         * Refresh details route
         */
        
        Route::get('refresh', [AuthController::class, 'refresh'])->name('refresh');
    });
});
