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
 * Class ReportTypologyController
 * @package App\Http\Controllers
 */
class ReportTypologyController extends Controller
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
        $report = Report::find($report_id);
        $fetchgoals = $report->questions()->Assessment()->GetGoals()->first();
        $goals = $fetchgoals->pivot->answers;

        $questions = Question::Typology()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $questions_category = Question::Typology()->distinct()->lists('category_id');

        $questionslist = array();
        foreach ($questions_category as $category) {
            $questionslist[] = Question::Typology()
                ->Getquestionsbycat($category)
                ->orderBy('type', 'DESC')
                ->get();
        }

        return view('reports.createTypology', compact('questions', 'goals','questionslist', 'report_id'));
    }

     public function show($report_id)
    {
        $report = Report::find($report_id);
        $clientinfo = User::find($report->userid);
        $pracinfo = Practitioner::find($report->prac_id);

        $fetchgoals = $report->questions()->Assessment()->GetGoals()->first();
        $goals = $fetchgoals->pivot->answers;

        $arraycount = $report->questions()->distinct()->Typology()->orderBy('category_id', 'ASC')->lists('category_id');

        $answerlist = array();
        foreach ($arraycount as $ans) 
        {
            $answerlist[] = $report->questions()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }

        return view('reports.showTypology', compact('answerlist','report','goals', 'clientinfo', 'pracinfo'));
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
        $questioncount = Question::Typology()->lists('id');

        foreach ($questioncount as $questionid) {
            $report->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
        }

        return redirect()->action('ReportManagerController@overview', [$report_id]);
    }

    public function update()
    {
        $rqid = $_POST['rqid'];
        $reportid = $_POST['reportid'];
        $answers = $_POST['answersid'];
       // dd($rqid);

        $i = 0;
        foreach($answers as $updatedanswer)
        {
            DB::update("update question_report set answers ='" . $updatedanswer . "' where rqid = ?", array($rqid[$i]));
            $i++;
        }

        Session::flash('flash_message', 'Report successfully updated!');

        return redirect("reports/Typology/" . $reportid);
    }
}