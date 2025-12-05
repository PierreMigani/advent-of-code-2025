<?php

namespace Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Stream\Stream;

class Response implements ResponseInterface {
    private StreamInterface $body;

    public function __construct(
        private int $statusCode = 200,
        private string $reasonPhrase = '',
        ?StreamInterface $body = null,
        private array $headers = [],
    ) {
        $this->body = $body ?? new Stream('');
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface {
        $this->statusCode = $code;
        $this->reasonPhrase = $reasonPhrase;
        return $this;
    }

    public function getReasonPhrase(): string {
        return $this->reasonPhrase;
    }

    public function getBody(): StreamInterface {
        return $this->body;
    }

    public function withBody(StreamInterface $body): ResponseInterface {
        $this->body = $body;
        return $this;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function hasHeader(string $name): bool {
        return isset($this->headers[$name]);
    }

    public function getHeader(string $name): array {
        return $this->headers[$name] ?? [];
    }

    public function getHeaderLine(string $name): string {
        return isset($this->headers[$name]) ? implode(',', (array)$this->headers[$name]) : '';
    }

    public function withHeader(string $name, mixed $value): ResponseInterface {
        $this->headers[$name] = $value;
        return $this;
    }

    public function withAddedHeader(string $name, mixed $value): ResponseInterface {
        if (!isset($this->headers[$name])) {
            $this->headers[$name] = [];
        }
        if (!is_array($this->headers[$name])) {
            $this->headers[$name] = [$this->headers[$name]];
        }
        $this->headers[$name][] = $value;
        return $this;
    }

    public function withoutHeader(string $name): ResponseInterface {
        unset($this->headers[$name]);
        return $this;
    }

    public function getProtocolVersion(): string {
        return '1.1';
    }

    public function withProtocolVersion(string $version): ResponseInterface {
        return $this;
    }
}
