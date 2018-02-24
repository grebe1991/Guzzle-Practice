<?php

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

// Post json data format
$request = $client->post('posts', [
    'json' => [
        'title' => 'TestGuzzleRest',
        'body' => 'Guzzle is pretty awesome',
        'userId' => 5
    ]
]);
echo $request->getBody();

echo PHP_EOL . PHP_EOL;

// Post a body through request, bad way
$request = $client->post('posts', [
    'body' => 'fooBar'
]);
echo $request->getBody();

echo PHP_EOL . PHP_EOL;
