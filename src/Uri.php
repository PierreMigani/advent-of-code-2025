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
        return $this->port ?: null;
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

    public function withScheme(string $scheme): UriInterface
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {
        $this->userInfo = $user;

        if ($password) {
            $this->userInfo .= ':' . $password;
        }

        return $this;
    }

    public function withHost(string $host): UriInterface
    {
        $this->host = $host;

        return $this;
    }

    public function withPort(?int $port): UriInterface
    {
        $this->port = $port ?? 0;

        return $this;
    }

    public function withPath(string $path): UriInterface
    {
        $this->path = $path;

        return $this;
    }

    public function withQuery(string $query): UriInterface
    {
        $this->query = $query;

        return $this;
    }

    public function withFragment(string $fragment): UriInterface
    {
        $this->fragment = $fragment;

        return $this;
    }

    public function __toString(): string
    {
        return $this->scheme . '://' . $this->host . $this->path;
    }
}
