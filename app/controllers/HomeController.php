<?php

namespace App\Controllers;

use App\Models\Account,
    Auth,
    BaseController,
    Config,
    Hash,
    Illuminate\Support\Facades\App,
    Input,
    Lang,
    Password,
    Redirect,
    Response,
    Validator,
    View;

class HomeController extends BaseController
{

    protected $layout = 'frontend.layouts.basic';

    /**
     * Display home view.
     * 
     * @return Response
     */
    public function getHome()
    {
        $category = new \App\Models\Category();

        $category_brands = $category->find(2)->categoryBrand()->get();
        $brands          = [];

        foreach ($category_brands as $category_brand) {
            $brand = $category_brand->brand()->get()->first()->toArray();
            array_push($brands, $brand);
        }

        $models = \App\Models\Brand::find(1)->brandModels()->lists("model_id", "id");

        $feature_category           = new \App\Models\FeatureCategory();
        $feature_category_instances = $feature_category->find(1)->instances()->lists("name", "id");

        $feature_category_instance       = new \App\Models\FeatureCategoryInstance();
        $feature_category_instance_metas = $feature_category_instance->find(1)->metas()->lists("value", "id");


        echo '<pre>';
        print_r($brands);
        echo "<br/>----<br/>";
        print_r($models);
        echo "<br/>----<br/>";
        print_r($feature_category_instances);
        echo "<br/>----<br/>";
        print_r($feature_category_instance_metas);
        echo "<br/>----<br/>";
        print_r(\DB::getQueryLog());
        echo "<br/>----<br/>";
        echo '</pre>';
        die;


        return View::make('hello');
    }

    /**
     * Display login view.
     * 
     * @return Response
     */
    public function getLogin()
    {
        $user = Auth::user();
        if (!empty($user->id)) {
            return Redirect::to('dashboard');
        }

        return View::make('frontend.common.login');
    }

    /**
     * Handle a POST request to logged in.
     * 
     * @return Response
     */
    public function postLogin()
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

        $validator   = Validator::make($input, $rules);
        $flash_error = '';
        if ($validator->passes()) {
            $account_id = Account::where("email", $input['email'])->get(array('id'))->first();
            if (isset($account_id)) {
                if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']), ($input['remember']))) {
                    return Redirect::to('dashboard');
                }

                $flash_error = 'Your email/password combination was incorrect.';
            }
            else {
                $flash_error = "Email/password doesn't exists.";
            }
            return Redirect::to('login')->with('flash_error', $flash_error)->withInput();
        }
        else {
            return Redirect::to('login')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display register view.
     * 
     * @return Response
     */
    public function getRegister()
    {
        $this->siteInfo['pageTitle'] = "Signup Now";
        return View::make('frontend.common.register');
    }

    /**
     * Handle a POST request to register new account
     * 
     * @return Response
     */
    public function postRegister()
    {
        $input = array(
            'name'                  => Input::get('name'),
            'email'                 => Input::get('email'),
            'password'              => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );

        $rules = array(
            'name'                  => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'email'                 => 'required|email|unique:accounts'
        );

        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {
            $account = new Account;

            $account->first_name   = $input['name'];
            $account->last_name    = $input['name'];
            $account->email        = $input['email'];
            $account->password     = Hash::make($input['password']);
            $account->plan_id      = 1;
            $account->confirmed    = 1;
            $account->confirmation = md5(microtime() . Config::get('app.key'));

            $account->save();
            return Redirect::to('login')->with('flash_message', "You have sucessfully registered. Please login.");
        }
        else {
            return Redirect::to('register')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display forgot password view.
     * 
     * @return Response
     */
    public function getForgotPassword()
    {
        return View::make("frontend.common.forgot");
    }

    /**
     * Hanle a POST request to send forgot password email confirmation.
     * 
     * @return Response
     */
    public function postForgotPassword()
    {
        $input = array(
            'email' => Input::get('email')
        );

        $rules = array(
            'email' => 'required|email'
        );

        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {
            $user_id = Account::where("email", $input['email'])->get(array('id'))->first();
            if (!$user_id)
                return Redirect::to('forgot')->with('flash_error', "Email you have entered doesn't exists.");
            else {
                $response = Password::remind(Input::only('email'), function($message) {
                            $message->subject = "Password Reminder";
                        });
                switch ($response) {
                    case Password::INVALID_USER:
                        return Redirect::back()->with('flash_message', Lang::get($response));

                    case Password::REMINDER_SENT:
                        return Redirect::back()->with('flash_message', Lang::get($response));
                }
            }
        }
        else {
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token))
            App::abort(404);

        return View::make('frontend.common.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only('email', 'password', 'password_confirmation', 'token');

        $rules = array(
            'email'                 => 'required|email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'token'                 => 'required'
        );

        $validator = Validator::make($credentials, $rules);

        if ($validator->passes()) {
            $response = Password::reset($credentials, function($user, $password) {
                        $user->password = Hash::make($password);
                        $user->save();
                    });

            switch ($response) {
                case Password::INVALID_PASSWORD:
                case Password::INVALID_TOKEN:
                case Password::INVALID_USER:
                    return Redirect::back()->with('flash_error', Lang::get($response));
                case Password::PASSWORD_RESET:
                    return Redirect::to('login')->with('flash_message', "Password has been changed. You can login now.");
            }
        }

        $token = Input::get('token');
        return Redirect::to('reset/' . $token)->withInput()->withErrors($validator);
    }

}
