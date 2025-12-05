<?php

namespace RequestHandler;

use Factory\ControllerFactory;
use Psr\Http\Message\ResponseInterface as ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface {
    public function __construct(
        private ControllerFactory $controllerFactory,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface {
        $controller = $this->controllerFactory->create($request->getUri()->getPath());

        $method = strtolower($request->getMethod());
        $params = $request->getQueryParams();
        $body = $request->getParsedBody();

        return $controller->$method($params, $body);
    }
}
