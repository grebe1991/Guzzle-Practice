<?php
require 'vendor/autoload.php';

$scripts = [
    'basic' => 'basic_requests.php',
    'async' => 'async_requests.php',
    'concurent' => 'concurent_requests.php',
    'query' => 'query_requests.php',
    'datapost' => 'datapost_requests.php',
    'advanced' => 'advanced_requests.php',
    'response' => 'response_requests.php',
    'psr7request' => 'psr7requests.php',
    'psr7response' => 'psr7response.php',
    'psr7bodies' => 'psr7bodies.php',
    'psr7headers' => 'psr7headers.php',
    'psr7streams' => 'psr7streams.php',
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
