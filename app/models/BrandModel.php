<?php

namespace App\Models;

class BrandModel extends \Eloquent
{

    protected $table    = 'brands_models';
    protected $fillable = ['brand_id', 'model_id'];

    public function model()
    {
        return $this->belongsTo("App\Models\Model");
    }

}
