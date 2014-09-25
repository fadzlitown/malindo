<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController,
    Auth,
    Input,
    Validator,
    App\Models\Account,
    Response;

class AuthController extends ApiBaseController
{

    /**
     * Login
     *
     * @return Response
     */
    public function index()
    {
        $input = array(
            'email'    => Input::get('email'),
            'username' => Input::get('email'),
            'password' => Input::get('password'),
            'remember' => Input::get('remember')
        );
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|min:8'
        );

        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {
            $account_id = Account::where("email", $input['email'])->get(array('id'))->first();
            if (isset($account_id)) {
                if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']), ($input['remember']))) {
                    $this->response['message']       = "Succesfully logged in.";
                    $this->response['data']['token'] = \Hash::make(uniqid());
                }
                else
                    $this->response = $this->getErrorResponse("errorValidator", 200, "", "Your email/password combination was incorrect.");
            }
            else
                $this->response = $this->getErrorResponse("errorValidator", 200, "", "Email/password doesn't exists.");
        }
        else
            $this->response = $this->getErrorResponse("errorValidator", 200, "", $validator->messages()->first());

        return Response::json($this->response, $this->http_status);
    }

}
