<?php

namespace Rippler\Components;

class Response extends \Slim\Http\Response
{
    public function withJson($data, $status = null, $encodingOptions = 0)
    {
        $object = (object) ['result' => $data];

        return parent::withJson($object, $status, $encodingOptions);
    }
}
