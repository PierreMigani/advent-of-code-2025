<?php

namespace Controller\DayController;

use Controller\DayController;
use Factory\StreamFactory;
use Service\Day01Service;
use League\Plates\Engine;

class Day01Controller extends DayController {
    public function __construct(Engine $templateEngine, StreamFactory $streamFactory) {
        $service = new Day01Service();

        parent::__construct(
            '/day01',
            $service,
            $streamFactory,
            $templateEngine,
            'Secret Entrance'
        );
    }
}
