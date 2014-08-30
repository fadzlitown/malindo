<?php

namespace App\Models;

class Post extends \Eloquent
{

    protected $table = 'posts';
    protected $fillable = [
        'account_id', 'model_id', 'condition_type_id',
        'headline', 'description', 'other_description',
        'post_expiry_timestamp'
    ];

}
