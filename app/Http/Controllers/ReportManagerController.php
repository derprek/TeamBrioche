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

use DOMPDF;
use Barryvdh\DomPDF\Facade as PDF;

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
        return view('practitioner.reportManager.reportmanager');
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
        $pracslist = Practitioner::lists('fname', 'id');
        $sharerslist = $report->practitioners()->get();

        return view('practitioner.reportManager.reportoverview', compact('reportstepcount', 'report_id', 'report', 'reportowner','reportselection','reportselectioncount', 'reportviewer', 'pracslist', 'sharerslist'));
    }

    public function getMyReports()
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

/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

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

    public function generatereport($report_id)
    {
        $pracid = Session::get('prac_id');
        $pracinfo = Practitioner::find($pracid);
        
        $report = Report::find($report_id);
        $clientinfo = User::find($report->userid);

        $arraycount = $report->questions()->distinct()->where('step','=',1)->orderBy('category_id','ASC')->lists('category_id');

         $answerlist = array();
          foreach($arraycount as $ans)
          {
            $answerlist[] = $report->questions()
                                   ->where('category_id','=', $ans)
                                   ->orderBy('type','DESC')
                                   ->get();
          }
      //dd($answerlist);  
      //$data['name'] = "name123";
       
      $pdf = \PDF::loadView('practitioner.reportManager.reportPDF', compact('answerlist','report','clientinfo','pracinfo'));

      return $pdf->stream('file.pdf',array("Attachment" => 0));
    }
}
