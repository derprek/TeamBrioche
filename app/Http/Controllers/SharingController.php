<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Report;
use App\Question;
use App\Manager;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Auth;
use Carbon\Carbon;
use Session;

class SharingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function addNewSharer()
    {
        //dd($_POST['prac_list']);
        $newsharers = $_POST['prac_list'];
        $reportid = $_POST['reportid'];

        $report = Report::find($reportid);

        foreach($newsharers as $prac)
        {
            $report->practitioners()->attach($prac);
        }

        Session::flash('banner_message', 'Report is now shared!');
        return redirect("practitioner/overview/" . $reportid);

    }

    public function removeSharer()
    {
        $reportid = $_POST['reportid'];
        $prid = $_POST['prid'];
       
        $report = Report::find($reportid);
        $prac = $report->practitioners()->get();
        $pracname = $prac[0]->name;

        $report->practitioners()
               ->newPivotStatement()
               ->where('prid','=',$prid)
               ->delete();

        Session::flash('banner_message', " $pracname has been removed from the sharing list.");
        return redirect("practitioner/overview/" . $reportid);       
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
