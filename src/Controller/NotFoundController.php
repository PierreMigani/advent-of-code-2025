<?php

namespace Controller;

use Response\Response;

class NotFoundController extends BaseController {
    public function __construct(string $path) {
        parent::__construct($path);
    }

    public function get(array $params = []): Response
    {
        return $this->notFound();
    }

    public function post(array $params = [], array $body = []): Response
    {
        return $this->notFound();
    }
}
