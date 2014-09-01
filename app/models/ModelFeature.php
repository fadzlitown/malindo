<?php

namespace App\Models;

class ModelFeature extends \Eloquent
{

    protected $table    = "model_features";
    protected $fillable = ['model_id', 'fcim_id'];

    public function meta()
    {
        return $this->belongsTo("App\Models\FeatureCategoryInstanceMeta", "fcim_id");
    }

}
