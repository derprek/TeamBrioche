<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

/**
 * Class ClientAuthController
 * @package App\Http\Controllers
 */
class ClientAuthController extends Controller
{   
    /**
     *Check if user is logged in
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if (Auth::check()) 
                {
                    return redirect('home');
                }
        });
    }

    /**
     *Client login.
     *
     * @return Response
     */
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
            $errors[] = 'Invalid Credentials! Please try again';
            return redirect()->back()->withErrors($errors);
        }

    }

}
