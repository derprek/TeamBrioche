<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

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
use Input;
use Validator;
use Mail;

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
        $prac_id = Session::get('prac_id');
        return view('practitioner.clientManager.clientmanager', compact('prac_id'));
    }

    public function show($client_id)
    {   
        Session::forget('viewing_client');
        Session::put('viewing_client', $client_id);
        return view('practitioner.clientManager.viewclient');
    }

    public function update(Request $request)
    {  
       $client = User::find($request->id);

        $client->fname = $request->fname;
        $client->sname = $request->sname;

        if($client->email !== $request->email)
        {
            $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
              ]);

            if ($validator->fails())
                {
                   Session::flash('client_updateerror', $validator->messages()) ;
                   return Redirect()->back()->withInput();
                }
        }
        
        $client->email = $request->email;
        $client->save();

      Session::flash('flash_message', 'Client has been successfully updated!');
      return Redirect()->back();
    }

    /**
     *Store client information.
     *
     * @return Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
        ]);

        if ($validator->fails())
            {
               Session::flash('client_registererrors', $validator->messages()) ;
               return Redirect()->back()->withInput();
            }

        $randomgeneratedpw = str_random(10);

        $newClient = new User;
        $newClient->fname = $request->fname;
        $newClient->sname = $request->sname;
        $newClient->email = $request->email;
        $newClient->password = $randomgeneratedpw;
        $newClient->prac_id = Session::get('prac_id');
        $newClient->gender = $request->gender;
        $newClient->usertype = 'user';
        $newClient->verified = 0;
        $successful_registration = $newClient->save();

        if($successful_registration)
        {   
            $message = "Hello, " . $newClient->fname .". Your account is ready for you! Please use this default password: " 
             . $randomgeneratedpw;

            $email = $newClient->email;

            Mail::raw($message, function($message) use ($email)
            {
                $message->from('noreply.atest@gmail.com', 'Assistive Technology');

                $message->to($email)->subject('Your Account has been created!');

            });
        }

        $newmessage = "Client has been successfully created! The default password has been mailed to ";

         Session::flash('successful_registration', $newmessage);
         Session::flash('email', $newClient->email);
         Session::flash('defaultpassword', $randomgeneratedpw);

        return redirect("practitioner/clientmanager/");
    }

    public function getAllClients()
    {
        $clients = User::latest('created_at')->MyClient()->get();

        if(count($clients) < 1)
        {
            return null;
        }
        else
        {
            return $clients;
        }
    }

}
