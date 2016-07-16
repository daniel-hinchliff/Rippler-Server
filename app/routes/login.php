<?php

use Rippler\Models\User;
use Rippler\Components\FacebookClient;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/login', function (ServerRequestInterface $request, ResponseInterface $response) {

    $fb = new FacebookClient();

    $access_token_string = $request->getQueryParams()['access_token'];
    $access_token = $fb->getAccessTokenFromString($access_token_string);
    $profile = $fb->getUserProfile($access_token);

    $user = User::where('fbid', '=', $profile->getField('id'))->first();

    if (empty($user))
    {
        $user = new User();
        $user->fbid = $profile->getField('id');
        $user->email = $profile->getField('email');
        $user->last_name = $profile->getField('last_name');
        $user->first_name = $profile->getField('first_name');
        $user->birthday = $profile->getField('birthday')->format('Y-m-d');
        $user->save();
    }

    $_SESSION['fb_access_token'] = (string) $access_token;

    return $response->withJson($user);
});

$app->get('/token', function (ServerRequestInterface $request, ResponseInterface $response) {

    $fb = new FacebookClient();

    $login_url = $fb->tokenUrl($request->getUri() . '/print');

    echo '<a href="' . htmlspecialchars($login_url) . '">Get Token</a>';
});

$app->get('/token/print', function (ServerRequestInterface $request, ResponseInterface $response) {

    $fb = new FacebookClient();

    echo $fb->getAccessTokenFromRedirect();
});

