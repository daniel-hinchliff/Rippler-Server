<?php

namespace Rippler\Components;

class Auth
{
    /**
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     * @return \Psr\Http\Message\ResponseInterface
     */
    
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['user_id']))
        {
            return $next($request, $response);
        }
        else
        {
            return $response->withStatus(401);
        }
    }
}
