<?php

namespace Factory;

use Message\Request;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestFactory implements ServerRequestFactoryInterface
{
    public function __construct(
        private ?UriFactory $uriFactory,
    )
    {}

    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        $request = new Request();

        if (is_string($uri)) {
            $uri = $this->uriFactory->createUri($uri);
        }
        
        $request
            ->withMethod($method)
            ->withUri($uri)
            ->withQueryParams($_GET)
            ->withParsedBody($_POST)
            ->withCookieParams($_COOKIE)
            ->withUploadedFiles($_FILES)
        ;

        return $request;
    }
}
