<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\SmsController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\Developer\ApiController;
use App\Http\Controllers\Api\Developer\DeveloperController;
use App\Http\Controllers\Api\Developer\EventController;
use App\Http\Controllers\Api\Developer\LogController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Wallet\WalletController;
use App\Http\Controllers\Api\Developer\WebhookController;
use App\Http\Controllers\Api\NotificationController as ApiNotificationController;
use App\Http\Controllers\Api\Order\OrderDetailController;
use App\Http\Controllers\Api\Profile\DeviceController;
use App\Http\Controllers\Api\Profile\NotificationController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Profile\TwoFactorController;
use App\Http\Controllers\Api\Wallet\HistoryController;
use App\Http\Controllers\Api\Wallet\Manage\ActivationController;
use App\Http\Controllers\Api\Wallet\Manage\CryptoController;
use App\Http\Controllers\Api\Wallet\Manage\ManageController;
use App\Http\Controllers\Api\Wallet\Manage\WithdrawController;
use App\Models\UserLogin;

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
            Route::get('{wallet}/status', [WalletController::class, 'status'])->name('status');
            Route::get('{wallet}/history', [HistoryController::class, 'history'])->name('history');
            Route::get('{wallet}/statistics', [ManageController::class, 'statistics'])->name('statistics');

            Route::post('{wallet}/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw');
            Route::post('status/{wallet}/activate', [ActivationController::class, 'activate'])->name('activate');
            Route::post('status/{wallet}/deactivate', [ActivationController::class, 'deactivate'])->name('deactivate');

            Route::group([
                'prefix' => 'create',
                'as' => 'create.'
            ], function () {
                Route::get('cryptos', [CryptoController::class, 'cryptos'])->name('cryptos');
            });
        });

        /**
         * Profile routes
         */
        Route::group([
            'prefix' => 'profile',
            'as' => 'profile.'
        ], function () {
            Route::post('notification/update', [NotificationController::class, 'update'])->name('update');
            Route::post('logout', [ProfileController::class, 'logout'])->name('logout');
            Route::get('devices', [DeviceController::class, 'devices'])->name('devices');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::post('2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa_enable');
            Route::post('2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa_disable');
        });

        Route::apiResource('profile', ProfileController::class)->except([
            'update', 'destroy'
        ]);

        /**
         * Order routes
         */
        Route::group([
            'prefix' => 'order',
            'as' => 'order.'
        ], function () {
            Route::get('export', [OrderController::class, 'export'])->name('export');
            Route::post('{wallet}/new', [OrderController::class, 'newOrder'])->name('new');
            Route::post('{order}/mark', [OrderController::class, 'mark'])->name('mark');
            Route::get('{order}/details', [OrderDetailController::class, 'details'])->name('details');
        });

        Route::apiResource('order', OrderController::class);

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

        /**
         * Notification routes
         */
        Route::group([
            'prefix' => 'notification',
            'as' => 'notification.',
        ], function () {
            Route::get('', [ApiNotificationController::class, 'index'])->name('index');
            Route::get('read', [ApiNotificationController::class, 'read'])->name('read');
        });

        /**
         * Api routes
         */
        Route::group([
            'prefix' => 'api',
            'as' => 'api.',
        ], function () {
            Route::get('logs/server', [LogController::class, 'server'])->name('logs_server');
            Route::get('logs/user', [LogController::class, 'user'])->name('logs_user');
        });

        Route::apiResource('api', ApiController::class);
    });
});
