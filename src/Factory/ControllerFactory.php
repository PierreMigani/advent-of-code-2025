<?php

namespace Factory;

use Controller\BaseController;
use Controller\HomeController;
use Controller\DayController;
use Controller\NotFoundController;
use League\Plates\Engine;

class ControllerFactory {
    public function __construct(
        private Engine $templateEngine,
        private StreamFactory $streamFactory,
    ) {}

    public function create(string $path): BaseController
    {
        // Route to home controller
        if ($path === '/' || $path === '') {
            return new HomeController(
                $this->streamFactory,
                $this->templateEngine,
            );
        }

        // Route to day controller
        // Example: /day1, /day2, etc.
        if (preg_match('/^\/day(\d+)$/', $path, $matches)) {
            $dayNumber = (int) $matches[1];
            
            // Try to load the day service class
            $dayServiceClass = "Service\\Day{$dayNumber}";
            
            if (!class_exists($dayServiceClass)) {
                return new NotFoundController($path);
            }

            $dayService = new $dayServiceClass();
            
            return new DayController(
                name: $path,
                dayService: $dayService,
                streamFactory: $this->streamFactory,
                templateEngine: $this->templateEngine,
                pageTitle: "Day {$dayNumber}",
            );
        }

        // Return a controller that will show a 404 for unknown routes
        return new NotFoundController($path);
    }
}
