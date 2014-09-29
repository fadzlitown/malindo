<?php

namespace App\Controllers\Api;

use AccountRepository,
    App\Controllers\ApiBaseController,
    App\Models\Account,
    Response;

/**
 * Author       : Rifki Yandhi
 * Date Created : Sep 29, 2014 10:14:36 PM
 * File         : UsersController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class UserController extends ApiBaseController
{

    private $repository;

    public function __construct(AccountRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function show($account_id)
    {
        $account = Account::find($account_id)->first();

        if (!is_null($account)) {
            return Response::json($account->toArray());
        }
    }
}

/* End of file UsersController.php */