<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter(function(){

            if((!Session::has('prac_id')) || (!Session::has('is_admin')))
            {
                return redirect('/unauthorizedaccess');
            }   
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         return view('admin.dashboard');
    }
}
