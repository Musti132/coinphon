<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SatPay\Bitcoin\RPC\RPClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use SatPay\Bitcoin\Address\PublicKeyAddressGenerator;
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
        Mail::send('home', [], function($message){
            $message->to('mustixd@hotmail.com', 'Mustafa Al-Nashie')->subject('Welcome!');
        });
        return;

        $server = Server::find(1);
        $user = User::find(1);
        dd($user->getWallet()->getBalance());
        
        exit;
        $wallet = new Wallet([
            'label' => 'Test',
            'server_id' => 1,
        ]);
        
        User::findOrFail(1)->wallet()->save($wallet);
        exit;
        $user->createWallet();

        if(!ServerRegion::where('region', 'eu')->first()){
            $region = new ServerRegion();
            $region->region = "eu";
            $region->save();
            exit;
        }

        $region = ServerRegion::find("eu");

        if(!Server::where('host', "52.214.96.107")->first()){
            $server = new Server();
            $server->label = "EU Server 1";
            $server->host = "52.214.96.107";
            $server->port = 8332;
            $server->region_id = $region->id;
            $server->save();
            exit;
        }

        $server = Server::find(1);

        
        $test = new RPClient($server);

        $body = $test->setWallet("supper")
            ->setMethod("getwalletinfo")
            ->execute()
            ->getBody();

        $array = json_decode($body, true);
        echo number_format($array['result']['balance'], 7);
        exit;
        //return $test->request()->getBody();

        /*
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
        echo " - Address: " . $address->getAddress() . "<br>";*/
        /*
        $wallet = new Wallet([
            'label' => 'Test',
            'key' => $privateKey->toWif($network)
        ]);
        
        User::with('wallet')->findOrFail(1)->wallet()->save($wallet);*/
        
        $generator = new Generator('zpub6o4PU5GfyhKAJx5GDedp3jhJs1tL18iD2YspkNhgZygmtHAK4f4QpGw2nAUtGEtinbBt13n64kwVKHT6EPJEmHRSWSVghJfsmFT4g5RdZsz');
        return $generator->receivingPath(21)->generateAddress();
        
        return view('home');
    }
}