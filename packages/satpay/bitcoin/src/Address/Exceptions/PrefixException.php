<?php
namespace SatPay\Bitcoin\Exceptions;

use Exception;

class PrefixException extends Exception{

    public function invalidPrefix(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Invalid extended public key.';
        return $errorMsg;
    }

}

?>