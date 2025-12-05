<?php

namespace Factory;

use Message\Request;
use Psr\Http\Message\ServerRequestInterface;

class RequestFactory {
    public function __construct(
        private UriFactory $uriFactory,
    ) {}

    public function createServerRequest(
        string $method,
        string $uri,
        array $serverParams = []
    ): ServerRequestInterface {
        $uriObject = $this->uriFactory->createUri($uri);
        
        $request = new Request(
            uri: $uriObject,
            method: $method,
            serverParams: $serverParams,
            cookieParams: $_COOKIE ?? [],
            queryParams: [],
            uploadedFiles: [],
            body: [],
        );

        // Parse query string from URI
        parse_str($uriObject->getQuery(), $queryParams);
        $request->withQueryParams($queryParams);

        // Parse POST body if present
        if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH'])) {
            $request->withParsedBody($_POST ?? []);
        }

        return $request;
    }
}
