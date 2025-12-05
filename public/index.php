<?php

require __DIR__ . '/../vendor/autoload.php';

function myAutoloader($className) {
    $className = str_replace('\\', '/', $className);
    $path = __DIR__ . '/../src/';
    include $path . $className . '.php';
}

spl_autoload_register('myAutoloader');

$templateEngine = new League\Plates\Engine(__DIR__ . '/../templates');
$templateEngine->addFolder('results', __DIR__ . '/../templates/results');

$streamFactory = new Factory\StreamFactory();
$controllerFactory = new Factory\ControllerFactory($templateEngine, $streamFactory);
$uriFactory = new Factory\UriFactory();
$requestFactory = new Factory\RequestFactory($uriFactory);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$serverParams = $_SERVER;
$request = $requestFactory->createServerRequest($method, $uri, $serverParams);
$requestHandler = new RequestHandler\RequestHandler($controllerFactory);

$response = $requestHandler->handle($request);

foreach ($response->getHeaders() as $name => $value) {
    header(sprintf('%s: %s', $name, $value), false);
}

echo $response->getBody();
