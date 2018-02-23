<?php

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

if ($response = $client->get('posts/1')) {
    echo($response->getBody());
    // echo $response->getStatusCode() . PHP_EOL;
}

if ($response = $client->get('posts/2')) {
    echo($response->getBody());
    // echo $response->getStatusCode() . PHP_EOL;
}

if ($response = $client->get('photos/1')) {
    echo($response->getBody());
    // echo $response->getStatusCode() . PHP_EOL;
}

if ($response = $client->get('https://httpbin.org/ip')) {
    echo($response->getBody());
    // echo $response->getStatusCode() . PHP_EOL;
}

echo "\n\n\n\n";
echo '<pre>';
    var_dump($response->getBody());
echo '</pre>';
