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

class ProfileController extends Controller
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
    public function show()
    {
        if(Session::has('prac_id'))
        {
            $practitioner = Practitioner::GetCurrent()->first(); 
            $is_verified = $practitioner->verified;
            $report_count = count(Report::Practitioner()->lists('id'));
            $client_count = count(User::MyClient()->lists('id'));

            return view('profile.practitionerProfile', compact('practitioner','report_count','client_count','is_verified'));
        }
        elseif(Auth::check())
        {
            $client = Auth::user();
            $is_verified = $client->verified;
            $my_practitioner = Practitioner::GetThisPractitioner($client->prac_id)->first();
            $report_count = Report::GetUserReports()->get();

            return view('profile.clientProfile', compact('client','my_practitioner','report_count','is_verified'));

        }
        else
        {

        }
       
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Session::has('prac_id'))
        {
            $practitioner = Practitioner::find(Session::get('prac_id'));

        if($practitioner->email !== $request->email)
        {
            $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:practitioners,email|unique:users,email'
              ]);

            if ($validator->fails())
                {
                   Session::put('practitioner_updateerror', $validator->messages()) ;
                   return Redirect()->back()->withInput();
                }
        }
        
        $practitioner->fname = $request->fname;
        $practitioner->sname = $request->sname;
        $practitioner->email = $request->email;
        $practitioner->save();

        Session::put('flash_message', 'Your account has been successfully updated!');
        return redirect("/profile");

        }
        elseif(Auth::check())
        {
            $client = Auth::user();

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
            
            $client->fname = $request->fname;
            $client->sname = $request->sname;
            $client->email = $request->email;
            $client->save();

        Session::put('flash_message', 'Your account has been successfully updated!');
        return redirect("/profile");
            
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
