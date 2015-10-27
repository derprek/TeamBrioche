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
 * Class ClientsReportController
 * @package App\Http\Controllers
 */
class ClientsReportController extends Controller
{   
    /**
     *Check if user is logged in
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if (Auth::guest()) 
                {
                    return redirect('/unauthorizedaccess');
                }
        });
    }

    /**
     * Display a listing of the client reports.
     *
     * @return Response
     */
    public function index()
    {
        $report = Report::GetUserReports()->orderBy('updated_at', 'desc')->first();

        $report_step = $report->step;

        if ($report_step === 3)
        {
            $evaluation_count = count(Evaluation::GetEvaluation($report->id)->get());
        }

        $reporthistory = Report::GetUserReports()->get();

        $latestreport = Report::GetUserReports()->orderBy('updated_at', 'desc')->first();

        return view('Client.reportarchives', compact('report','report_step', 'reporthistory','latestreport', 'answerlist', 'questionlist', 'qrarraylength'));

    }

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

         $questionreport = $report->questions()
            ->where('report_id', '=', $report->id)
            ->get();

            $questionlist = array();
            $answerlist = array();
            foreach ($questionreport as $ans) 
            {
                $questionlist[] = Question::find($ans->pivot->question_id);
                $answerlist[] = $ans->pivot->answers;
            }

            $qrarraylength = count($answerlist);

        return view('Client.reportById', compact('reportstepcount', 'report_id', 'report', 'reportowner','reportselection','reportselectioncount', 'reportviewer', 'pracslist', 'sharerslist','answerlist', 'questionlist', 'qrarraylength'));
    }
}
