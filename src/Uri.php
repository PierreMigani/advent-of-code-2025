<?php

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface {
    public function __construct(
        private string $scheme = '',
        private string $authority = '',
        private string $userInfo = '',
        private string $host = '',
        private int $port = 0,
        private string $path = '',
        private string $query = '',
        private string $fragment = '',
    ) {}

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getAuthority(): string
    {
        return $this->authority;
    }

    public function getUserInfo(): string
    {
        return $this->userInfo;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getFragment(): string
    {
        return $this->fragment;
    }

    public function withScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function withUserInfo(string $user, ?string $password = null): self
    {
        $this->userInfo = $user;

        if ($password) {
            $this->userInfo .= ':' . $password;
        }

        return $this;
    }

    public function withHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function withPort(?int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function withPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function withQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function withFragment(string $fragment): self
    {
        $this->fragment = $fragment;

        return $this;
    }

    public function __toString()
    {
        return $this->scheme . '://' . $this->host . $this->path;
    }
}
