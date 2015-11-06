<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Auth;

/**
 * Class GeneralController
 * @package App\Http\Controllers
 */
class GeneralController extends Controller
{
    /**
     * Loads the home/dashboard pages for the respective user types
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function homepage()
    {
        if(Session::has('prac_id'))
        {
            return redirect('/practitioner/dashboard');
        }
        elseif(Auth::check())
        {
            return redirect('/home');
        }
        elseif(Auth::guest())
        {
            return view('homepage');
        }
    }

    /**
     * Determines the usertype and loads the unauthorized page view
     *
     * @return \Illuminate\View\View
     */
    public function authorizedaccess()
    {   
        if(Session::has('prac_id'))
        {
            if(Session::has('is_admin'))
            {
                $usertype='admin';
            }   
            else
            {
                $usertype='practitioner';
            }
            
        }
        elseif(Auth::check()) 
        {
            $usertype='client';
        }
        elseif(Auth::guest()) 
        {
            $usertype='guest';
        }

        return view('unauthorized', compact('usertype'));
    }
}
