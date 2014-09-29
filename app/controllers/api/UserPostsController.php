<?php

namespace App\Controllers\Api;

use AccountRepository,
    App\Controllers\ApiBaseController,
    App\Malindo\Repositories\PostRepository,
    App\Models\Account,
    Response;

/**
 * Author       : Rifki Yandhi
 * Date Created : Sep 29, 2014 10:14:36 PM
 * File         : UserPostsController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class UserPostsController extends ApiBaseController
{

    private $account_repository, $post_repository;

    public function __construct(AccountRepository $account_repository, PostRepository $post_repository)
    {
        parent::__construct();
        $this->account_repository = $account_repository;
        $this->post_repository    = $post_repository;
    }

    public function index($account_id)
    {
        $posts = Account::find($account_id)->posts()->get();
        return Response::json($posts->toArray());
    }

    public function show($account_id, $slug)
    {
        $post = Account::find($account_id)->posts()->where('slug', $slug)->first();

        if (!is_null($post)) {
            return Response::json($post->toArray());
        }

        return Response::json(['error' => false, 'message' => 'listing not found']);
    }

    public function store($account_id)
    {
        return Response::json(['error' => false, 'message' => "Submit new post of account_id {$account_id}"]);
    }

}

/* End of file UserPostsController.php */