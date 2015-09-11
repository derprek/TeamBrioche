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

/**
 * Class ReportStepTwoController
 * @package App\Http\Controllers
 */
class ReportStepTwoController extends Controller
{    
    /**
     *Check if user is logged in
     *
     * @return Response
     */   
    public function __construct()
    {
        $this->beforeFilter(function(){
            $value = Session::get('userid');
                if (empty($value)) {
                    return redirect('/../');
                }
        });
    }

    /**
     * Display report in step two.
     *
     * @param $report_id
     * @return Response
     */
    public function index($report_id)
    {
        $questions = Question::Steptwo()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $clients = User::latest('created_at')->Myclient()->get();
        $questions_category = Question::Steptwo()->distinct()->lists('category_id');

        $questionslist = array();
        foreach ($questions_category as $ans) {
            $questionslist[] = Question::Steptwo()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }

        return view('reports.createsteptwo', compact('questions', 'clients', 'questionslist', 'report_id'));
    }

    /**
     * Store a report in step two.
     *
     * @return Response
     */
    public function store()
    {
        $report_id = $_POST['reportid'];
        $report = Report::find($report_id);
        $questioncount = Question::Steptwo()->lists('id');

        foreach ($questioncount as $questionid) {
            $report->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
        }

        return redirect()->action('PractitionersController@reportOverview', [$report_id]);
    }
}
