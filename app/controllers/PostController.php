<?php

namespace App\Controllers;

use App\Models\Account,
    App\Models\Post,
    Redirect,
    URL;

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

        $post         = Post::where("slug", $slug)->first();
        $owner_detail = [];

        if (!is_null($post)) {

            $post  = Post::find($post->id);
            $owner = Account::find($post->account_id);

            $owner_detail = array_add($owner_detail, "profile", $owner->toArray());
            $owner_detail = array_add($owner_detail, "posts", $owner->posts()->get()->toArray());
            $owner_detail = array_add($owner_detail, "total_posts", count($owner_detail['posts']));

            $complete_post = array_add($post->first()->toArray(), "images", $post->images()->get(array("title", "image_path", "sort"))->toArray());
            $complete_post = array_add($complete_post, "comments", $post->comments()->get(array("account_id", "comment", "status"))->toArray());

            $output = [
                'owner'    => (object) $owner_detail,
                'post'     => (object) $complete_post,
                'post_url' => URL::to("listing/{$slug}/detail")
            ];
        }

        $queries = \DB::getQueryLog();
        echo '<pre>';
        print_r($output);
        echo "<br/>----<br/>";
//        print_r(count($queries));
//        echo "<br/>----<br/>";
//        print_r($queries);
//        echo "<br/>----<br/>";
        echo '</pre>';
        die;
    }

}

/* End of file PostController.php */
/* Location: ./application/controllers/PostController.php */
