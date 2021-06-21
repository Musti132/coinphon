<?php

namespace App\Http\Controllers\Api\Wallet\Manage;

use App\Http\Controllers\Controller;
use App\Models\CryptoType;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function cryptos() {
        return CryptoType::all();
    }
}
