<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;

$body = json_encode([
    'id' => 100,
    'name' => 'grebe'
]);

$mock = new MockHandler([
    new Response(200, [], $body),
    new Response(200, [
        'X-Foo' => 'Bar'
    ]),
    new ClientException('TestError', new Request('GET', 'test'))
]);
$handler = HandlerStack::create($mock);
$client = new Client(['handler' => $handler]);

echo($response = $client->request('GET', '/'))->getBody() . PHP_EOL;
var_dump($response->getHeaders());
// echo $client->request('GET', '/')->getStatusCode() . PHP_EOL;
var_dump($client->request('GET', '/')->getHeader('X-Foo')) . PHP_EOL;
echo $client->request('GET', '/')->getStatusCode() . PHP_EOL;
