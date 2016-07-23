<?php

use Rippler\Models\Ripple;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Location\Distance\Vincenty;
use Location\Coordinate;

$app->get('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(Ripple::all());
});

$app->get('/ripple/match', function (ServerRequestInterface $request, ResponseInterface $response) {

    $matched_ripples = Ripple::whereHas('swipes', function ($query) {
        $query->where('user_id', '=', $this->session->userId());
        $query->where('like', '=', 1);
    })->get();

    return $response->withJson($matched_ripples);
});

$app->get('/ripple/{id}', function (ServerRequestInterface $request, ResponseInterface $response, $id) {
     return $response->withJson(Ripple::find($id));
})->add(Auth::class);

$app->get('/ripple/{latitude}/{longitude}/{radius}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {

    $ripples = array();
    $distance_calculator = new Vincenty();
    $user_location = new Coordinate($args['latitude'], $args['longitude']);

    $unswiped_ripples = Ripple::whereDoesntHave('swipes', function ($query) {
        $query->where('user_id', '=', $this->session->userId());
    })->get();

    foreach ($unswiped_ripples as $ripple)
    {
        $ripple_location = new Coordinate($ripple->latitude, $ripple->longitude);
        $distance = $distance_calculator->getDistance($user_location, $ripple_location) / 1000;

        if ($distance < $args['radius'] && $distance < $ripple->radius)
        {
            $ripples[]= $ripple;

            if (count($ripples) == 10) break;
        }
    }
      
    return $response->withJson($ripples);
});

$app->post('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) use ($app) {

    $image_id = null;

    $attributes = $request->getParsedBody();

    if (!empty($attributes['image_id']))
    {
        $image_id = $attributes['image_id'];
    }

    $ripple = new Ripple();
    $ripple->radius = $attributes['radius'];
    $ripple->latitude = $attributes['latitude'];
    $ripple->longitude = $attributes['longitude'];
    $ripple->description = $attributes['description'];
    $ripple->creation_time = date('Y-m-d H:i:s');
    $ripple->user_id = $this->session->userId();
    $ripple->end_time = date('Y-m-d H:i:s');
    $ripple->image_id = $image_id;
    $ripple->save();

    return $response->withJson($ripple);
});

$app->delete('/ripple', function (ServerRequestInterface $request, ResponseInterface $response, $id) {
     Ripple::getQuery()->delete();
})->add(Auth::class);

$app->delete('/ripple/{id}', function (ServerRequestInterface $request, ResponseInterface $response, $id) {
     Ripple::destroy($id);
})->add(Auth::class);
