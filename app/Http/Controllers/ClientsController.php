<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;

/**
 * Class ClientsController
 * @package App\Http\Controllers
 */
class ClientsController extends Controller
{   
    /**
     * Redirects the user that isn't logged in.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if (Auth::guest()) 
                {
                    return redirect('/unauthorizedaccess');
                }
        });
    }

    /**
     * Loads the client home page view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $username = Auth::User()->fname;
        return view('Client.index', compact('username'));
    }
}