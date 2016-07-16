<?php

require('../vendor/autoload.php');

$configuration = [
    'settings' => [
        'displayErrorDetails' => empty(getenv('DATABASE_URL')),
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

require 'cloudinary.php';
require 'database.php';
require 'routes.php';

session_start();

$app->run();
