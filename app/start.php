<?php

require('../vendor/autoload.php');

$app = new \Slim\App;


require 'database.php';
require 'routes.php';

$app->run();
