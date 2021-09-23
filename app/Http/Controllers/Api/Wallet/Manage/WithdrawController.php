<?php

namespace App\Http\Controllers\Api\Wallet\Manage;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\Manage\WithdrawRequest;
use App\Http\Resources\Wallet\WalletShowResource;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    //Functionallity not done
    public function withdraw(WithdrawRequest $request, Wallet $wallet) {
        return Response::success(new WalletShowResource($wallet) , 'Withdraw success');
    }
}
