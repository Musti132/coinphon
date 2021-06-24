<?php
namespace CoinPhon\Crypto\Wallet\Exceptions;

use Exception;

class WalletExistException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Wallet already exists.';
        return $errorMsg;
    }

}

?>