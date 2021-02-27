<?php
namespace SatPay\Bitcoin\Wallet\Exceptions;

use Exception;

class WalletDontExistException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Wallet doesnt exists.';
        return $errorMsg;
    }

}

?>