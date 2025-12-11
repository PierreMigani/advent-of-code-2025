<?php

namespace Message;

use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface {
    public function __construct(
        private ?UriInterface $uri = null,
        private ?StreamInterface $body = null,
        private string $method = '',
        private array $parsedBody = [],
        private array $serverParams = [],
        private array $cookieParams = [],
        private array $queryParams = [],
        private array $uploadedFiles = [],
        private array $headers = [],
        private array $attributes = [],
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

        public function getParsedBody(): ?array
        {
                return $this->parsedBody;
        }

        public function getAttributes(): array
        {
                return $this->attributes;
        }

        public function getAttribute(string $name, mixed $default = null): mixed
        {
                return $this->attributes[$name] ?? $default;
        }

        public function withAttribute(string $name, mixed $value): self
        {
                $requestWithAttribute = clone $this;

                return $requestWithAttribute;
        }

        public function withoutAttribute(string $name): self
        {
                return $this;
        }

        public function getRequestTarget(): string
        {
                return '';
        }

        public function withRequestTarget(string $requestTarget): self
        {
                return $this;
        }

        public function getProtocolVersion(): string
        {
                return '';
        }

        public function withProtocolVersion(string $version): self
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

        public function withHeader(string $name, $value): self
        {
                $this->headers[$name] = $value;

                return $this;
        }

        public function withAddedHeader(string $name, $value): self
        {
                return $this;
        }

        public function withoutHeader(string $name): self
        {
                return $this;
        }

        public function withCookieParams(array $cookies): self
        {
                return $this;
        }

        public function withQueryParams(array $query): self
        {
                $this->queryParams = $query;
                return $this;
        }

        public function withUploadedFiles(array $uploadedFiles): self
        {
                return $this;
        }

        public function withParsedBody($data): self
        {
                $this->parsedBody = $data;

                return $this;
        }

        public function withAttributes(array $attributes)
        {
                return $this;
        }

        public function getBody(): StreamInterface
        {
                return $this->body;
        }
        
        public function withBody(StreamInterface $body): self
        {
                $this->body = $body;
                return $this;
        }

        public function getServerParam($name, $default = null)
        {
                return $this->serverParams[$name] ?? $default;
        }

        public function withMethod(string $method): self
        {
                $this->method = $method;
                return $this;
        }

        public function withUri(UriInterface $uri, bool $preserveHost = false): self
        {
                $this->uri = $uri;

                return $this;
        }
}
