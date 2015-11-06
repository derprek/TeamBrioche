<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use App\Report;
use App\Question;
use App\Practitioner;
use App\User;
use App\Assessment;

/**
 * Class ReportManagerController
 * @package App\Http\Controllers
 */
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
     * loads the view that displays all of the reports that is associated to the practitioner
     *
     * @return Response
     */
    public function index()
    {
        return view('reports.reportmanager');
    }

     /**
     * Fetches the reports that belongs to the practitioner/admin
     * used in: views/admin/reportmanager
     * used in: views/reports/reportmanager
     *
     * used by: public/js/angular_js/reports/MyReportsController.js
      *
     * @param  int $id
     * @return Response
     */
    public function getMyReports()
    {  

      if((Session::has('prac_id')) && (Session::has('is_admin')))
      {
          $reports = Report::all();

          $reportlist = array();
          foreach($reports as $report)
          {       
              $client = User::find($report->userid);
              $practitioner = Practitioner::find($report->prac_id);

              if($report->updated_at->isToday())
              {
                  $updated_date = date('h:ia', strtotime($report->updated_at));
              }
              else
              {
                  $updated_date = date('F d, Y', strtotime($report->updated_at));
              }
             
              $reportlist[] = ['id'=>$report->id,
                                  'client_name'=>$client->fname . " " . $client->sname,
                                  'prac_name'=>$practitioner->fname . " " . $practitioner->sname,
                                  'updated_at'=>$updated_date,
                                  'status'=>$report->status];
                        
          }
      }
      else
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
     * Fetches the reports that is shared with the practitioner/admin
     *
     * used in: views/admin/reportmanager
     * used in: views/reports/reportmanager
     *
     * used by: public/js/angular_js/reports/SharedReportsController.js
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
}
