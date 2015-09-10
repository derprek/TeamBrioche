<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class ClientAuthController extends Controller
{
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->action('ClientsController@index');
        }
        else
        {
            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
            //return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
            return Redirect()->action('ClientsController@index')->withErrors($errors);
        }

    }

}
