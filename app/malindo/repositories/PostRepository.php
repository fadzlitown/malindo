<?php

namespace App\Malindo\Repositories;

use App\Models\Post,
    Str;

/**
 * Author       : Rifki Yandhi
 * Date Created : Sep 27, 2014 11:18:14 AM
 * File         : PostRepository.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class PostRepository
{

    public function prepareInput($input)
    {
        $new_input = array_add($input, 'code', Str::random(6));
        $new_input = array_add($new_input, 'slug', Str::slug($input['headline'] . ' ' . $new_input['code']));
        $new_input = array_add($new_input, 'post_expiry_timestamp', strtotime($new_input['post_expiry_time']));
        $new_input = array_add($new_input, 'status', 'Pending');
        $new_input = array_add($new_input, 'is_featured', false);
        $new_input = array_add($new_input, 'is_sold', false);
        $new_input = array_add($new_input, 'is_in_stock', false);
        unset($new_input['post_expiry_time']);

        return $new_input;
    }

    public function isPostExistsByCodeOfUser($code)
    {
        $post = Post::where("code", $code)->where('account_id', \Auth::user()->id)->first();

        if (is_null($post)) {
            return false;
        }

        return $post;
    }

    public function setPostAsPending($post)
    {
        $post->status = 'Pending';
        return $post;
    }

}

/* End of file PostRepository.php */