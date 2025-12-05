<?php

namespace Factory;

use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Uri;

class UriFactory implements UriFactoryInterface {
    public function createUri(string $uri = ''): UriInterface {
        return new Uri(
            scheme: parse_url($uri, PHP_URL_SCHEME) ?? '',
            host: parse_url($uri, PHP_URL_HOST) ?? '',
            port: parse_url($uri, PHP_URL_PORT) ?? 0,
            path: parse_url($uri, PHP_URL_PATH) ?? '',
            query: parse_url($uri, PHP_URL_QUERY) ?? '',
            fragment: parse_url($uri, PHP_URL_FRAGMENT) ?? '',
        );
    }
}
