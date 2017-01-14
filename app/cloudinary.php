<?php

\Cloudinary::config(array(
    'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
    'api_secret' => getenv('CLOUDINARY_API_SECRET'),
    'api_key'    => getenv('CLOUDINARY_API_KEY'),
));
