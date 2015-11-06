<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
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
     * Check if user is logged in,redirects the user back to home page if so
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
     * Validates the client credentials for logging in
     *
     * @return Response
     */
    public function login(Request $request)
    { 
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->action('ClientsController@index');
        }
        else
        {
            $errors[] = 'Invalid Credentials! Please try again';
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
