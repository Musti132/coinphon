<?php
require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use CoinPhon\Bitcoin\Daemon\Daemon;


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
    'method' => "createwallet",
    'params' => [
        'test'
    ],
];

echo $client->post('52.214.96.107:18332/', [
    'body' => json_encode($body),
    'http_errors' => false
])->getBody();
