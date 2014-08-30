<?php

namespace App\Models;

class FeatureCategory extends \Eloquent
{

    protected $table    = "feature_categories";
    protected $fillable = ['name'];

    public function instances()
    {
        return $this->hasMany("App\Models\FeatureCategoryInstance");
    }

}
