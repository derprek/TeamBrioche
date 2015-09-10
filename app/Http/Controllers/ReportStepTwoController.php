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

class ReportStepTwoController extends Controller
{
    public function index($report_id)
    {
        $questions = Question::Steptwo()->orderBy('category_id','ASC')->orderBy('type','DESC')->get();
        $clients = User::latest('created_at')->Myclient()->get();
        $questions_category= Question::Steptwo()->distinct()->lists('category_id');

        $questionslist = array();
        foreach($questions_category as $ans)
        {
            $questionslist[] = Question::Steptwo()
                ->Getquestionsbycat($ans)
                ->orderBy('type','DESC')
                ->get();
        }

        return view('reports.createsteptwo', compact('questions','clients','questionslist','report_id'));
    }

    public function store()
    {
        $report_id = $_POST['reportid'];
        $report = Report::find($report_id);
        $questioncount = Question::Steptwo()->lists('id');

        foreach($questioncount as $questionid)
        {
            $report->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
        }

        return redirect()->action('PractitionersController@reportOverview', [$report_id]);
    }


}
