<?php

require('../vendor/autoload.php');

$is_production = (getenv('ENVIRONMENT') == 'production');

if ($is_production)
{
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = '443';
}
else
{
    (new Dotenv\Dotenv(dirname(__DIR__)))->load();
}

$configuration = [
    'settings' => [
        'displayErrorDetails' => !$is_production,
    ],
];

$container = new \Slim\Container($configuration);

$container['session'] = function () {
    return new \Rippler\Components\Session();
};

$container['response'] = function ($container) {
    $headers = new Slim\Http\Headers(['Content-Type' => 'text/html; charset=UTF-8']);
    $response = new Rippler\Components\Response(200, $headers);
    return $response->withProtocolVersion($container->get('settings')['httpVersion']);
};

$app = new \Slim\App($container);

require 'database.php';
require 'routes.php';

session_name('SESSID');
session_start();

$app->run();
