<?php

namespace App\Models;

class FeatureCategoryInstanceMeta extends \Eloquent
{

    protected $table    = "feature_categories_instances_metas";
    protected $fillable = ['key', 'value', 'fci_id'];

}
