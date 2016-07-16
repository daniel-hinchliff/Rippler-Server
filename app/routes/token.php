<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/token', function (ServerRequestInterface $request, ResponseInterface $response) {

    $app_id = "423432704517027";
    $app_secret = "b23059f536307fa4ebe8d4a5e6ba7d11";

    $fb = new Facebook\Facebook([
      'app_id' => $app_id,
      'app_secret' => $app_secret,
      'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $url = $request->getUri() . '/print';

    $loginUrl = $helper->getLoginUrl($url, ['email']);

    echo '<a href="' . htmlspecialchars($loginUrl) . '">Get Token</a>';
});

$app->get('/token/print', function (ServerRequestInterface $request, ResponseInterface $response) {

    $app_id = "423432704517027";
    $app_secret = "b23059f536307fa4ebe8d4a5e6ba7d11";

    $fb = new Facebook\Facebook([
      'app_id' => $app_id,
      'app_secret' => $app_secret,
      'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    echo $helper->getAccessToken();
});



