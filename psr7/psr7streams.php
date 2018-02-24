<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

$client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

// The stream can be generated from
// ['string', 'generator or iterator', 'object with _toString', 'resource from fopen()']

$stream = Psr7\stream_for('This is a stream generated from a string !');

echo $stream . PHP_EOL;
echo 'The size of the stream ' . $stream->getSize() . 'bytes' . PHP_EOL;
echo 'Writable: ' . $stream->isWritable() . PHP_EOL;
echo 'Readable: ' . $stream->isReadable() . PHP_EOL;
echo 'Seekable: ' . $stream->isSeekable() . PHP_EOL;

$stream->write(' { THIS IS DATA WRITTEN WITH WRITE() STREAM METHOD }');

echo 'After write: ' . $stream . PHP_EOL;
$stream->rewind();
echo 'First 20 bytes: ' . $stream->read(20) . PHP_EOL;
echo 'is end of stream ? ' . $stream->eof() . PHP_EOL;

echo 'The contens: ' . $stream->getContents() . PHP_EOL;
echo 'is end of stream ? ' . $stream->eof() . PHP_EOL;
echo 'Rewinding ...' . PHP_EOL;
$stream->rewind();
echo 'is end of stream ? ' . $stream->eof() . PHP_EOL;
