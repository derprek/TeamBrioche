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
     * Display a listing of the client reports.
     *
     * @return Response
     */
    public function index()
    {

        if (Auth::guest()) {

            return redirect('homepage');
        }

        $reports = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();
        $reporthistory = Report::where('userid', '=', Auth::User()->id)->get();

        if (empty($reports->id)) {

        } else {

            $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();

            // Get report and its qns/ans
            $questionreport = $latestreport->questions()
                ->where('report_id', '=', $latestreport->id)
                ->get();

            $questionlist = array();
            $answerlist = array();
            foreach ($questionreport as $ans) {
                $questionlist[] = Question::find($ans->pivot->question_id);
                $answerlist[] = $ans->pivot->answers;
            }

            $qrarraylength = count($answerlist);
            // End

        }

        return view('client.reportarchives', compact('reports', 'reporthistory', 'products', 'latestreport', 'answerlist', 'questionlist', 'qrarraylength'));

    }


}
