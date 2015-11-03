<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Auth;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function homepage()
    {
        if((Session::has('prac_id')) && (Session::has('is_admin')))
        {
            return redirect('/admin/dashboard');
        }
        elseif((Session::has('prac_id')) && (!Session::has('is_admin')))
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
