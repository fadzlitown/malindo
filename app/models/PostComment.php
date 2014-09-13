<?php

namespace App\Models;

class PostComment extends \Eloquent
{

    protected $table    = "post_comments";
    protected $fillable = ["post_id", "account_id", "comment", "status"];

}
