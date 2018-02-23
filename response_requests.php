<?php

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

$response = $client->get('posts/1');

// PSR7 Stream
$body = $response->getBody();

// Json String
$string = $body->getContents();

// Json Obj
$json = json_decode($body);

$response = $client->get('users/' . $json->userId);
foreach ($response->getHeaders() as $header => $value) {
    $value = implode(', ', $value);
    echo $header . ' : ' . $value . PHP_EOL;
}

echo $response->getBody();
echo PHP_EOL . $response->getStatusCode() . ' ' . $response->getReasonPhrase() . PHP_EOL;

$content_type = $response->getHeader('Content-Type');
if (in_array('application/json; charset=utf-8', $content_type)) {
    $json_obj = json_decode($response->getBody());
    echo 'We successfuly created a json object from the data stream!' . PHP_EOL;
}
