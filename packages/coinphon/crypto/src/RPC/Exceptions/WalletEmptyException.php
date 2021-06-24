<?php
namespace CoinPhon\Crypto\RPC\Exceptions;

use Exception;

class WalletEmptyException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Wallet has not been set.';
        return $errorMsg;
    }

}

?>