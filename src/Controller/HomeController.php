<?php

namespace Controller;

use Factory\StreamFactory;
use League\Plates\Engine;
use Response\HtmlResponse;
use Response\Response;

class HomeController extends BaseController {
    public function __construct(
        private StreamFactory $streamFactory,
        private Engine $templateEngine,
    )
    {
        parent::__construct('/');
    }

    public function get(array $params = []): Response
    {
        $response = new HtmlResponse();
        
        $htmlContent = $this->templateEngine->render('home', [
            'title' => 'Home',
            'nbDays' => 25,
        ]);

        $stream = $this->streamFactory->createStream($htmlContent);

        $response->withBody($stream);

        return $response;
    }
}
