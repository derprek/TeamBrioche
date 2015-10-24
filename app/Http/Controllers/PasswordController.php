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

class PasswordController extends Controller
{
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
                $practitioner_password = Practitioner::GetCurrent()->first()->password;
                if($practitioner_password === MD5($current_password))
                {
                    
                }
                else
                {   
                   Session::flash('password_error','Your current password is incorrect');
                   return redirect()->back();
                }
                
            }
        }

        if(Session::has('prac_id'))
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
           $practitioner = Practitioner::GetCurrent()->first();
           $practitioner->password = MD5($newpassword);
           $pass = $practitioner->save();

           Session::flash('flash_message','Your password has been successfully updated');
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
