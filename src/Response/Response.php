<?php

namespace Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface {
    public function __construct(
        private ?StreamInterface $body = null,
        private int $statusCode = 200,
        private string $reasonPhrase = '',
        private array $headers = [],
    ) {}

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function withStatus(int $code, string $reasonPhrase = ''): self {
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

    public function withBody(StreamInterface $body): self {
        $this->body = $body;
        return $this;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function hasHeader($name): bool {
        return isset($this->headers[$name]);
    }

    public function getHeader($name): array {
        return $this->headers[$name];
    }

    public function getHeaderLine($name): string {
        return implode(',', $this->headers[$name]);
    }

    public function withHeader($name, $value): self {
        $this->headers[$name] = $value;
        return $this;
    }

    public function withAddedHeader($name, $value): self {
        $this->headers[$name][] = $value;
        return $this;
    }

    public function withoutHeader($name): self {
        unset($this->headers[$name]);
        return $this;
    }

    public function getProtocolVersion(): string {
        return '1.1';
    }

    public function withProtocolVersion(string $version): self {
        return $this;
    }
}
