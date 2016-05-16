<?php

require('../vendor/autoload.php');

$app = new \Slim\App;

require 'routes.php';

$app->run();
