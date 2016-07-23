<?php

use Rippler\Models\Image;
use Rippler\Components\Auth;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->post('/image', function (ServerRequestInterface $request, ResponseInterface $response) {

    $filepath = tempnam(sys_get_temp_dir(), 'image_');

    file_put_contents($filepath, $request->getBody()->getContents());

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $format = $finfo->file($filepath);
    
    if (!in_array($format, ['image/jpeg', 'image/png', 'image/gif']))
    {
        throw new RuntimeException("Invalid file format [$format]");
    }

    if (filesize($filepath) > 1000000)
    {
        throw new RuntimeException('Exceeded filesize limit.');
    }
   
    $upload = \Cloudinary\Uploader::upload($filepath);

    $image = new Image();
    $image->public_id = $upload['public_id'];
    $image->save();

    unlink($filepath);

    return $response->withJson(['image_id' => $image->id]);
    
})->add(Auth::class);

