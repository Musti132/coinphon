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
use GuzzleHttp\Exception\RequestException;

class RPClient{

    /**
     * Request configuration
     * 
     * @var array
     */
    private array $config = [
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
    private Client $client;

    /**
     * Http Client
     * 
     * @var boolean
     */
    private bool $testnet = true;

    /**
     * Http Client
     * 
     * @var boolean
     */
    private int $testnetPort = 18332;


    public $params = [];
    public ?Wallet $wallet = null;
    public string $method;
    public Server $server;
    public int $logId;
    public string $url;

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
        
        $port = $this->server->port;

        if($this->testnet == true){
            $port = 18332;
        }

        if($label !== null){
            $this->url = $this->server->host.":".$port."/wallet/".$label;
        } else{
            $this->url = $this->server->host.":".$port."/";
        }

        if($this->method == "loadwallet"){
            $this->url = $this->server->host.":".$port."/";
        }

        $request = $this->client->post($this->url, [
            'body' => json_encode($body),
            'http_errors' => false,
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