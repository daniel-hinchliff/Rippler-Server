<?php

require('../vendor/autoload.php');

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);
$app->add(function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
    return $next($request, $response);
});

require 'cloudinary.php';
require 'database.php';
require 'routes.php';
require 'models.php';

session_start();

$app->run();
