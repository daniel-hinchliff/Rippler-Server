<?php

namespace Rippler\Components;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Auth
{
    protected $session;

    public function __construct($container)
    {
        $this->session = $container->session;
    }

    /**
     * @param  ServerRequestInterface $request  PSR7 request
     * @param  ResponseInterface      $response PSR7 response
     * @param  callable               $next     Next middleware
     * @return ResponseInterface
     */
    
    public function __invoke($request, $response, $next)
    {
        if (empty($this->session->get('user_id')))
        {
            return $response->withStatus(401);
        }
        else
        {
            return $next($request, $response);
        }
    }
}
