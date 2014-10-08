<?php

namespace App\Malindo\Repositories;

/**
 * Author       : Rifki Yandhi
 * Date Created : Oct 8, 2014 9:44:37 PM
 * File         : HomeRepository.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class HomeRepository
{

    public function trimData($input)
    {
        foreach ($input as $key => $value) {

            if (!isset($value) || $value === '') {
                unset($input[$key]);
            }
        }

        return $input;
    }

    public function buildRedirectUri($category_slug = null, $brand_slug = null, $model_slug = null, $queries = [])
    {
        if (count($queries) > 0) {
            $uri = 'listing/search?' . http_build_query($queries);
        }
        else {
            $uri = (!is_null($category_slug)) ? 'categories/' . $category_slug : '';
            $uri = (!is_null($brand_slug)) ? 'brands/' . $brand_slug : '';
            $uri = (!is_null($model_slug)) ? 'models/' . $model_slug . '/listings' : '';
        }

        return $uri;
    }

}

/* End of file HomeRepository.php */