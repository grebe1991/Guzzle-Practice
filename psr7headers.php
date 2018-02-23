<?php

// It just implements Response interface

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

$response = $client->request('GET', 'posts/1');

if ($response->hasHeader('content-type')) {
    echo 'Content-Type: ' . implode(', ', $response->getHeader('content-type')) . PHP_EOL;
    $header = Psr7\parse_header($response->getHeader('content-type'));
    var_dump($header);
    foreach ($header as $value) {
        if (array_key_exists('charset', $value)) {
            echo $value['charset'] . PHP_EOL;
        }
    }
}
