<?php

require 'vendor/autoload.php';

$scripts = [
    'basic' => 'requests/basic_requests.php',
    'async' => 'requests/async_requests.php',
    'concurent' => 'requests/concurent_requests.php',
    'query' => 'requests/query_requests.php',
    'datapost' => 'requests/datapost_requests.php',
    'advanced' => 'requests/advanced_requests.php',
    'response' => 'requests/response_requests.php',
    'psr7request' => 'psr7/psr7requests.php',
    'psr7response' => 'psr7/psr7response.php',
    'psr7bodies' => 'psr7/psr7bodies.php',
    'psr7headers' => 'psr7/psr7headers.php',
    'psr7streams' => 'psr7/psr7streams.php',
    'psr7middleware' => 'psr7/psr7middleware.php',
    'mock' => 'testing/mock.php',
    'history' => 'testing/history.php',
    
];
$wrong_argument_msg = PHP_EOL . 'You must choose a valid script to execute. Type "php index.php --help" to get available options.' . PHP_EOL . PHP_EOL;
if ($argc > 1) {
    if (array_key_exists($argv[1], $scripts)) {
        require $scripts[$argv[1]];
    } elseif ($argv[1] === '--help') {
        foreach ($scripts as $option => $script) {
            echo PHP_EOL . 'Option: ' . $option . ' -> ' . 'for runing the ' . $script . ' script;' . PHP_EOL;
        }
        echo PHP_EOL;
    } else {
        echo $wrong_argument_msg;
    }
} else {
    echo $wrong_argument_msg;
}
