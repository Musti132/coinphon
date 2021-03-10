<?php
namespace CoinPhon\Bitcoin\RPC\Exceptions;

use Exception;

class BlockNotVerifiedException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Server not ready for response';
        return $errorMsg;
    }

}

?>