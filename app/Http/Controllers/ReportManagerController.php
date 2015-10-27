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
use App\Assessment;

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
                if ((Auth::guest()) && (!Session::has('prac_id'))) 
                {
                    return redirect('/unauthorizedaccess');
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
        return view('reports.reportmanager');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    

    public function getMyReports()
    {  
        if(Session::has('prac_id'))
        {
          $reports = Report::latest('updated_at')->practitioner()->get();
        }
        elseif(Auth::check())
        {
          $reports = Report::latest('updated_at')->GetUserReports()->get();
        }
        
        $reportlist = array();
        foreach($reports as $report)
        {       
          if(Session::has('prac_id'))
          {
            $client = User::find($report->userid);
            $name = $client->fname . " " . $client->sname;
          }
          else
          {
            $practitioner = Practitioner::find($report->prac_id);
            $name = $practitioner->fname . " " . $practitioner->sname;
          }
            

            if($report->updated_at->isToday())
            {
                $updated_date = date('h:ia', strtotime($report->updated_at));
            }
            else
            {
                $updated_date = date('F d, Y', strtotime($report->updated_at));
            }

            if($report->created_at->isToday())
            {
                $created_date = date('h:ia', strtotime($report->created_at));
            }
            else
            {
                $created_date = date('F d, Y', strtotime($report->created_at));
            }
           
            $reportlist[] = ['id'=>$report->id,
                                'name'=>$name,
                                'updated_at'=>$updated_date,
                                'status'=>$report->status,
                                'created_at'=>$created_date];
                      
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
        $practitioner = Practitioner::find(Session::get('prac_id'));
       
        $shared_reports = $practitioner->reports()->get();

        $reportlist = array();

        foreach($shared_reports as $report)
        {       
            $client = User::find($report->userid);

            if($report->updated_at->isToday())
            {
                $updated_date = date('h:ia', strtotime($report->updated_at));
            }
            else
            {
                $updated_date = date('F d, Y', strtotime($report->updated_at));
            }

            if($report->created_at->isToday())
            {
                $created_date = date('h:ia', strtotime($report->created_at));
            }
            else
            {
                $created_date = date('F d, Y', strtotime($report->created_at));
            }
           
            $reportlist[] = ['id'=>$report->id,
                                'name'=>$client->fname . " " . $client->sname,
                                'updated_at'=>$updated_date,
                                'status'=>$report->status,
                                'created_at'=>$created_date];
                      
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
        $pracinfo = Practitioner::find(Session::get('prac_id'));
        
        $assessment = Assessment::GetAssessment($report_id)->first();
        $current_version = Version::find($assessment->current_version);
        $creator_practitioner = Practitioner::GetThisPractitioner($current_version->prac_id)->first();
        $clientinfo = User::find($report->userid);

        $arraycount = $assessment->questions()->distinct()->GetCurrentVersion($assessment->current_version)->orderBy('category_id','ASC')->lists('category_id');

         $answerlist = array();
          foreach($arraycount as $ans)
          {
            $answerlist[] = $assessment->questions()
                                   ->where('category_id','=', $ans)
                                   ->orderBy('type','DESC')
                                   ->get();
          }
       
      $pdf = \PDF::loadView('report.reportPDF', compact('answerlist','assessment','clientinfo','pracinfo','creator_practitioner'));

      return $pdf->stream('assessementReport.pdf',array("Attachment" => 0));
    }

    public function printSummary($report_id)
    { 
      $report = Report::find($report_id);
      $practitioner = Practitioner::find($report->prac_id);
      $client = User::find($report->userid);

      $assessment = Assessment::GetAssessment($report_id)->first();  
      $assessment_answers = $assessment->questions()->where('version_id','=', $assessment->version_id)->get();
      dd($assessment_answers);
          foreach($arraycount as $ans)
          {
            $answerlist[] = $report->questions()
                                   ->where('category_id','=', $ans)
                                   ->orderBy('type','DESC')
                                   ->get();
          }
   
      
       
      //$pdf = \PDF::loadView('report.reportPDF', compact('answerlist','report','clientinfo','pracinfo'));

      //return $pdf->stream('file.pdf',array("Attachment" => 0));
    }
}
