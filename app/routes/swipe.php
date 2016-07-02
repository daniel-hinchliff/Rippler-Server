<?php

use Rippler\Models\Swipe;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/swipe', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(Swipe::all());
});

$app->post('/swipe', function (ServerRequestInterface $request, ResponseInterface $response) {

    $attributes = $request->getParsedBody();

    $ripple = new Swipe();
    $ripple->ripple_id = $attributes['ripple_id'];
    $ripple->like = $attributes['like'];
    $ripple->user_id = 1;
    $ripple->save();
});