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
            $value = Session::get('prac_id');
                if (empty($value)) 
                {
                    return redirect('/../');
                }
        });
    }

    public function index($report_id)
    { 
        $report = Report::find($report_id);
        $client = User::find($report->userid);

        $practitioners = Practitioner::all();
        $reportowner = $practitioners->where('id', $report->prac_id)->first();

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

        return view('practitioner.reportManager.reportoverview', compact('client', 'report_step' ,'report', 'reportowner','evaluation_count', 'shareable_practitioners', 'shared_practitioners'));
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

        Session::flash('banner_message', 'Report successfully updated!');
        return redirect("reports/overview/" . $reportid);
    }
}
