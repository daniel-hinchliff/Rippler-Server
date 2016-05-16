<?php

$production = array();

$db_url = getenv('DATABASE_URL');

if (!empty($db_url))
{
    $dbopts = parse_url();

    $production = array(
        "adapter" => "pgsql",
        "name" => ltrim($dbopts["path"],'/'),
        "host" => $dbopts["host"],
        "user" => $dbopts["user"],
        "pass" => $dbopts["pass"],
        "port" => $dbopts["port"],
    );
}

return array(
    "paths" => array(
        "migrations" => "db/migrations"
    ),
    "environments" => array(
        "default_migration_table" => "phinxlog",
        "default_database" => "development",
        "production" => $production,
        "development" => array(
            "adapter" => "pgsql",
            "name" => 'rippler',
            "host" => '127.0.0.1',
            "user" => 'postgres',
            "pass" => 'root',
            "port" => 5432,
        ),
    )
);
