<?php

namespace App\Models;

class Todo extends \Eloquent
{

    protected $table    = 'todos';
    protected $fillable = ['title', 'note', 'due_date', 'reminder_date', 'status', 'account_id', 'created_at', 'updated_at'];

    public static function getRules()
    {
        $rules = [
            'title' => 'required|alpha_num'
        ];
        return $rules;
    }

}
