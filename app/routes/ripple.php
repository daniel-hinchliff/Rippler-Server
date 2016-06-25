<?php

use \Rippler\Models\Ripple;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(Ripple::all());
});
