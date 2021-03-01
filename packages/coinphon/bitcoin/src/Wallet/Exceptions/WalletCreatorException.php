<?php
namespace CoinPhon\Bitcoin\Wallet\Exceptions;

use Exception;

class WalletCreatorException extends Exception{

    public function pathNotFound(){
        
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> Unkown error happened, check logs for more info.';

        return $errorMsg;
    }

}

?>