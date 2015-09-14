<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
use App\Subcategory;

/**
 * Class PractitionersClientManagerController
 * @package App\Http\Controllers
 */
class ClientManagerController extends Controller
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
     * Display the list of clients.
     *
     * @return Response
     */
    public function index()
    {
        $clients = User::latest('created_at')->MyClient()->get();
        return view('practitioner.clientmanager', compact('clients'));
    }

    /**
     *Store client information.
     *
     * @return Response
     */
    public function store(Requests\CreateClientRequest $request)
    {   
        User::create($request->all());
        
        Session::flash('flash_message', 'Client was successful registered!');
        return redirect("practitioner/clientmanager/");
        
    }

}
