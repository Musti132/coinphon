<?php

namespace CoinPhon\Bitcoin\RPC;

use App\Models\Server;
use CoinPhon\Bitcoin\RPC\Exceptions\MethodEmptyException;
use CoinPhon\Bitcoin\RPC\RPClientResponse;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Models\RPCLog;
use App\Models\RPCMessages;
use App\Models\Wallet;
use CoinPhon\Bitcoin\RPC\Exceptions\ForbiddenException;

class RPClient{

    /**
     * Request configuration
     * 
     * @var array
     */
    private $config = [
        'auth' => [
            'rpcuser',
            'RPC123',
        ],
    ];

    /**
     * Http Client
     * 
     * @var Client
     */
    private $client;


    public $params = [];
    public $wallet;
    public $method;
    public $server;
    public $logId;
    public $url;

    public function __construct(Server $server, array $config = []){
        $this->config = array_merge($this->config, $config);
        $this->server = $server;
        $this->client = new Client($this->config);
    }

    public function execute() {

        if($this->method === null){
            throw new MethodEmptyException("Method name is empty");
        }

        $body = [
            'jsonrpc' => '1.0',
            'id' => $this->method."-".Str::random(20),
            'method' => $this->method,
            'params' => $this->params,
        ];

        $label = ($this->wallet === null) ? null : $this->wallet->full_label;

        if($label !== null){
            $this->url = $this->server->host.":".$this->server->port."/wallet/".$label;
        } else{
            $this->url = $this->server->host.":".$this->server->port;
        }

        $request = $this->client->post($this->url, [
            'body' => json_encode($body),
            'http_errors' => false
        ]);
        
        $fullCommand = "{$this->method} ".implode(" ", $this->params);

        $response = new RPClientResponse($request);

        $log = RPCLog::create([
            'method' => $this->method,
            'full_command' => $fullCommand,
            'server_id' => $this->server->id,
            'wallet_id' => ($this->wallet === null) ? null : $this->wallet->id,
        ]);

        $this->logId = $log->id;
        
        if($response->isError()){
            $message = new RPCMessages([
                'log_id' => $log->id,
                'error_code' => $response->getError()['code'],
                'status_code' => $response->httpCode,
                'message' => $response->getError()['message'],
            ]);

            $log->message()->save($message);
        }

        return $response;
    }

    public function setWallet(Wallet $wallet){
        $this->wallet = $wallet;
        
        return $this;
    }

    public function setMethod(string $method){
        $this->method = $method;

        return $this;
    }

    public function setParam(array $params){
        $this->params = $params;

        return $this;
    }

}

?>