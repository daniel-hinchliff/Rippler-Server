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
    $_SESSION['user_id'] = $user->id;

    return $response->withJson($user);
});

$app->get('/weblogin', function (ServerRequestInterface $request, ResponseInterface $response) {

    $fb = new FacebookClient();

    $get_token_url = $fb->tokenUrl($request->getUri() . '/adapter');

    return $response->withHeader('Location', $get_token_url)->withStatus(302);
});

$app->get('/weblogin/adapter', function (ServerRequestInterface $request, ResponseInterface $response) {

    $fb = new FacebookClient();

    $base_url = $request->getUri()->getBaseUrl();
    $access_token = $fb->getAccessTokenFromRedirect();
    $login_url = "$base_url/login?access_token=$access_token";

    return $response->withHeader('Location', $login_url)->withStatus(302);
});

