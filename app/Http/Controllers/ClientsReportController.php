<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;


/**
 * Class ClientsReportController
 * @package App\Http\Controllers
 */
class ClientsReportController extends Controller
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
     * Loads the client's reports view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Client.reportarchives');
    }
}
