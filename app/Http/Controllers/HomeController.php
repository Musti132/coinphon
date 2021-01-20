<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SatPay\Bitcoin\Wallet\WalletGenerator;
use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Factory\PrivateKeyFactory;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\WalletPublicKey;
use App\Models\Wallet;


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
    public function index()
    {
        Mail::send('home', [], function($message){
                $message->to('mustixd@hotmail.com', 'Mustafa Al-Nashie')->subject('Welcome!');
        });
        exit;
        $wallet = new WalletGenerator();
        $wallet = $wallet->generateWallet();

        echo "Key Info<br>";
        echo " - Compressed? " . (($wallet->privateKey->isCompressed() ? 'yes' : 'no')) . "<br>";
        
        echo "Private key<br>";
        echo " - WIF: " . $wallet->publicKeyToHash() . "<br>";
        echo " - Hex: " . $wallet->publicKeyToHex() . "<br>";
        echo " - Dec: " . $wallet->privateKeyToDec(10) . "<br>";
        
        
        exit;
        $network = Bitcoin::getNetwork();
        $random = new Random();
        $privKeyFactory = new PrivateKeyFactory();

        $privateKey = $privKeyFactory->generateCompressed($random);
        $publicKey = $privateKey->getPublicKey();
        echo "Key Info<br>";
        echo " - Compressed? " . (($privateKey->isCompressed() ? 'yes' : 'no')) . "<br>";
        
        echo "Private key<br>";
        echo " - WIF: " . $privateKey->toWif($network) . "<br>";
        echo " - Hex: " . $privateKey->getHex() . "<br>";
        echo " - Dec: " . gmp_strval($privateKey->getSecret(), 10) . "<br>";
        
        echo "Public Key<br>";
        echo " - Hex: " . $publicKey->getHex() . "<br>";
        echo " - Hash: " . $publicKey->getPubKeyHash()->getHex() . "<br>";
        
        $address = new PayToPubKeyHashAddress($publicKey->getPubKeyHash());
        echo " - Address: " . $address->getAddress() . "<br>";
        /*
        $wallet = new Wallet([
            'label' => 'Test',
            'key' => $privateKey->toWif($network)
        ]);
        
        User::with('wallet')->findOrFail(1)->wallet()->save($wallet);*/
        exit;
        /*
        $generator = new Generator('xpub6BnAQa7mvbowFhFUdYd8qmtSHnjRaLkvk9YgvLrckus16CSf9S94pHqGHbpLdTd6NhUrodw5AjWebmjasHXDkWv1y2LbMSwLgYcSjSCYXPL');
        return $generator->receivingPath(21)->generateAddress();
        
        return view('home');*/
    }
}