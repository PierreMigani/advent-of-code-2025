<?php

namespace Factory;

use Psr\Http\Message\StreamInterface;
use Stream\Stream;

class StreamFactory {
    public function createStream(string $content = ''): StreamInterface
    {
        return new Stream($content);
    }
}
