<?php
namespace CoinPhon\Bitcoin\RPC;

use App\Helpers\Response as HelpersResponse;
use CoinPhon\Bitcoin\RPC\Exceptions\ForbiddenException;
use GuzzleHttp\Psr7\Response;

class RPClientResponse{

    public const NOT_LOADED = -18;
    public const NO_ACCESS = 6;
    public const BLOCKS_VERIFY = -28;

    public const HTTP_NO_ACCESS = 403;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

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
        if($this->httpCode === self::HTTP_NO_ACCESS){
            return $this->error = [
                'code' => self::NO_ACCESS,
                'message' => 'No access to RPC client',
            ];
        }

        if($this->httpCode === self::HTTP_INTERNAL_SERVER_ERROR){
            return $this->error = [
                'code' => self::BLOCKS_VERIFY,
                'message' => 'Blocks are being verified, please wait',
            ];
        }

        return $this->error = json_decode($response->getBody(), true)['error'];
    }
    
    public function handleBody(){

        if($this->httpCode === self::HTTP_NO_ACCESS){
            return $this->body = [];
        }

        if($this->httpCode === self::HTTP_INTERNAL_SERVER_ERROR){
          
            return $this->body = [];
        }
        return $this->body = json_decode($this->response->getBody(), true)['result'];
    }

    public function getError(){
        return $this->error;
    }

    public function isError(){
        return ($this->error === null) ? false : true;
    }

}

?>