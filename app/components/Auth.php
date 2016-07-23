<?php

namespace Rippler\Components;

class Auth
{
    protected $session;

    public function __construct($container)
    {
        $this->session = $container->session;
    }

    /**
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     * @return \Psr\Http\Message\ResponseInterface
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
