<?php
namespace CoinPhon\Bitcoin\RPC;

use App\Helpers\Response as HelpersResponse;
use CoinPhon\Bitcoin\RPC\Exceptions\ForbiddenException;
use GuzzleHttp\Psr7\Response;

class RPClientResponse{

    public const NOT_LOADED_OR_DONT_EXIST = -18;
    public const NO_ACCESS = 6;
    public const BLOCKS_VERIFY = -28;

    public const HTTP_NO_ACCESS = 403;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    public $response;
    public $error;
    public $statusCode;
    public $errorCode;
    public $body;

    public function __construct(\GuzzleHttp\Psr7\Response $response) {
        $this->response = $response;
        $this->httpCode = $response->getStatusCode();
        $this->handleHttpCode();
        $this->handleBody();
    }

    public function handleHttpCode(){
        return ($this->httpCode != 200) ? $this->setError(json_decode($this->response->getBody(), true)) : $this->statusCode = $this->httpCode;
    }

    public function setError($response){
        
        if(array_key_exists('code', $response['error'])){
            $this->errorCode = $response['error']['code'];
        }

        if($this->httpCode === self::HTTP_NO_ACCESS){
            return $this->error = [
                'code' => self::NO_ACCESS,
                'message' => 'No access to RPC client',
            ];
        }

        if($this->httpCode === self::HTTP_INTERNAL_SERVER_ERROR){
            return $this->error = [
                'code' => $response['error']['code'],
                'message' => $response['error']['message'],
            ];
        }

        return $this->error = $response['error'];
    }
    
    public function handleBody(){
        if($this->httpCode === self::HTTP_NO_ACCESS){
            return $this->body = [];
        }

        if($this->httpCode === self::HTTP_INTERNAL_SERVER_ERROR){

            return $this->body = [
                'status' => 'failed',
                'code' => json_decode($this->response->getBody(), true)['error']['code'],
            ];
        }

        return $this->body = json_decode($this->response->getBody(), true)['result'];
    }

    public function getError(){
        return $this->error;
    }

    public function isError(){
        return ($this->error === null) ? false : true;
    }

    public function statusCode(){
        return $this->httpCode;
    }

    public function getErrorCode(){
        return $this->errorCode;
    }

}

?>