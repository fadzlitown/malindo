<?php

namespace App\Controllers;

use App\Models\Brand,
    App\Models\Category,
    Redirect;

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

    public function index()
    {
        //list all categories
        $categories = Category::all()->toArray();

        echo '<pre>';
        print_r($categories);
        echo "<br/>----<br/>";
        echo '</pre>';
        die;
    }

    public function getBrands($slug = null)
    {
        if (is_null($slug))
            return Redirect::to("/");

        $category = Category::where("slug", $slug)->get()->first();

        if (!is_null($category)) {

            $category_model = new Category();
            $brand_model    = new Brand();
            $brands         = [];
            $models         = [];

            $category_brands = $category_model->find($category->id)->categoryBrand()->get();
            foreach ($category_brands as $category_brand) {
                $brands = array_add($brands, $category_brand->brand->id, array_merge(["parent_category_id" => $category_brand->category_id], $category_brand->brand->toArray()));
            }

            $category_brand_list = $category_brands->lists("brand_id", "id");
            foreach ($category_brand_list as $brand_id) {
                $brand_models = $brand_model->find($brand_id)->brandModels()->get();
                if ($brand_models) {
                    foreach ($brand_models as $obj) {
                        $models = array_add($models, $obj->model_id, array_merge(["parent_brand_id" => $obj->brand_id], $obj->model->toArray()));
                    }
                }
            }

            $output = [
                'brands' => $brands,
                'models' => $models
            ];
        }
        else
            return Redirect::to("/");


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
