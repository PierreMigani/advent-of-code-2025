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

    public function getScheme()
    {
        return $this->scheme;
    }

    public function getAuthority()
    {
        return $this->authority;
    }

    public function getUserInfo()
    {
        return $this->userInfo;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getFragment()
    {
        return $this->fragment;
    }

    public function withScheme($scheme)
    {
        $this->scheme = $scheme;

        return $this;
    }

    public function withUserInfo($user, $password = null)
    {
        $this->userInfo = $user;

        if ($password) {
            $this->userInfo .= ':' . $password;
        }

        return $this;
    }

    public function withHost($host)
    {
        $this->host = $host;

        return $this;
    }

    public function withPort($port)
    {
        $this->port = $port;

        return $this;
    }

    public function withPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function withQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    public function withFragment($fragment)
    {
        $this->fragment = $fragment;

        return $this;
    }

    public function __toString()
    {
        return $this->scheme . '://' . $this->host . $this->path;
    }
}
