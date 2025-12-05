<?php

namespace Message;

use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Stream\Stream;

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

        public function getUri(): UriInterface
        {
                return $this->uri;
        }

        public function getMethod(): string
        {
                return $this->method;
        }

        public function getServerParams(): array
        {
                return $this->serverParams;
        }

        public function getCookieParams(): array
        {
                return $this->cookieParams;
        }

        public function getQueryParams(): array
        {
                return $this->queryParams;
        }

        public function getUploadedFiles(): array
        {
                return $this->uploadedFiles;
        }

        public function getParsedBody(): mixed
        {
                return $this->body;
        }

        public function getAttributes(): array
        {
                return [];
        }

        public function getAttribute(string $name, mixed $default = null): mixed
        {
                return $default;
        }

        public function withAttribute(string $name, mixed $value): ServerRequestInterface
        {
                return $this;
        }

        public function withoutAttribute(string $name): ServerRequestInterface
        {
                return $this;
        }

        public function getRequestTarget(): string
        {
                return '';
        }

        public function withRequestTarget(string $requestTarget): ServerRequestInterface
        {
                return $this;
        }

        public function getProtocolVersion(): string
        {
                return '';
        }

        public function withProtocolVersion(string $version): ServerRequestInterface
        {
                return $this;
        }

        public function getHeaders(): array
        {
                return [];
        }

        public function hasHeader(string $name): bool
        {
                return false;
        }

        public function getHeader(string $name): array
        {
                return [];
        }

        public function getHeaderLine(string $name): string
        {
                return '';
        }

        public function withHeader(string $name, mixed $value): ServerRequestInterface
        {
                $this->headers[$name] = $value;
                return $this;
        }

        public function withAddedHeader(string $name, mixed $value): ServerRequestInterface
        {
                return $this;
        }

        public function withoutHeader(string $name): ServerRequestInterface
        {
                return $this;
        }

        public function withCookieParams(array $cookies): ServerRequestInterface
        {
                return $this;
        }

        public function withQueryParams(array $query): ServerRequestInterface
        {
                $this->queryParams = $query;
                return $this;
        }

        public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
        {
                return $this;
        }

        public function withParsedBody(mixed $data): ServerRequestInterface
        {
                $this->body = $data;
                return $this;
        }

        public function withAttributes(array $attributes): ServerRequestInterface
        {
                return $this;
        }

        public function getBody(): StreamInterface
        {
                // Return an empty stream since we don't actually use the body stream
                return new Stream('');
        }
        
        public function withBody(StreamInterface $body): ServerRequestInterface
        {
                // We ignore this since we use getParsedBody() for form data
                return $this;
        }

        public function getServerParam(string $name, mixed $default = null): mixed
        {
                return $this->serverParams[$name] ?? $default;
        }

        public function withMethod(string $method): ServerRequestInterface
        {
                $this->method = $method;
                return $this;
        }

        public function withUri(UriInterface $uri, bool $preserveHost = false): ServerRequestInterface
        {
                $this->uri = $uri;
                return $this;
        }
}
