<?php

require('../vendor/autoload.php');

$is_production = !empty(getenv('DATABASE_URL'));

if ($is_production)
{
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = '443';
}

$configuration = [
    'settings' => [
        'displayErrorDetails' => !$is_production,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

require 'cloudinary.php';
require 'database.php';
require 'routes.php';

session_start();

$app->run();
