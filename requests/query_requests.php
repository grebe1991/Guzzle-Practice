<?php

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

// Get posts belonging to the user with id = 1
$request = $client->get('posts?userId=1');
echo $request->getBody();

echo PHP_EOL . PHP_EOL;

// Get posts belonging to the user with id = 1, better way
$request = $client->get('posts', [
    'query' => [
        'userId' => '1'
    ]
]);
echo $request->getBody();
