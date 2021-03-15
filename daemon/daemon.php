<?php
require __DIR__.'/../vendor/autoload.php';

use GuzzleHttp\Client;
use CoinPhon\Bitcoin\Daemon\Daemon;


$test = new Daemon();

$test->print();

/*

$order = Order::all()->random(1)->first()->address;

file_put_contents('test.txt', $order."\n", FILE_APPEND);
exit;


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
    'method' => "getbalance",
    'params' => [],
];

echo $client->post('52.214.96.107:8332/wallet/MyCoolWallet-1150a252a295df762c67cb1edd3a92ebd', [
    'body' => json_encode($body),
    'http_errors' => false
])->getBody();
*/


?>