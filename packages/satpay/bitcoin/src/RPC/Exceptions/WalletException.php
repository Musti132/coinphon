<?php
namespace SatPay\Bitcoin\RPC\Exceptions;

use Exception;

class WalletException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Wallet does not exist or is not loaded';
        return $errorMsg;
    }

}

?>