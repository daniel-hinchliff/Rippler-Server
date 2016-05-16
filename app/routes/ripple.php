<?php

use \Rippler\Models\Ripple;

$app->get('/ripple', function () {
    header("Content-Type: application/json");
    echo Ripple::all()->toJson();
});

