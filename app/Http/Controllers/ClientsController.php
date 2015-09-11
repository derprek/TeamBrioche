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
 * Class ClientsController
 * @package App\Http\Controllers
 */
class ClientsController extends Controller
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
        $reports = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();
        $reporthistory = Report::where('userid', '=', Auth::User()->id)->get();

        if (empty($reports->id)) {

        } else {

            $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();

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

        return view('client.index', compact('reports', 'reporthistory', 'products', 'latestreport', 'answerlist', 'questionlist', 'qrarraylength'));
    }
}
