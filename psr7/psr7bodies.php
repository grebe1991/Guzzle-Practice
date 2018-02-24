<?php

// It just implements Response interface

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

$response = $client->request('GET', 'posts/1');

var_dump($response);

$body = $response->getBody();
$read_buffer = $body->read(20);
$buffer_size = $body->getSize();

echo PHP_EOL . 'First 20 bytes of response body: ' . PHP_EOL . $read_buffer . PHP_EOL;
echo PHP_EOL . 'Size of response body: ' . PHP_EOL . $buffer_size . ' bytes ' . PHP_EOL;
