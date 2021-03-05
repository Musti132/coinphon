<?php
namespace CoinPhon\Bitcoin\RPC\Exceptions;

use Exception;

class ForbiddenException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> No access to RPC client';
        return $errorMsg;
    }

}

?>