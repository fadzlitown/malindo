<?php

namespace App\Models;

class Brand extends \Eloquent
{

    protected $table    = 'brands';
    protected $fillable = ['name'];

    public function models()
    {
        return $this->hasMany("App\Models\BrandModel");
    }

}
