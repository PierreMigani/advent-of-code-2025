<?php

namespace Controller;

use Response\Response;

abstract class BaseController {
    public function __construct(
        private string $name,
    )
    {}

    public function get(array $params = []): Response
    {
        return $this->notFound();
    }

    public function post(array $params = [], array $body = []): Response
    {
        return $this->notFound();
    }

    public function put(array $params = [], array $body = []): Response
    {
        return $this->notFound();
    }

    public function delete(array $params = [], array $body = []): Response
    {
        return $this->notFound();
    }

    public function notFound(): Response
    {
        $response = new Response();
        $response->withStatus(404);

        return $response;
    }
}
