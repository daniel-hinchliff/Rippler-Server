<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$db_url = getenv('DATABASE_URL');

$dbopts = parse_url($db_url ?: "postgres://postgres:root@localhost:5432/rippler");

$settings = array(
    "driver" => "pgsql",
    "database" => ltrim($dbopts["path"],'/'),
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
