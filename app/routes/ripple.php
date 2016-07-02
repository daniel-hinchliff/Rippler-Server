<?php

use \Rippler\Models\Ripple;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Location\Distance\Vincenty;
use Location\Coordinate;

$app->get('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withJson(Ripple::all());
});

$app->get('/ripple/{id}', function (ServerRequestInterface $request, ResponseInterface $response, $id) {
     return $response->withJson(Ripple::find($id));
});

$app->get('/ripple/{latitude}/{longitude}/{radius}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {

    $ripples = array();
    $distance_calculator = new Vincenty();
    $user_location = new Coordinate($args['latitude'], $args['longitude']);

    foreach (Ripple::all() as $ripple)
    {
        $ripple_location = new Coordinate($ripple->latitude, $ripple->longitude);
        $distance = $distance_calculator->getDistance($user_location, $ripple_location) / 1000;

        if ($distance < $args['radius'] && $distance < $ripple->radius)
        {
            $ripples[]= $ripple;
        }
    }
      
    return $response->withJson($ripples);
});

$app->post('/ripple', function (ServerRequestInterface $request, ResponseInterface $response) {

    $attributes = $request->getParsedBody();

    $ripple = new Ripple();
    $ripple->radius = $attributes['radius'];
    $ripple->latitude = $attributes['latitude'];
    $ripple->longitude = $attributes['longitude'];
    $ripple->description = $attributes['description'];
    $ripple->creation_time = date('Y-m-d H:i:s');
    $ripple->end_time = date('Y-m-d H:i:s');
    $ripple->image_path = "default";
    $ripple->user_id = 1;
    $ripple->save();

    return $response->withJson($ripple);
});

$app->delete('/ripple', function (ServerRequestInterface $request, ResponseInterface $response, $id) {
     Ripple::getQuery()->delete();
});

$app->delete('/ripple/{id}', function (ServerRequestInterface $request, ResponseInterface $response, $id) {
     Ripple::destroy($id);
});
