<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Cookie\CookieJar;

$client = new Client();

echo PHP_EOL . '==== Progress ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'https://httpbin.org/drip?numbytes=1000&duration=2',
    [
        'progress' => function (
            $downloadTotal,
            $downloadedBytes,
            $uploadTotal,
            $uploadedBytes
        ) {
            echo $downloadedBytes . ' / ' . $downloadTotal . 'bytes';
        },
    ]
);

echo PHP_EOL . '==== Redirects - Below Max ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'https://httpbin.org/redirect/1',
    [
        'allow_redirects' => [
            'max' => 2
            ]
    ]
);
echo $response->getBody();
echo 'The status code is => ' . $response->getStatusCode() . PHP_EOL;

echo PHP_EOL . '==== Redirects - Above Max ====' . PHP_EOL;
try {
    $response = $client->request(
        'GET',
        'https://httpbin.org/redirect/3',
        [
            'allow_redirects' => [
                'max' => 2
                ]
        ]
    );
} catch (TooManyRedirectsException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . '==== Redirects - Not Allowed ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'https://httpbin.org/redirect/1',
    [
        'allow_redirects' => false
    ]
);
echo 'The status code is => ' . $response->getStatusCode() . PHP_EOL;

echo PHP_EOL . '==== Delay ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'https://jsonplaceholder.typicode.com/posts/1',
    [
        'delay' => 2000
    ]
);
echo $response->getBody() . PHP_EOL;

echo PHP_EOL . '==== HTTP Errors - True ====' . PHP_EOL;
try {
    $response = $client->request(
        'GET',
        'https://jsonplaceholder.typicode.com/comments/0',
        [
            'http_errors' => true
        ]
    );
} catch (ClientException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . '==== HTTP Errors - False ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'https://jsonplaceholder.typicode.com/comments/0',
    [
        'http_errors' => false
    ]
);
echo 'The status code is => ' . $response->getStatusCode();

echo PHP_EOL . '==== Cookies ====' . PHP_EOL;
$cookieJar = new CookieJar();
$response = $client->request(
    'GET',
    'https://httpbin.org/cookies/set?test=foo',
    [
        'cookies' => $cookieJar
    ]
);
echo var_dump($cookieJar->toArray());

echo PHP_EOL . '==== HTTP Basic Auth ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'http://httpbin.org/basic-auth/user/passwd',
    [
        'auth' => ['user', 'passwd'],
    ]
);
echo $response->getBody();

echo PHP_EOL . '==== Headers ====' . PHP_EOL;
$response = $client->request(
    'GET',
    'https://jsonplaceholder.typicode.com/comments/1',
    [
        'headers' => [
            'User-Agent' => 'Guzzle Practice'
        ]
    ]
);
echo $response->getBody() . PHP_EOL;
