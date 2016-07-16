<?php

namespace Rippler\Components;

class FacebookClient
{
    protected $fb;
    
    const appId = "423432704517027";
    const appSecret = "b23059f536307fa4ebe8d4a5e6ba7d11";

    public function __construct()
    {
        $this->fb = new \Facebook\Facebook([
          'app_id' => self::appId,
          'app_secret' => self::appSecret,
          'default_graph_version' => 'v2.2',
        ]);
    }

    public function tokenUrl($url)
    {
        $helper = $this->fb->getRedirectLoginHelper();

        return $helper->getLoginUrl($url, ['public_profile,user_birthday']);
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
        $tokenMetadata->validateAppId(self::appId);
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
