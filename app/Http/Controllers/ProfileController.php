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
            else
            {
                $change_password_validated = true;
                $old_email = $practitioner->email;
                $practitioner->email = $request->email;
            }
        }
        
        if(($request->fname !== $practitioner->fname) || ($request->sname !== $practitioner->sname))
        {
            $practitioner->fname = $request->fname;
            $practitioner->sname = $request->sname;

            Session::forget('prac_name');
            $prac_name = $practitioner->fname . " " . $practitioner->sname;
            Session::put('prac_name', $prac_name);
        }
        
        $practitioner->save();

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
                else
                {
                    $change_password_validated = true;
                    $old_email = $client->email;
                    $client->email = $request->email;
                }
            }
            
            if(($request->fname !== $client->fname) || ($request->sname !== $client->sname))
            {
                $client->fname = $request->fname;
                $client->sname = $request->sname;
            }

            $client->save();
            
        }

        if(isset($change_password_validated))
            {
                DB::table('conversations')
                    ->where('firstuser_email', $old_email)
                    ->update(['firstuser_email' => $request->email]);

                DB::table('conversations')
                    ->where('seconduser_email', $old_email)
                    ->update(['seconduser_email' => $request->email]);

                DB::table('messages')
                    ->where('sender_email', $old_email)
                    ->update(['sender_email' => $request->email]);

                DB::table('messages')
                    ->where('receiver_email', $old_email)
                    ->update(['receiver_email' => $request->email]);
            }

        Session::put('flash_message', 'Your account has been successfully updated!');
        return redirect("/profile");

    }

}
