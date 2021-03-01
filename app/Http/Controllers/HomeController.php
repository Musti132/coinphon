<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CoinPhon\Bitcoin\RPC\RPClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use CoinPhon\Bitcoin\Address\PublicKeyAddressGenerator;
use App\Models\WalletPublicKey;
use App\Models\Wallet;
use App\Models\ServerRegion;
use App\Models\Server;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $server = Server::find(1);
        $user = User::find(1);
        
        dd($user->getWallet()->getBalance());

    }
}