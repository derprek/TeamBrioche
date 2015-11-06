<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class AdminsController extends Controller
{   
    /**
     * Redirects the user without admin rights
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){

            if(!Session::has('is_admin'))
            {
                return redirect('/unauthorizedaccess');
            }   
        });
    }

    /**
     * Redirects the admin to the admin dashboard page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         return view('admin.dashboard');
    }
}
