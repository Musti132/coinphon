<?php
namespace SatPay\Bitcoin\RPC;

use GuzzleHttp\Psr7\Response;

class RPClientResponse{

    private $response;

    public $errorCode;
    public $statusCode;
    public $body;

    public function __construct(\GuzzleHttp\Psr7\Response $response) {
        return $response->getBody();
        $this->handleHttpCode($response->getStatusCode());
        $this->handleBody($response);
        $this->setErrorCode($response);
    }

    public function handleHttpCode($httpCode){

    }

    public function setErrorCode($response){
        $this->errorCode = json_decode($response->getBody(), true)['error_code'];
    }
    
    public function handleBody($response){
        $this->body = json_decode($response->getBody());
        /*
        if($this->body[]){

        }*/
    }

    public function getBody(){
        return "Tessst";
    }
    


}

?>