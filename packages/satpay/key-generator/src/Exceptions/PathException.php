<?php
namespace SatPay\KeyGenerator\Exceptions;

use Exception;

class PathException extends Exception{

    public function pathNotFound(){
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> path has not been set.';
        return $errorMsg;
    }

}

?>