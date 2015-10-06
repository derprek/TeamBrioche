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

class AdminReportManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.reportManager.reportmanager');
    }

     public function getAllReports()
    {
        $reports = Report::all();

        $reportlist = array();
        foreach($reports as $report)
        {       
            $client = User::find($report->userid);
            $practitioner = Practitioner::find($report->prac_id);
           
            $reportlist[] = ['id'=>$report->id,
                                'client_name'=>$client->fname . " " . $client->sname,
                                'prac_name'=>$practitioner->fname . " " . $practitioner->sname,
                                'updated_at'=>$report->updated_at->diffForHumans(),
                                'status'=>$report->status];
                      
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
