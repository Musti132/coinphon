<?php

namespace App\Http\Controllers\Api\Wallet\Manage;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\Manage\ActivationRequest;
use Illuminate\Http\Request;
use App\Models\Wallet;

class ActivationController extends Controller
{
    /**
     * Activate wallet
     * 
     * @param Wallet $wallet
     * @param ActivationRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function activate(Wallet $wallet, ActivationRequest $request)
    {
        if ($wallet->status === Wallet::STATUS_ACTIVE) {
            return Response::error('Wallet is already active');
        }

        $wallet->status = 1;
        $wallet->save();

        return Response::successMessage('Wallet activated');
    }

    /**
     * Deactivate wallet
     * 
     * @param Wallet $wallet
     * @param ActivationRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */

    public function deactivate(Wallet $wallet, ActivationRequest $request)
    {
        if ($wallet->status === Wallet::STATUS_DEACTIVATED) {
            return Response::error('Wallet is already deactivated');
        }

        $wallet->status = 0;
        $wallet->save();

        return Response::successMessage('Wallet deactivated');
    }
}
