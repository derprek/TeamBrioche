<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class AdminReportManagerController extends Controller
{   
    /**
     *Redirects the user without admin rights
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
     * Redirects the admin to the admin report manager page
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.reportmanager');
    }
}
