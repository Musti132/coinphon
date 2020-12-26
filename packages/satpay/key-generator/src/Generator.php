<?php

namespace SatPay\KeyGenerator;

use SatPay\KeyGenerator\Exceptions\PathException;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Address\AddressCreator;
use BitWasp\Bitcoin\Key\Deterministic\HdPrefix\GlobalPrefixConfig;
use BitWasp\Bitcoin\Key\Deterministic\HdPrefix\NetworkConfig;
use BitWasp\Bitcoin\Network\Slip132\BitcoinRegistry;
use BitWasp\Bitcoin\Key\Deterministic\Slip132\Slip132;
use BitWasp\Bitcoin\Key\KeyToScript\KeyToScriptHelper;
use BitWasp\Bitcoin\Network\NetworkFactory;
use BitWasp\Bitcoin\Serializer\Key\HierarchicalKey\Base58ExtendedKeySerializer;
use BitWasp\Bitcoin\Serializer\Key\HierarchicalKey\ExtendedKeySerializer;
use SatPay\KeyGenerator\Exceptions\PrefixException;

class Generator
{

    public $key;
    public $path;

    private $slip132;
    private $prefix;
    private $adapter;
    private $pubPrefix;
    private $network;

    public function __construct(string $key)
    {
        //Init network
        $this->network = NetworkFactory::bitcoin();
        $this->adapter = Bitcoin::getEcAdapter();
        $this->slip132 = new Slip132(new KeyToScriptHelper($this->adapter));
        $this->prefix = new BitcoinRegistry();

        //Check public format
        $this->key = $this->checkPrefix($key);

        return $this;
    }

    public function receivingPath(int $path)
    {
        $this->path = "0/".$path;
        return $this;
    }

    public function changePath(int $path)
    {
        $this->path = "1/".$path;
        return $this;
    }

    public function randomPath(int $min, int $max){
        $this->path = "0/".mt_rand($min, $max);
        return $this;
    }

    private function checkPrefix(string $key)
    {
        $ext = substr($key, 0, 1);

        switch ($ext) {
            case "x":
                $this->pubPrefix = $this->slip132->p2pkh($this->prefix);
                break;
            case "y":
                $this->pubPrefix = $this->slip132->p2shP2wpkh($this->prefix);
                break;
            case "z":
                $this->pubPrefix = $this->slip132->p2wpkh($this->prefix);
                break;
            default:
                throw new PrefixException("The extend public is in a incorrect format.");
                break;
        }

        return $key;
    }

    public function generateAddress()
    {
        if (!$this->path) {
            throw new PathException("Path has not been set");
        }

        $config = new GlobalPrefixConfig([
            new NetworkConfig($this->network, [
                $this->pubPrefix,
            ])
        ]);

        $serializer = new Base58ExtendedKeySerializer(
            new ExtendedKeySerializer($this->adapter, $config)
        );

        $key = $serializer->parse($this->network, $this->key);

        $child_key = $key->derivePath($this->path);

        return $child_key->getAddress(new AddressCreator())->getAddress();
    }
}
