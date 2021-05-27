<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\SmsController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\Developer\DeveloperController;
use App\Http\Controllers\Api\Developer\EventController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\Developer\WebhookController;
use App\Http\Controllers\Api\Profile\NotificationController;
use App\Http\Controllers\Api\Profile\ProfileController;

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
], function () {

    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function () {

        /**
         * Register route
         */
        Route::post('register', [AuthController::class, 'register'])->name('register');

        /**
         * Login route
         */

        Route::post('login', [AuthController::class, 'login'])->name('login');

        /**
         * 2Factor routes
         */
        Route::group([
            'prefix' => 'sms',
            'as' => 'sms.'
        ], function () {
            /**
             * Sms verify
             */
            Route::post('verify', [SmsController::class, 'verify'])->name('verify');

            /**
             * Send sms 
             */
            Route::post('send', [SmsController::class, 'store'])->name('send');
        });


        Route::middleware(['auth.jwt'])->group(function () {
            /**
             * User details route
             */

            Route::get('user', [AuthController::class, 'user'])->name('user');
            /**
             * Refresh details route
             */

            Route::get('refresh', [AuthController::class, 'refresh'])->name('refresh');
            

            /**
             * Logout route
             */

            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        });
    });

    Route::middleware(['auth.jwt'])->group(function () {

        /**
         * Wallet routes
         */
        Route::apiResource('wallet', WalletController::class);

        Route::group([
            'prefix' => 'wallet',
            'as' => 'wallet.'
        ], function () {
            Route::get('{wallet}/balance', [WalletController::class, 'balance'])->name('balance');
            Route::get('{wallet}/address', [WalletController::class, 'address'])->name('address');
        });

        /**
         * Profile routes
         */
        Route::group([
            'prefix' => 'profile',
            'as' => 'profile.'
        ], function () {
            Route::post('notification/update', [NotificationController::class, 'update'])->name('update');
            Route::post('logout/{device}', [ProfileController::class, 'logout'])->name('logout');
        });

        Route::apiResource('profile', ProfileController::class);

        /**
         * Order routes
         */
        Route::apiResource('order', OrderController::class);
        Route::group([
            'prefix' => 'order',
            'as' => 'order.'
        ], function () {
            Route::post('{wallet}/new', [OrderController::class, 'newOrder'])->name('new');
            Route::post('{order}/mark', [OrderController::class, 'mark'])->name('markOrder');
        });

        /**
         * Dashboard routes
         */
        Route::group([
            'prefix' => 'dashboard',
            'as' => 'dashboard.'
        ], function () {
            Route::get('', [DashboardController::class, 'index'])->name('home');
        });

        /**
         * Developer routes
         */
        Route::group([
            'prefix' => 'developer',
            'as' => 'developer.'
        ], function () {
            Route::get('', [DeveloperController::class, 'index'])->name('home');
        });

        /**
         * Webhook routes
         */
        Route::apiResource('webhook', WebhookController::class);

        Route::group([
            'prefix' => 'webhook',
            'as' => 'webhook.',
        ], function () {
            Route::post('{webhook}/event/attach', [EventController::class, 'attach'])->name('events_attach');
        });
    });
});
