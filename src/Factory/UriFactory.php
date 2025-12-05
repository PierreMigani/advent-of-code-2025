<?php

namespace Factory;

use Psr\Http\Message\UriInterface;
use Uri;

class UriFactory {
    public function createUri(string $uri = ''): UriInterface
    {
        $parts = parse_url($uri);
        
        return new Uri(
            scheme: $parts['scheme'] ?? '',
            authority: '',
            userInfo: $parts['user'] ?? '',
            host: $parts['host'] ?? '',
            port: $parts['port'] ?? 0,
            path: $parts['path'] ?? '',
            query: $parts['query'] ?? '',
            fragment: $parts['fragment'] ?? '',
        );
    }
}
