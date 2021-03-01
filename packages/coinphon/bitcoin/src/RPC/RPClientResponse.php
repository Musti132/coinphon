<?php
namespace CoinPhon\Bitcoin\RPC;

use GuzzleHttp\Psr7\Response;

class RPClientResponse{

    public const NOT_LOADED = -18;

    public $response;
    public $error;
    public $statusCode;
    public $body;

    public function __construct(\GuzzleHttp\Psr7\Response $response) {
        $this->response = $response;
        $this->httpCode = $response->getStatusCode();
        $this->handleHttpCode();
        $this->handleBody();
    }

    public function handleHttpCode(){
        return ($this->httpCode != 200) ? $this->setError($this->response) : $this->statusCode = $this->httpCode;
    }

    public function setError($response){
        $this->error = json_decode($response->getBody(), true)['error'];
    }
    
    public function handleBody(){
        $this->body = json_decode($this->response->getBody(), true)['result'];
    }

    public function getError(){
        return $this->error;
    }

    public function isError(){
        return ($this->error === null) ? false : true;
    }

}

?>