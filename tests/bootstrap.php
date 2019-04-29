<?php

require(__DIR__ . '/../vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;

$dbopts = parse_url("postgres://postgres:root@localhost:5432/rippler");

$settings = array(
    "driver" => "pgsql",
    "database" => ltrim($dbopts["path"], '/'),
    "host" => $dbopts["host"],
    "username" => $dbopts["user"],
    "password" => $dbopts["pass"],
    "charset"   => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => "",
);

$capsule = new Capsule;
$capsule->addConnection($settings);
$capsule->setAsGlobal();
$capsule->bootEloquent();

date_default_timezone_set('UTC');
