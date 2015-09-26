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
use Auth;
use Carbon\Carbon;
use Session;

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
                    return redirect('/../');
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
        $reports = Report::GetUserReports()->orderBy('updated_at', 'desc')->first();
        $reporthistory = Report::GetUserReports()->get();

        $latestreport = Report::GetUserReports()->orderBy('updated_at', 'desc')->first();

        if(!empty($latestreport))
        {
            $questionreport = $latestreport->questions()
            ->where('report_id', '=', $latestreport->id)
            ->get();

            $questionlist = array();
            $answerlist = array();
            foreach ($questionreport as $ans) 
            {
                $questionlist[] = Question::find($ans->pivot->question_id);
                $answerlist[] = $ans->pivot->answers;
            }

            $qrarraylength = count($answerlist);
        }

        return view('Client.reportarchives', compact('reports', 'reporthistory','latestreport', 'answerlist', 'questionlist', 'qrarraylength'));

    }
}
