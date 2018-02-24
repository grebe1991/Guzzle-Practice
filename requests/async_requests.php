<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

$promise = $client->requestAsync('GET', 'posts/1');
$promise->then(
    function (Response $data) {
        echo $data->getBody();
    },
    function (RequestException $error) {
        echo $error->getMessage();
    }
);

$promise->wait();
echo "\n\n\n\n";
