<?php

namespace App\Controllers;

use Redirect;

/**
 * Author       : Rifki Yandhi
 * Date Created : Aug 31, 2014 12:34:16 PM
 * File         : app/controllers/PostController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class PostController extends \BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function getDetail($slug = null)
    {
        if (is_null($slug))
            return Redirect::to("/");
        
        
        
        
        
    }

}

/* End of file PostController.php */
/* Location: ./application/controllers/PostController.php */
