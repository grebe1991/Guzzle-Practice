<?php
// It just implements Request interface

use GuzzleHttp\Psr7\Request;

$request = new Request('GET', 'https://jsonplaceholder.typicode.com/posts/1');

$uri = $request->getUri();
$scheme = $uri->getScheme();
$host = $uri->getHost();
$path = $uri->getPath();
$port = $uri->getPort() ?? ($scheme === 'http') ? ' 80' : ' 443';

echo '- URI: ' . $uri . PHP_EOL .
    '- Scheme: ' . $scheme . PHP_EOL .
    '- Host: ' . $host . PHP_EOL .
    '- Path: ' . $path . PHP_EOL .
    '- Port:' . $port . PHP_EOL;
