<?php

namespace App\Models;

class Post extends \Eloquent
{

    protected $table    = 'posts';
    protected $fillable = [
        'account_id', 'model_id', 'condition_type_id',
        'headline', 'description', 'other_description',
        'post_expiry_timestamp',
        'slug', 'code'
    ];
    public $rules       = [
        'account_id'        => 'required|numeric',
        'model_id'          => 'required|numeric|exists:models,id',
        'condition_type_id' => 'required|numeric|exists:condition_types,id',
        'headline'          => 'required|regex:/^[a-zA-Z0-9-_ ]+$/',
        'description'       => 'required',
        'other_description' => '',
        'post_expiry_time'  => 'required'
    ];

    public function images()
    {
        return $this->hasMany("App\Models\PostImage");
    }

    public function comments()
    {
        return $this->hasMany("App\Models\PostComment");
    }

    public function getFillable()
    {
        $keys = array_keys($this->rules);
        return $keys;
    }

}
