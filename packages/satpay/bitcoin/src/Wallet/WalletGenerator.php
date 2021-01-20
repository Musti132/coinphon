<?php

namespace SatPay\Bitcoin\Wallet;

use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Factory\PrivateKeyFactory;
use SatPay\Bitcoin\Address\AddressGenerator;

class WalletGenerator
{
    private $factory;
    private $network;

    private $privateKey;
    public $publicKey;


    public function __construct()
    {
        //Init network
        $this->network = Bitcoin::getNetwork();
        $this->factory = new PrivateKeyFactory();
        $this->random = new Random();

        return $this;
    }

    public function generateWallet()
    {
        $this->privateKey = $this->factory->generateCompressed($this->random);
        $this->publicKey = $this->privateKey->getPublicKey();
        return $this;
    }

    public function privateKeyToWif()
    {
        return $this->privateKey->toWif($this->network);
    }

    public function privateKeyToHex()
    {
        return $this->privateKey->getHex();
    }

    public function privateKeyToDec(int $length = 0)
    {
        if($length == 0){
            return $this->privateKey->getSecret();
        }

        return gmp_strval($this->privateKey->getSecret(), $length);
    }

    public function publicKeyToHex()
    {
        return $this->publicKey->getHex();
    }

    public function publicKeyToHash()
    {
        return $this->publicKey->getPubKeyHash()->getHex();
    }
    


}
