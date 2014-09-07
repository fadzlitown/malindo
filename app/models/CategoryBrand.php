<?php

namespace App\Models;

class CategoryBrand extends \Eloquent
{

    protected $table    = 'categories_brands';
    protected $fillable = ['category_id', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo("App\Models\Brand");
    }

}
