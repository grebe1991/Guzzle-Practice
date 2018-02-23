<?php

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

$promises[] = $client->requestAsync('GET', 'posts/1');
$promises[] = $client->requestAsync('GET', 'comments/2');

$results = GuzzleHttp\Promise\settle($promises)->wait();
foreach ($results as $result) {
    echo $result['value']->getBody() . PHP_EOL;
}
