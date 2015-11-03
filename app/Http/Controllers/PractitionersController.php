<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

use Session;
use App\Report;
use App\Practitioner;
use App\User;

/**
 * Class PractitionersController
 * @package App\Http\Controllers
 */
class PractitionersController extends Controller
{   
    /**
     *Check if user is logged in
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
                if (!Session::has('prac_id')) 
                {
                    return redirect('/unauthorizedaccess');
                }
        });
    }
    /**
     * Display the practitioner dashboard page.
     *
     * @return Response
     */
    public function index()
    {   
        $latest_report = Report::latest('updated_at')->Practitioner()->first();

        $practitioner = Practitioner::GetCurrent()->first();

        if($latest_report !== null)
        {
            return view('practitioner.dashboard',compact('latest_report'));
        }
        else
        {
            return view('practitioner.dashboard');
        }

    }    
}