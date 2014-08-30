<?php

namespace App\Models;

class FeatureCategoryInstance extends \Eloquent
{

    protected $table    = "feature_categories_instances";
    protected $fillable = ['name', 'feature_category_id'];

    public function metas()
    {
        return $this->hasMany("App\Models\FeatureCategoryInstanceMeta", "fci_id");
    }

}
