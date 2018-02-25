<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

$bucket = [];
$history = \GuzzleHttp\Middleware::history($bucket);
$stack = HandlerStack::create();
$stack->push($history);
$client = new Client(['handler' => $stack]);
$client->get('http://jsonplaceholder.typicode.com/posts/3');
$client->get('http://jsonplaceholder.typicode.com/posts/50');
$client->get('http://jsonplaceholder.typicode.com/posts/0', ['http_errors' => false]);

echo count($bucket) . PHP_EOL;
var_dump($bucket);

foreach ($bucket as $item) {
    echo $item['request']->getUri() . PHP_EOL;
    echo $item['response']->getbody() . PHP_EOL;
}
