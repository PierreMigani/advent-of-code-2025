<?php

namespace Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface {
    public function __construct(
        private int $statusCode = 200,
        private string $reasonPhrase = '',
        private string $body = '',
        private array $headers = [],
    ) {}

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = '') {
        $this->statusCode = $code;
        $this->reasonPhrase = $reasonPhrase;
        return $this;
    }

    public function getReasonPhrase() {
        return $this->reasonPhrase;
    }

    public function getBody() {
        return $this->body;
    }

    public function withBody(StreamInterface $body) {
        $this->body = $body;
        return $this;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function hasHeader($name) {
        return isset($this->headers[$name]);
    }

    public function getHeader($name) {
        return $this->headers[$name];
    }

    public function getHeaderLine($name) {
        return implode(',', $this->headers[$name]);
    }

    public function withHeader($name, $value) {
        $this->headers[$name] = $value;
        return $this;
    }

    public function withAddedHeader($name, $value) {
        $this->headers[$name][] = $value;
        return $this;
    }

    public function withoutHeader($name) {
        unset($this->headers[$name]);
        return $this;
    }

    public function getProtocolVersion() {
        return '1.1';
    }

    public function withProtocolVersion($version) {
        return $this;
    }
}
