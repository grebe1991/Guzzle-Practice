<?php

// It just implements Response interface

use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

$response = $client->request('GET', 'posts/1');

var_dump($response);

$status_code = $response->getStatusCode();
$reason_phrase = $response->getReasonPhrase();

// Guzzle implementation of Response Interface, cloning the response obj

$new_response = $response->withStatus(418);

// Custom status code

$custom_response = $response->withStatus(419, 'Just make the coffee!!!');

echo 'Status code: ' . $status_code . ' ' . $reason_phrase . PHP_EOL;
echo 'Status code: ' . $new_response->getStatusCode() . ' ' . $new_response->getReasonPhrase() . PHP_EOL;
echo 'Status code: ' . $custom_response->getStatusCode() . ' ' . $custom_response->getReasonPhrase() . PHP_EOL;
