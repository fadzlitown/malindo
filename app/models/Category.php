<?php

namespace App\Models;

class Category extends \Eloquent
{

    protected $table    = 'categories';
    protected $fillable = ['name', 'parent_id'];

    public function categoryBrand()
    {
        return $this->hasMany("App\Models\CategoryBrand");
    }

}
