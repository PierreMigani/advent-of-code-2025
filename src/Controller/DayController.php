<?php

namespace Controller;

use Controller\BaseController;
use Factory\StreamFactory;
use Response\Response;
use Response\HtmlResponse;
use Service\DayInterface;
use League\Plates\Engine;

class DayController extends BaseController {
    public function __construct(
        private string $name,
        private DayInterface $dayService,
        private StreamFactory $streamFactory,
        private Engine $templateEngine,
        private string $pageTitle,
        private string $resultsTemplate = 'results::day',
    ) {
        parent::__construct($name);
    }

    // Route to render this day form HTML to submit response
    public function get(array $params = []): Response
    {
        $part = $params['part'] ?? 1;
        $response = new HtmlResponse();
        
        $htmlContent = $this->templateEngine->render('day', [
            'title' => $this->pageTitle,
            'name' => $this->name,
            'part' => $part,
        ]);

        $stream = $this->streamFactory->createStream($htmlContent);

        $response->withBody($stream);

        return $response;
    }

    // Route to handle this day form submission
    public function post(array $params = [], array $body = []): Response
    {
        $input = $body['input'] ?? '';
        $inputLines = explode("\r\n", $input);


        $this->dayService->parse($inputLines);

        $partOneResult = $this->dayService->computePartOne();
        $partTwoResult = $this->dayService->computePartTwo();

        $response = new HtmlResponse();

        $htmlContent = $this->templateEngine->render('day', [
            'title' => $this->pageTitle,
            'name' => $this->name,
            'partOneResult' => $partOneResult,
            'partTwoResult' => $partTwoResult,
            'resultsTemplate' => $this->resultsTemplate,
        ]);

        $stream = $this->streamFactory->createStream($htmlContent);

        $response->withBody($stream);

        return $response;
    }
}
