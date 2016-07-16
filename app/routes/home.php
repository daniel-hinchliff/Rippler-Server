<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    echo "Rippler Server <br>";
    echo "Base Url: ", $request->getUri()->getBaseUrl();
});

