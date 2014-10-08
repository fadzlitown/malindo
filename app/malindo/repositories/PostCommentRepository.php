<?php

namespace App\Malindo\Repositories;

/**
 * Author       : Rifki Yandhi
 * Date Created : Oct 4, 2014 7:05:33 PM
 * File         : PostCommentRepository.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class PostCommentRepository
{

    public function newInstance($input)
    {
        $postComment = new \App\Models\PostComment();

        $postComment->post_id    = $input['post_id'];
        $postComment->account_id = \Auth::user()->id;
        $postComment->comment    = $input['comment'];
        $postComment->status     = $input['status'];

        return $postComment;
    }

}

/* End of file PostCommentRepository.php */