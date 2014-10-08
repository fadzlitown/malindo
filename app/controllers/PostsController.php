<?php

namespace App\Controllers;

use App\Malindo\Repositories\PostCommentRepository,
    App\Models\Account,
    App\Models\Post,
    App\Models\PostComment,
    Auth,
    BaseController,
    DB,
    Input,
    Redirect,
    Response,
    URL,
    Validator;

/**
 * Author       : Rifki Yandhi
 * Date Created : Aug 31, 2014 12:34:16 PM
 * File         : app/controllers/PostController.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class PostsController extends BaseController
{

    private $repository;

    function __construct(PostCommentRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
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

        $queries = DB::getQueryLog();
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

    public function postComment($slug)
    {
        if (!is_null($slug)) {
            $post = Post::where('slug', $slug)->first();

            if ($post) {
                $postComment         = new PostComment();
                $input               = Input::all();
                $input['post_id']    = $post->id;
                $input['account_id'] = Auth::user()->id;
                $input['status']     = "approved";

                $validator = Validator::make($input, $postComment->rules);

                if ($validator->passes()) {
                    $postComment = $this->repository->newInstance($input);
                    $postComment->save();

                    return Response::json([
                                'error' => false,
                                'data'  => [
                                    'account'     => Account::find(\Auth::user()->id)->first(['first_name', 'last_name']),
                                    'postComment' => $postComment->toArray()
                                ]
                    ]);
                }

                $response = [
                    'error'   => true,
                    'message' => $validator->messages()->first()
                ];
            }
            else
                $response = [
                    'error'   => true,
                    'message' => 'Unknown listing'
                ];
        }
        else
            $response = [
                'error'   => true,
                'message' => 'Parameter slug required'
            ];



        return Response::json($response);
    }

}

/* End of file PostController.php */
/* Location: ./application/controllers/PostController.php */
