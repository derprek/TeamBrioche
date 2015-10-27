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

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function homepage()
    {
        if(Session::has('prac_id'))
        {
            return redirect('/practitioner/dashboard');
        }
        elseif(Auth::check()) 
        {
            return redirect('/home');
        }
        elseif(Auth::guest()) 
        {
            return view('homepage');
        }

    }

    public function authorizedaccess()
    {   
        if(Session::has('prac_id'))
        {
            if(Session::has('is_admin'))
            {
                $usertype='admin';
            }   
            else
            {
                $usertype='practitioner';
            }
            
        }
        elseif(Auth::check()) 
        {
            $usertype='client';
        }
        elseif(Auth::guest()) 
        {
            $usertype='guest';
        }

        return view('unauthorized', compact('usertype'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
