<?php

namespace Message;

use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface {
    public function __construct(
        private ?UriInterface $uri = null,
        private string $method = '',
        private array $serverParams = [],
        private array $cookieParams = [],
        private array $queryParams = [],
        private array $uploadedFiles = [],
        private array $body = [],
    ) {}

        public function getUri()
        {
                return $this->uri;
        }

        public function getMethod()
        {
                return $this->method;
        }

        public function getServerParams()
        {
                return $this->serverParams;
        }

        public function getCookieParams()
        {
                return $this->cookieParams;
        }

        public function getQueryParams()
        {
                return $this->queryParams;
        }

        public function getUploadedFiles()
        {
                return $this->uploadedFiles;
        }

        public function getParsedBody()
        {
                return $this->body;
        }

        public function getAttributes()
        {
                return [];
        }

        public function getAttribute($name, $default = null)
        {
                return $default;
        }

        public function withAttribute($name, $value)
        {
                return $this;
        }

        public function withoutAttribute($name)
        {
                return $this;
        }

        public function getRequestTarget()
        {
                return '';
        }

        public function withRequestTarget($requestTarget)
        {
                return $this;
        }

        public function getProtocolVersion()
        {
                return '';
        }

        public function withProtocolVersion($version)
        {
                return $this;
        }

        public function getHeaders()
        {
                return [];
        }

        public function hasHeader($name)
        {
                return false;
        }

        public function getHeader($name)
        {
                return [];
        }

        public function getHeaderLine($name)
        {
                return '';
        }

        public function withHeader($name, $value)
        {
                $this->headers[$name] = $value;
                return $this;
        }

        public function withAddedHeader($name, $value)
        {
                return $this;
        }

        public function withoutHeader($name)
        {
                return $this;
        }

        public function withCookieParams(array $cookies)
        {
                return $this;
        }

        public function withQueryParams(array $query)
        {
                $this->queryParams = $query;
                return $this;
        }

        public function withUploadedFiles(array $uploadedFiles)
        {
                return $this;
        }

        public function withParsedBody($data)
        {
                $this->body = $data;
                return $this;
        }

        public function withAttributes(array $attributes)
        {
                return $this;
        }

        public function getBody()
        {
                return $this->body;
        }
        
        public function withBody($body)
        {
                $this->body = $body;
                return $this;
        }

        public function getServerParam($name, $default = null)
        {
                return $this->serverParams[$name] ?? $default;
        }

        public function withMethod($method)
        {
                $this->method = $method;
                return $this;
        }

        public function withUri(UriInterface $uri, $preserveHost = false)
        {
                $this->uri = $uri;
                return $this;
        }
}
