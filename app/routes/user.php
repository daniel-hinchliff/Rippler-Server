<?php

use Rippler\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/user', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(User::all());
});

