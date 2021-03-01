<?php
namespace CoinPhon\Bitcoin\Address;



interface AddressInterface{

    /**
     * @return string Bitcoin address from public key
     */
    public function generateAddress(): string;

    /**
     * @return string User public key
     */
    public function publicKey(): string;

}

?>