<?php

namespace App\Controllers;

use App\Models\Brand,
    App\Models\Category;

/**
 * Author       : Rifki Yandhi
 * Date Created : Aug 31, 2014 12:34:06 PM
 * File         : app/controllers/CategoryController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class CategoryController extends \BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function getBrands($category_id = null)
    {
        if (is_null($category_id))
            return Redirect::to("/");

        $category = new Category();
        $brand    = new Brand();
        $brands   = [];
        $models   = [];

        $category_brands = $category->find($category_id)->categoryBrand()->get();
        foreach ($category_brands as $category_brand) {
            $brands = array_add($brands, $category_brand->brand->id, array_merge(["parent_category_id" => $category_brand->category_id], $category_brand->brand->toArray()));
        }

        $category_brand_list = $category_brands->lists("brand_id", "id");
        foreach ($category_brand_list as $brand_id) {
            $brand_models = $brand->find($brand_id)->models()->get();
            if ($brand_models) {
                foreach ($brand_models as $brand_model) {
                    $models = array_add($models, $brand_model->model_id, array_merge(["parent_brand_id" => $brand_model->brand_id], $brand_model->model->toArray()));
                }
            }
        }

        $output = [
            'brands' => $brands,
            'models' => $models
        ];

        echo '<pre>';
        print_r($output);
        echo "<br/>----<br/>";
        echo '</pre>';
        die;



//        return \View::make('', $output);
    }

}

/* End of file CategoryController.php */
/* Location: ./application/controllers/CategoryController.php */
