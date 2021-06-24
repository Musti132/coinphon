<?php
namespace CoinPhon\Crypto\Wallet\Exceptions;

use Exception;

class WalletDontExistException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Wallet doesnt exists.';
        return $errorMsg;
    }

}

?>