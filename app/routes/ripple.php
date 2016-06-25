<?php

use \Rippler\Models\Ripple;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(Ripple::all());
});

$app->post('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) {

    $attributes = $request->getParsedBody();

    $ripple = new Ripple();
    $ripple->radius = $attributes['radius'];
    $ripple->latitude = $attributes['latitude'];
    $ripple->longitude = $attributes['longitude'];
    $ripple->description = $attributes['description'];
    $ripple->image_path = $attributes['image_path'];
    $ripple->creation_time = date('Y-m-d H:i:s');
    $ripple->end_time = $attributes['end_time'];
    $ripple->user_id = 1;
    $ripple->save();

    return $response->withJson($ripple);
});