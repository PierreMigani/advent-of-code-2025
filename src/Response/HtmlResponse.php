<?php

namespace Response;

class HtmlResponse extends Response {
    public function __construct() {
        $this
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200)
        ;
    }
}
