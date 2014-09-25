<?php

return array(
    /*
      |--------------------------------------------------------------------------
      | Application Debug Mode
      |--------------------------------------------------------------------------
      |
      | When your application is in debug mode, detailed error messages with
      | stack traces will be shown on every error that occurs within your
      | application. If disabled, a simple generic error page is shown.
      |
     */

    'debug' => $_ENV['DEBUG_MODE'],
    /*
     * Phone Marketplace Config
     */

    #Post
    'max_allowed_posts_per_user'        => 100,
    #Post Images
    'max_allowed_images_per_post'       => 5,
    'max_allowed_size_image'            => 6000,
    'max_allowed_size_resolution_width' => 4000,
    'max_allowed_size_resolution_heigh' => 2000
);
