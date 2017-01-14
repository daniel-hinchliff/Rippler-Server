<?php

namespace Rippler\Components;

class FacebookClient
{
    protected $fb;

    public function __construct()
    {
        $this->fb = new \Facebook\Facebook([
          'app_id' => getenv('FACEBOOK_APP_ID'),
          'app_secret' => getenv('FACEBOOK_APP_SECRET'),
          'default_graph_version' => 'v2.2',
        ]);
    }

    public function tokenUrl($url)
    {
        $helper = $this->fb->getRedirectLoginHelper();

        return $helper->getLoginUrl($url, ['public_profile,user_birthday,email']);
    }

    public function getAccessTokenFromRedirect()
    {
        $helper = $this->fb->getRedirectLoginHelper();

        return $helper->getAccessToken();
    }

    public function getAccessTokenFromString($access_token_string)
    {
        $access_token = new \Facebook\Authentication\AccessToken($access_token_string);

        $oauth_client = $this->fb->getOAuth2Client();
        $tokenMetadata = $oauth_client->debugToken($access_token);
        $tokenMetadata->validateAppId(getenv('FACEBOOK_APP_ID'));
        $tokenMetadata->validateExpiration();

        if (!$access_token->isLongLived())
        {
            $access_token = $oauth_client->getLongLivedAccessToken($access_token);
        }

        return $access_token;
    }

    public function getUserProfile($access_token)
    {
        $fields = 'email,first_name,last_name,picture,birthday';

        $response = $this->fb->get("/me?fields=$fields", $access_token);

        return $response->getGraphNode();
    }
}
