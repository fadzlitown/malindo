<?php

namespace App\Models;

class Model extends \Eloquent
{

    protected $table    = 'models';
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany("App\Models\Post");
    }

}
