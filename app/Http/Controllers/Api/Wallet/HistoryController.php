<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\WalletHistorRequest;
use App\Http\Resources\Wallet\WalletHistoryResource;
use App\Models\Wallet;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Return wallet history
     * 
     * @param Wallet $wallet
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function history(Wallet $wallet) {
        $wallet->load('history.type');

        $wallet->history->label = $wallet->label;
        
        return WalletHistoryResource::customCollection($wallet->history, $wallet->label);
    }
}
