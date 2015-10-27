<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Report;
use App\Question;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Auth;
use Carbon\Carbon;
use Session;
use App\Practitioner;
use App\Evaluation;

/**
 * Class ReportOverviewController
 * @package App\Http\Controllers
 */
class ReportOverviewController extends Controller
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

    public function index($report_id)
    { 
        $report = Report::find($report_id);

        if($report === null)
        {
            return redirect('/unauthorizedaccess');
        }

        if((Session::has('prac_id')) && (!Session::has('is_admin')))
        {
            $allowed_list = $report->practitioners()->lists('practitioner_id');
        
                foreach($allowed_list as $practitioner)
                {
                    if ($practitioner === Session::get('prac_id')) 
                    {
                        $validated = true;
                    } 
                }

                if((!isset($validated)) && ($report->prac_id !== Session::get('prac_id')))
                {
                    return redirect('/unauthorizedaccess');
                }
        }

        if(Auth::check())
        {
            if(Auth::user()->id !== $report->userid)
            {
                return redirect('/unauthorizedaccess');
            }
        }
        

        $client = User::find($report->userid);

        $practitioners = Practitioner::all();
        $reportowner = $practitioners->where('id', $report->prac_id)->first();

        if(($report->prac_id === $reportowner->id) || (Session::has('is_admin')))
        {
            $can_view_client = true;
        }
        else
        {
            $can_view_client = false;
        }

        $report_step = $report->step;

        if ($report_step === 3)
        {
            $evaluation_count = count(Evaluation::GetEvaluation($report_id)->get());
        }

        $shareable_practitioners = Practitioner::
        where('id','!=', $report->prac_id)
        ->whereNotExists(function($query) use ($report_id)
        {
            $query->select(DB::raw(1))
                  ->from('practitioner_report')
                  ->where('report_id','=', $report_id)
                  ->whereRaw('practitioner_report.practitioner_id = practitioners.id');
        })
        ->lists('email','id');
 
        $shared_practitioners = Practitioner::
        whereExists(function($query) use ($report_id)
        {
            $query->select(DB::raw(1))
                  ->from('practitioner_report')
                  ->where('report_id','=', $report_id)
                  ->whereRaw('practitioner_report.practitioner_id = practitioners.id');
        })
        ->get();

        return view('reports.reportoverview', compact('client', 'report_step' ,'report', 'reportowner','evaluation_count', 'shareable_practitioners', 'shared_practitioners','can_view_client'));
    }


    /**
     * Update a report.
     *
     * @return Redirect
     */
    public function update()
    {
        $reportid = $_POST['reportid'];
        $reports = Report::find($reportid);

        if (isset($_POST['ReportStatus'])) 
        {
            $status = $_POST['ReportStatus'];
        } 
        else 
        {
            $status = "In Progress";
        }

         if (isset($_POST['PublishedStatus'])) 
        {
            $publishstatus = $_POST['PublishedStatus'];
        } 
        else 
        {
            $publishstatus = "0";
        }

        $prac_notes = $_POST['prac_notes'];

        $reports->status = $status;
        $reports->published = $publishstatus;   
        $reports->prac_notes = $prac_notes;

        $reports->save();

        Session::put('flash_message', 'Report successfully updated!');
        return redirect("reports/overview/" . $reportid);
    }
}
