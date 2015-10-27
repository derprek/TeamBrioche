<?php

namespace App\Http\Controllers;

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
use App\Selection;
use App\Message;
use App\Conversation;
use Input;
use Validator;
use Mail;

class PersonnelController extends Controller
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
        return view('admin.personnelManager.personnelmanager');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storePractitioner(Request $request)
    {   
         $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
        ]);

        if ($validator->fails())
            {
               Session::flash('prac_registererrors', $validator->messages());
               return Redirect()->back()->withInput();
            }

        $randomgeneratedpw = str_random(10);

        $newPractitioner = new Practitioner;
        $newPractitioner->fname = $request->fname;
        $newPractitioner->sname = $request->sname;
        $newPractitioner->email = $request->email;
        $newPractitioner->password = MD5($randomgeneratedpw);
        $newPractitioner->usertype = 'practitioner';
        $newPractitioner->verified = 0;
        $successful_registration = $newPractitioner->save();

        if($successful_registration)
        {   
            $message = "Hello, " . $newPractitioner->fname .". Your account is ready for you! Please use this default password: " 
             . $randomgeneratedpw;

            $email = $newPractitioner->email;

            Mail::raw($message, function($message) use ($email)
            {
                $message->from('noreply.atest@gmail.com', 'Assistive Technology');

                $message->to($email)->subject('Your Account has been created!');

            });
        }

        $newmessage = "The default password has been mailed to ";

        Session::put('info_title', 'Practitioner has been successfully registered!');
        Session::put('info_message', $newmessage);
        Session::put('client_email', $newPractitioner->email);

         return redirect("admin/personnelmanager");
    }

    public function storeClient(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
        ]);

        if ($validator->fails())
            {
               Session::flash('client_registererrors', $validator->messages()) ;
               return Redirect()->back()->withInput();
            }

        $practitioner = Practitioner::ValidateEmail($request->prac_email)->first();
        $randomgeneratedpw = str_random(10);

        $newClient = new User;
        $newClient->fname = $request->fname;
        $newClient->sname = $request->sname;
        $newClient->email = $request->email;
        $newClient->password = $randomgeneratedpw;
        $newClient->prac_id = $practitioner->id;
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

        $newmessage = "The default password has been mailed to ";

        Session::put('info_title', 'Client has been successfully registered!');
        Session::put('info_message', $newmessage);
        Session::put('client_email', $newClient->email);

         return redirect("admin/personnelmanager");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showPractitioner($prac_id)
    {   
        Session::forget('viewing_practitioner');
        Session::put('viewing_practitioner', $prac_id);

        return view('admin.personnelManager.viewpractitioner');
    }

    public function showClient($client_id)
    {   
        Session::forget('viewing_client');
        Session::put('viewing_client', $client_id);

        return view('practitioner.clientManager.viewclient');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function updatePractitioner(Request $request)
    {
        $practitioner = Practitioner::find($request->id);

        $practitioner->fname = $request->fname;
        $practitioner->sname = $request->sname;

        if($practitioner->email !== $request->email)
        {
            $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
              ]);

            if ($validator->fails())
                {
                   Session::flash('practitioner_updateerror', $validator->messages()) ;
                   return Redirect()->back()->withInput();
                }
        }
        
        $practitioner->email = $request->email;
        $practitioner->save();

      Session::flash('flash_message', 'Practititioner has been successfully updated!');
      return redirect("admin/viewpractitioner/" . $request->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllPractitioners()
    {
        $practitioners = Practitioner::latest('created_at')->get();

        $practitionerlist = array();
        foreach($practitioners as $prac)
        {
            $practitionerlist[] = ['id'=>$prac->id,
                                'name'=>$prac->fname . " " . $prac->sname,
                                'email'=>$prac->email,
                                'created_at' =>$prac->created_at->diffForHumans()
                                ];
        }

        if(count($practitionerlist) < 1)
        {
            return null;
        }
        else
        {   
            return $practitionerlist;
        }

    }

    public function getAllClients()
    {
        $clients = User::latest('created_at')->get();

        $clientlist = array();
        foreach($clients as $client)
        {
            $clientlist[] = ['id'=>$client->id,
                                'name'=>$client->fname . " " . $client->sname,
                                'email'=>$client->email,
                                'created_at' =>$client->created_at->diffForHumans()
                                ];
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

    public function getThisPractitioner()
    {     
        $practitioner = Practitioner::find(Session::get('viewing_practitioner'));

        if($practitioner === null)
        {
            return null;
        }
        else
        {   
            return $practitioner;
        }

    }

    public function getPractitionerClients()
    {     
        $practitioner = Practitioner::find(Session::get('viewing_practitioner'));

        if($practitioner === null)
        {
            return null;
        }
        else
        {   
            $clients = User::latest('updated_at')->GetPractitionerClients($practitioner->id)->get();

            $clientlist = array();
            foreach($clients as $client)
            {       
                $client_name = $client->fname . " " . $client->sname;

                $clientlist[] = ['id'=>$client->id,
                                    'name'=>$client_name,
                                    'created_at'=>$client->created_at->diffForHumans()];
                          
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
    }

    public function getPractitionerReports()
    {     
        $practitioner = Practitioner::find(Session::get('viewing_practitioner'));

        if($practitioner === null)
        {
            return null;
        }
        else
        {   
            $reports = Report::latest('updated_at')->GetThisPractitionerReports($practitioner->id)->get();

            $reportlist = array();
            foreach($reports as $report)
            {       
                $username = User::find($report->userid);
               
                $reportlist[] = ['id'=>$report->id,
                                    'name'=>$username->fname . " " . $username->sname,
                                    'updated_at'=>$report->updated_at->diffForHumans(),
                                    'status'=>$report->status,
                                    'created_at'=>$report->created_at->diffForHumans()];
                          
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

     public function getClientReports()
    {     
        $client = Practitioner::find(Session::get('viewing_client'));

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
                $reportlist[] = ['id'=>$report->id,
                                    'updated_at'=>$report->updated_at->diffForHumans(),
                                    'status'=>$report->status,
                                    'created_at'=>$report->created_at->diffForHumans()];
                          
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

    public function deletePractitioner(Request $request)
    {     
       $practitioner = Practitioner::find($request->id);

       if($practitioner === null)
       {
            $error = true;
       }
       else
       {    
            $error = false;
            $practitioner_name = $practitioner->fname . " " . $practitioner->sname;
            $practitioner->delete();
       }

       if(($error === true) || ($result === false))
        {
            Session::put('error_message', 'There was an error in deleting the practitioner!');
        }
        elseif($error === false)
        {
            Session::put('flash_message', '$practitioner_name has been successfully deleted!');
        }

       return redirect("admin/personnelmanager/");
    }
}
