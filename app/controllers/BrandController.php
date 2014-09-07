<?php

namespace App\Controllers;

use App\Models\Brand;

/**
 * Author       : Rifki Yandhi
 * Date Created : Sep 7, 2014 4:53:52 PM
 * File         : app/controllers/BrandController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class BrandController extends \BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //list of all brands
        $brands = Brand::all()->toArray();

        echo '<pre>';
        print_r($brands);
        echo "<br/>----<br/>";
        echo '</pre>';
        die;
    }

    public function getModels($slug = null)
    {
        if (is_null($slug))
            return Redirect::to("/");

        $brand = Brand::where("slug", $slug)->get()->first();
        if (!is_null($brand)) {
            $models       = [];
            $brand_models = Brand::find($brand->id)->brandModels()->get();
            foreach ($brand_models as $brand_model) {
                $models = array_add($models, $brand_model->model_id, $brand_model->model()->get()->first()->toArray());
            }
        }

        echo "Models: <br/>";
        echo '<pre>';
        print_r($models);
        echo "<br/>----<br/>";
        echo '</pre>';
        die;
    }

}

/* End of file BrandController.php */
/* Location: ./application/controllers/BrandController.php */
