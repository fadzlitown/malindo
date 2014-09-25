<?php

namespace App\Controllers;

use App\Models\FeatureCategoryInstance,
    App\Models\Model,
    Redirect;

/**
 * Author       : Rifki Yandhi
 * Date Created : Sep 1, 2014 9:02:18 PM
 * File         : app/controllers/FeatureController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class FeaturesController extends \BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function getSpecs($model_id = null)
    {

        if (is_null($model_id))
            return Redirect::to('/');

        $model_features = Model::find($model_id)->features()->get();
        foreach ($model_features as $feature) {
            $feature_category_instance = FeatureCategoryInstance::find($feature->meta->fci_id);
            $feature_category          = $feature_category_instance->feature;

            echo "Feature Category: {$feature_category->name}<br/>------------------<br/>";
            echo "Category Instance: {$feature_category_instance->name}<br/>------------------<br/>";
            echo "Features List: <br/>";
            echo $feature->meta->value . "<br/>";
            echo "<br/><br/><br/>";
        }

        die;
    }

}

/* End of file FeatureController.php */
/* Location: ./application/controllers/FeatureController.php */
