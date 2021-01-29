<?php
namespace SatPay\Bitcoin\RPC\Exceptions;

use Exception;

class MethodEmptyException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Method has not been set.';
        return $errorMsg;
    }

}

?>