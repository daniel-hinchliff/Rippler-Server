<?php

use Rippler\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/user', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(User::all());
});

$app->get('/me', function (ServerRequestInterface $request, ResponseInterface $response) {

    if (isset($_SESSION['user_id']))
    {
        return $response->withJson(User::find($_SESSION['user_id']));
    }
});
