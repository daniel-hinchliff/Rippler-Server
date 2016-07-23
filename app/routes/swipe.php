<?php

use Rippler\Models\Swipe;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->group('/swipe', function () {

    $this->get('', function (ServerRequestInterface $request, ResponseInterface $response) {
        return $response->withJson(Swipe::all());
    });

    $this->post('', function (ServerRequestInterface $request, ResponseInterface $response) {

        $attributes = $request->getParsedBody();

        $ripple = new Swipe();
        $ripple->ripple_id = $attributes['ripple_id'];
        $ripple->like = $attributes['like'];
        $ripple->user_id = 1;
        $ripple->save();
    });
});

