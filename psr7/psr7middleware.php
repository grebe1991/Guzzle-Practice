<?php

namespace Psr7\JsonPlaceholderPost;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Client;

class JsonPlaceholderPost
{
    protected $id;
    protected $userId;
    protected $title;
    protected $body;

    public function __construnct($jsonString)
    {
        $decodedJsonString = json_decode($jsonString);
        $this->id = $decodedJsonString->id;
        $this->userId = $decodedJsonString->userId;
        $this->title = $decodedJsonString->title;
        $this->body = $decodedJsonString->body;
        unset($decodedJsonString);
    }

    public function __toString()
    {
        $string = "id: {$this->id}" . PHP_EOL;
        $string .= "userId: {$this->userId}" . PHP_EOL;
        $string .= "title: {$this->title}" . PHP_EOL;
        $string .= "body: {$this->body}" . PHP_EOL;
        return $string;
    }
}

$stack = new HandlerStack();
$stack->setHandler(\GuzzleHttp\choose_handler());

$stack->push(Middleware::mapRequest(function (RequestInterface $request) {
    return $request->withHeader('X-Custom-Header-Request', 'Hi from modified with middleware header');
}), 'add_custom_header_request');

$stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
    return $response->withHeader('X-Custom-Header-Response', 'This is the modified response header with middleware');
}), 'add_custom_header_response');

$stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
    $postObj = new JsonPlaceholderPost($response->getBody());
    $postStream = \GuzzleHttp\Psr7\stream_for($postObj);
    return $response->withBody($postStream);
}), 'convert_response');

echo "\r\n==== Full Stack ====\r\n";
$client = new Client(['handler' => $stack]);
$response = $client->get('http://jsonplaceholder.typicode.com/posts/2');

echo $response->getBody() . PHP_EOL;
echo "On Response: X-Custom-Header-Response {$response->getHeaderLine('X-Custom-Header-Response')}\r\n";

echo "\r\n==== Remove String Middleware ====\r\n";
$stack->remove('convert_response');

$client = new Client(['handler' => $stack]);
$response = $client->get('http://jsonplaceholder.typicode.com/posts/2');

echo $response->getBody() . PHP_EOL;

echo "On Response: X-Custom-Header-Response {$response->getHeaderLine('X-Custom-Header-Response')}\r\n";
