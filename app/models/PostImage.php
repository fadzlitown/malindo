<?php

namespace App\Models;

class PostImage extends \Eloquent
{

    protected $table    = 'post_images';
    protected $fillable = ["post_id", "title", "image_path", "sort"];

}
