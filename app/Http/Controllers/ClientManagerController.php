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
use App\Practitioner;
use App\User;
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
     * Redirects the practitioner without practitioner rights
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if((!Session::has('prac_id')))
            {
                return redirect('/unauthorizedaccess');
            }   
        });
    }

    /**
     * Loads the client manager view
     *
     * @return Response
     */
    public function index()
    {   
        $prac_id = Session::get('prac_id');

        return view('practitioner.clientManager.clientmanager', compact('prac_id'));
    }

    /**
     * Loads the client manager view
     *
     * @return Response
     */
    public function show($client_id)
    {   
      $client = User::find($client_id);

      if($client !== null)
      {
         if((Session::has('is_admin')) || (Session::get('prac_id') === $client->prac_id))
         { 
            $invalid = false;
            Session::forget('viewing_client');
            Session::put('viewing_client', $client_id);

            return view('practitioner.clientManager.viewclient');
         }   
         else
         {
            $invalid = true;
         }
      }
      else
      {
          $invalid = true;
      }

      if($invalid === true)
      {
          return redirect('/unauthorizedaccess');
      }
    }

    /**
     * controls the updating of client details
     *
     * @return Response
     */
    public function update(Request $request)
    {  
       $client = User::find($request->id);

        $client->fname = $request->fname;
        $client->sname = $request->sname;

        // Checks if a new email is provided and if so, validates it
        if($client->email !== $request->email)
        {
            $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
              ]);

            if ($validator->fails())
                {
                   Session::put('client_updateerror', $validator->messages()) ;
                   return Redirect()->back()->withInput();
                }
        }
        
        $client->email = $request->email;
        $client->save();

      Session::put('flash_message', 'Client has been successfully updated!');
      return Redirect()->back();
    }

    /**
     * controls the storing of a new client
     *
     * @return Response
     */
    public function store(Request $request)
    {   
        //validates the provided email against all existing emails in the database
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
        ]);

        if ($validator->fails())
            {
               Session::put('client_registererrors', $validator->messages()) ;
               return Redirect()->back()->withInput();
            }

        // Generates a random 10-digit string as the default password
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

        // Sends an email to the registered email address with the default password.
        if($successful_registration)
        {   
            $message = "Hello, " . $newClient->fname .". Your account is ready for you! Please use this default password: " 
             . $randomgeneratedpw ."\r\n\r\n Click here: uqatest.com/login/". $randomgeneratedpw ." to log in ";;

            $email = $newClient->email;

            Mail::raw($message, function($message) use ($email)
            {
                $message->from('noreply.atest@gmail.com', 'Assistive Technology');

                $message->to($email)->subject('Your Account has been created!');

            });
        }

        $newmessage = "The default password has been mailed to ";

        Session::put('info_title', 'Client has been successfully registered!');
        Session::put('info_message', $newmessage);
        Session::put('client_email', $newClient->email);

         if(Session::has('report_noclients'))
         {
            Session::forget('report_noclients');

            return redirect("reports/assessment/new");
         }
         else
         {
            return redirect("practitioner/clientmanager/");
         }

        
    }

    /**
     * Fetches all of the clients associated with this practitioner
     *
     * @return Response
     */
    public function getAllClients()
    {
        $clients = User::latest('created_at')->MyClient()->get();

        $clientlist = array();
        foreach($clients as $client)
        {       
            if($client->created_at->isToday())
            {
                $joined_date = date('h:ia', strtotime($client->created_at));
            }
            else
            {
                $joined_date = date('F d, Y', strtotime($client->created_at));
            }
           
            $clientlist[] = ['id'=>$client->id,
                             'email'=>$client->email,
                             'name'=>$client->fname . " " . $client->sname,
                             'joined_date'=>$joined_date];   
        }

        if(count($clientlist) < 1)
        {
            return null;
        }
        else
        {
            return $clientlist;
        }
    }

    /**
     * Fetches the information regarding the selected client
     *
     * @return array
     */
    public function getThisClient()
    {    
        $client = User::find(Session::get('viewing_client'));
        $practitioner = Practitioner::find($client->prac_id);
        $prac_name = $practitioner->fname . " " . $practitioner->sname;

        $clientinfo = ['id'=>$client->id,
                        'fname'=>$client->fname,
                        'sname'=>$client->sname,
                        'email'=>$client->email,
                        'verified'=>$client->verified,
                        'prac_name'=>$prac_name,
                        'prac_email'=>$practitioner->email,
                        'created_at'=>$client->created_at->diffForHumans()];

        if($clientinfo === null)
        {
            return null;
        }
        else
        {   
            return $clientinfo;
        }

    }

    /**
     * Fetches the reports associated to the selected client
     *
     * @return Response
     */
    public function getClientReports()
    {     
        $client = User::find(Session::get('viewing_client'));

        if($client === null)
        {
            return null;
        }
        else
        {   
            $reports = Report::latest('updated_at')->GetClientReports($client->id)->get();

            $reportlist = array();
            foreach($reports as $report)
            {       
                if($report->created_at->isToday())
                {
                    $created_at = date('h:ia', strtotime($report->created_at));
                }
                else
                {
                    $created_at = date('F d, Y', strtotime($report->created_at));
                }

                if($report->updated_at->isToday())
                {
                    $updated_at = date('h:ia', strtotime($report->updated_at));
                }
                else
                {
                    $updated_at = date('F d, Y', strtotime($report->updated_at));
                }

                $reportlist[] = ['id'=>$report->id,
                                    'updated_at'=>$updated_at,
                                    'status'=>$report->status,
                                    'created_at'=>$created_at];
                          
            }

            if(count($reportlist) < 1)
            {
                return null;
            }
            else
            {
                return $reportlist;
            }
            
        }
    }

    /**
     * controls the deletion of clients
     *
     * @return Response
     */
    public function deleteClient(Request $request)
    {     
       $client = User::find($request->id);

       if($client === null)
       {
         return redirect('/unauthorizedaccess');
       }

        if((Session::has('is_admin')) || ($client->prac_id === Session::get('prac_id')))
        {
            if($client === null)
            {
                $error = true;
            }
            else
            {    
                $error = false;
                $client_name = $client->fname . " " . $client->sname;
                $result = $client->delete();
            }

            if(($error === true) || ($result === false))
            {
                Session::put('error_message', 'There was an error in deleting the client!');
            }
            elseif($error === false)
            {
                Session::put('flash_message', "$client_name has been successfully deleted!");
            }

            if(!Session::has('is_admin'))
            {
              return redirect("/practitioner/clientmanager"); 
            }

            return redirect("admin/personnelmanager/");
        }
        else
        {
            return redirect('/unauthorizedaccess');
        }
       
    }

}
