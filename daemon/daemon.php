<?php
require __DIR__.'/../vendor/autoload.php';

use GuzzleHttp\Client;

$config = [
    'auth' => [
        'rpcuser',
        'RPC123',
    ],
];

$client = new Client($config);

$body = [
    'jsonrpc' => '1.0',
    'id' => random_int(99999, 999999),
    'method' => "getrawtransaction",
    'params' => [
        'd22d416f49d605e1f70ffb2c17d4b8e7341c2db0300e924042ae29ae0c89f9fb'
    ],
];

echo $client->post('52.214.96.107:8332/wallet/MyCoolWallet-1150a252a295df762c67cb1edd3a92ebd', [
    'body' => json_encode($body),
    'http_errors' => false
])->getBody();



?>