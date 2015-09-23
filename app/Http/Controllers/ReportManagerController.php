<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

class ReportManagerController extends Controller
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
     * Display the report history.
     *
     * @return Response
     */
    public function index()
    {

        return view('practitioner.reportmanager');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function overview($report_id)
    {
        $report = Report::find($report_id);
        $reportviewer = Session::get('prac_id');
        $reportowner = $report->prac_id;
        $reportstepcount = $report->questions()->distinct()->lists('step');
        $reportselection = Selection::GetReports($report_id)->get();
        $reportselectioncount = count($reportselection);
        $pracslist = Practitioner::lists('name', 'id');
        $sharerslist = $report->practitioners()->get();

        return view('practitioner.reportoverview', compact('reportstepcount', 'report_id', 'report', 'reportowner','reportselection','reportselectioncount', 'reportviewer', 'pracslist', 'sharerslist'));
    }

    public function getAllReports()
    {
        $prac_reports = Report::latest('updated_at')->practitioner()->get();

        $reportlist = array();
        foreach($prac_reports as $report)
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

     public function getProgressReports()
    {

        $progress = Report::latest('updated_at')->practitioner()->progress()->get();

        $reportlist = array();
        foreach($progress as $report)
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
        
        //return Todo::all();
    }

    public function getFinishedReports()
    {

        $finished = Report::latest('updated_at')->practitioner()->finished()->get();

        $reportlist = array();
        foreach($finished as $report)
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

    public function getSharedReports()
    {

        $pracid = Session::get('prac_id');
        $pracinfo = Practitioner::find($pracid);
       
        $shared = $pracinfo->reports()->get();


        $reportlist = array();
        foreach($shared as $report)
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