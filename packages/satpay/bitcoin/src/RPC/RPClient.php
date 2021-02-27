<?php

namespace SatPay\Bitcoin\RPC;

use App\Models\Server;
use SatPay\Bitcoin\RPC\Exceptions\MethodEmptyException;
use SatPay\Bitcoin\RPC\RPClientResponse;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Models\RPCLog;
use App\Models\RPCMessages;
use App\Models\Wallet;

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

    public function __construct(Server $server, array $config = []){
        $this->config = array_merge($this->config, $config);
        $this->server = $server;
        $this->client = new Client($this->config);
    }

    public function execute() {
        /*
        if($this->wallet === null){
            throw new WalletEmptyException("Wallet name is empty");
        }*/

        if($this->method === null){
            throw new MethodEmptyException("Method name is empty");
        }

        $body = [
            'jsonrpc' => '1.0',
            'id' => $this->method."-".Str::random(20),
            'method' => $this->method,
            'params' => $this->params,
        ];
        
        $request = $this->client->post($this->server->host.":".$this->server->port."/wallet/".$this->wallet->label, [
            'body' => json_encode($body),
            'http_errors' => false
        ]);

        $response = new RPClientResponse($request);

        $fullCommand = "{$this->method} ".implode(" ", $this->params);

        $log = RPCLog::create([
            'method' => $this->method,
            'full_command' => $fullCommand,
            'server_id' => $this->server->id,
            'wallet_id' => $this->wallet->id,
        ]);
        
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