<?php

/**
 * Author       : Rifki Yandhi
 * Date Created : May 12, 2014 4:14:43 PM
 * File         : app/controllers/UserBaseController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class UserBaseController extends \BaseController
{

    protected $user = null;

    function __construct()
    {
        parent::__construct();

        if (is_null($this->user)) {
            if (\Auth::user()) {
                $this->user = \Auth::user();

                \View::share(array("fullname" => ucwords($this->user->first_name . ' ' . $this->user->last_name)));
            }
        }
    }

}

/* End of file UserBaseController.php */
/* Location: ./application/controllers/UserBaseController.php */
