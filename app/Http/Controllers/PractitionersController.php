<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

use Session;
use DB;
use Auth;
use Carbon\Carbon;
use App\Report;
use App\Question;
use App\Manager;
use App\Practitioner;
use App\User;
use App\Product;
use App\Tag;
use App\Category;



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
            $value = Session::get('prac_id');
                if (empty($value)) {
                    return redirect('/../');
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
        return view('practitioner.dashboard');
    }

    public function angular()
    {   
        return view('angulartest');
    }
}