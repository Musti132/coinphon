<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wallet\WalletCreate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Server;
use SatPay\Bitcoin\Wallet\Exceptions\WalletCreatorException;

class WalletController extends Controller
{
    //

    public function index(){
        return User::findOrFail(1);
    }

    public function store(WalletCreate $request){

        $user = User::find(1);
        $server = Server::find(1);
        $label = $request->label;
        
        try{
            $user->createWallet($server, $label);

            return response()->json([
                'status' => 'success',
                'message' => 'Wallet created successfully',
            ]);

        } catch(WalletCreatorException $ex){
            return response()->json([
                'status' => 'false',
                'message' => 'Unknown error happened, please contact support',
            ], 500);
        }
        
        
        if(!User::find(1)->walletExists()){
            echo "Yes";
            exit;
        }
    }
}
