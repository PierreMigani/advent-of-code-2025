<?php

namespace Factory;

use Controller\BaseController;
use Controller\HomeController;
use Factory\StreamFactory;
use League\Plates\Engine;

class ControllerFactory {
    public function __construct(
        private Engine $templateEngine,
        private StreamFactory $streamFactory,
    ) {}

    public function create(string $controllerName): BaseController {
        // automatically load controllers in DayController folder
        if (strpos($controllerName, '/day') === 0) {
            $controllerName = str_replace('/day', '', $controllerName);
            $controllerName = str_replace('/', '', $controllerName);
            $controllerName = 'Day' . $controllerName . 'Controller';
            $controllerName = 'Controller\\DayController\\' . $controllerName;

            return new $controllerName($this->templateEngine, $this->streamFactory);
        }



        switch ($controllerName) {
            case '/':
                return new HomeController($this->streamFactory, $this->templateEngine);
            default:
                throw new \Exception('Controller not found');
        }
    }
}
