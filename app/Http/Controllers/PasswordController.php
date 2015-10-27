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
use App\Category;
use App\Selection;
use Validator;
use Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter(function(){
           
               if ((Auth::guest()) && (!Session::has('prac_id')))
               {
                    return redirect('/unauthorizedaccess');
               }
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {  
        if(isset($request->current_password))
        {
            $current_password = $request->current_password;

            if(Session::has('prac_id'))
            {
                $practitioner = Practitioner::GetCurrent()->first();
                if($practitioner->password === MD5($current_password))
                {
                    $validator = Validator::make($request->all(), [
                       'new_password' => 'required|min:7',
                       'confirm_password' => 'required|same:new_password', 
                    ]);

                     if ($validator->fails()) 
                     {
                           Session::flash('password_error','Your passwords do not match');
                           return redirect()->back();
                     }

                     $newpassword = $request->new_password;

                     $practitioner->password = MD5($newpassword);
                     $practitioner->save();

                     Session::put('flash_message','Your password has been successfully updated');
                     return redirect()->back();
                }
                else
                {   
                   Session::put('password_error','Your current password is incorrect');
                   return redirect()->back();
                }
                
            }
            elseif(Auth::check())
            {
                $client = Auth::user();

                if (Hash::check($current_password, $client->password)) 
                {
                   $validator = Validator::make($request->all(), [
                       'new_password' => 'required|min:7',
                       'confirm_password' => 'required|same:new_password', 
                    ]);

                    if ($validator->fails()) 
                    {
                        Session::put('password_error','Your passwords do not match');
                        return redirect()->back();
                    }

                    $newpassword = $request->new_password;
   
                    $client->password = $newpassword;
                    $client->save();

                    Session::put('flash_message','Your password has been successfully updated');
                    return redirect()->back();
                }
                else
                {
                    Session::put('password_error','Your current password is incorrect');
                    return redirect()->back();
                }
                
            }
        }

        else
        {
            if(Session::has('prac_id'))
            {
                $validator = Validator::make($request->all(), [
                   'new_password' => 'required|min:7',
                   'confirm_password' => 'required|same:new_password', 
                ]);

                 if ($validator->fails()) 
                 {
                       Session::put('password_error','Your passwords do not match');
                       return redirect()->back();
                 }

               $newpassword = $request->new_password;
               $practitioner = Practitioner::GetCurrent()->first();
               $practitioner->password = MD5($newpassword);
               $practitioner->verified = 1;
               $practitioner->save();

               Session::put('flash_message','Your password has been successfully updated');
               return redirect()->back();
           }
           elseif(Auth::check())
           {
                $validator = Validator::make($request->all(), [
                   'new_password' => 'required|min:7',
                   'confirm_password' => 'required|same:new_password', 
                ]);

                if ($validator->fails()) 
                {
                    Session::put('password_error','Your passwords do not match');
                    return redirect()->back();
                }

                $newpassword = $request->new_password;
                $client = Auth::user();
                $client->password = $newpassword;
                $client->verified = 1;
                $client->save();

                Session::put('flash_message','Your password has been successfully updated');
                return redirect()->back();
           }
        }
    }

    

    public function newuser(Request $request)
    {
        if(isset($request->registered_email))
        {
            if($request->registered_email !== $request->email)
            {
                Session::put('invalid_user','Invalid Email provided');
                return redirect()->back();
            }
        }
        
        Session::put('registered_email' , $request->email);
        
        return redirect('setpassword');     

    }

    public function setpasswordpage()
    {   
        $registered_email = Session::pull('registered_email');
        $is_verified = false;

        return view('profile.setnewpassword',compact('is_verified','registered_email'));     
    }

    public function setfirstpassword(Request $request)
    {
         $validator = Validator::make($request->all(), [
           'new_password' => 'required|min:7',
           'confirm_password' => 'required|same:new_password', 
        ]);

         if ($validator->fails()) 
         { 
               Session::put('password_error','Your passwords do not match');
               return redirect()->back();
         }

            if(!Session::has('new_user_email'))
            {
                return redirect('/unauthorizedaccess');
            }


            $get_user = User::ValidateEmail(Session::get('new_user_email'))->first();

            if($get_user !== null)
            {
                $client = $get_user;
                $client->password = $request->new_password;
                $client->verified = 1;
                $saved = $client->save();  

                if($saved)
                {
                    Auth::login($client);
                }

                Session::put('flash_message','Welcome to ATEST');
                return redirect('home');
            }
            else
            {
                 $get_user = Practitioner::ValidateEmail(Session::get('new_user_email'))->first();
            }

            if($get_user !== null)
            {
                if(!isset($client))
                {
                    $practitioner = $get_user;

                    $practitioner->password = $request->new_password;
                    $practitioner->verified = 1;
                    $saved = $practitioner->save();

                    Session::put('prac_id', $practitioner->id);
                    $prac_name = $practitioner->fname . " " . $practitioner->sname;
                    Session::put('prac_name', $prac_name);
                    Session::forget('is_admin');

                    Session::put('flash_message','Welcome to ATEST');
                    
                    if($practitioner->usertype === 'admin')
                    {
                         return redirect('admin/dashboard');
                    }
                    else
                    {
                         return redirect('practitioner/dashboard');
                    }
                }
            }

            if(!isset($saved))
            {
                return redirect('/unauthorizedaccess');
            }
        

        return view('profile.setnewpassword',compact('is_verified'));     

    }

    public function validateuser($password)
    {   
        Session::forget('new_user_email');

        if((Auth::check()) || (Session::has('prac_id')))
        {
            $invalid = true;
        }
        $clients = User::GetUnverified()->get();

        foreach($clients as $client)
        {
            if (Hash::check($password, $client->password))
            {
                $get_new_user = $client;
            }
        }

        if(!isset($get_new_user))
        {
            $get_new_user = Practitioner::GetUnverified()->ValidatePassword(MD5($password))->first();
        }

        if($get_new_user === null)
        {
            return redirect('/unauthorizedaccess');
        }

        Session::put('new_user_email', $get_new_user->email);

        return view('profile.validatenewuser');     
     }

}
