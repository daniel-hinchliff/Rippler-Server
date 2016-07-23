<?php

use Rippler\Models\User;
use Rippler\Components\Auth;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->group('/user', function () {

    $this->get('', function (ServerRequestInterface $request, ResponseInterface $response) {
        return $response->withJson(User::all());
    });

    $this->get('/me', function (ServerRequestInterface $request, ResponseInterface $response) {
        return $response->withJson(User::find($this->session->userId()));
    });

})->add(Auth::class);
