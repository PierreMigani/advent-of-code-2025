<?php

namespace Factory;

use Psr\Http\Message\StreamFactoryInterface;
use Stream\Stream;
use Psr\Http\Message\StreamInterface;

class StreamFactory implements StreamFactoryInterface {
    public function createStream(string $content = ''): StreamInterface {
        return new Stream($content);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface {
        return new Stream(fopen($filename, $mode));
    }

    public function createStreamFromResource($resource): StreamInterface {
        if (is_resource($resource)) {
            $resource = stream_get_contents($resource);
        }

        return new Stream($resource);
    }
}
