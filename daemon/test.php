<?php
require __DIR__.'/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

echo $client->get('https://www.stm.dk/api/contentlist/15533')->getBody();

?>