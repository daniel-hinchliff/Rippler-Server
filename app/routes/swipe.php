<?php

use Rippler\Models\Swipe;
use Rippler\Components\Auth;
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
        $ripple->user_id = $this->session->userId();
        $ripple->like = $attributes['like'];
        $ripple->save();
    });

})->add(Auth::class);

