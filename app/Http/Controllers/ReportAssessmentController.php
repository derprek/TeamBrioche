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
use App\Category;

/**
 * Class ReportAssessmentController
 * @package App\Http\Controllers
 */
class ReportAssessmentController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $questions = Question::Assessment()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $clients = User::latest('created_at')->MyClient()->get();
        $questions_category = Question::Assessment()->distinct()->lists('category_id');

        $questionslist = array();
        foreach ($questions_category as $category)
        {
            $questionslist[] = Question::Assessment()
                ->Getquestionsbycat($category)
                ->orderBy('type', 'DESC')
                ->get();
        }

        return view('reports.createAssessment', compact('questions', 'clients', 'questionslist'));
    }

    /**
     * Store a report in step one.
     *
     * @return Response
     */
    public function store()
    {
        $client = $_POST['client'];
        $pracid = Session::get('prac_id');

        $reports = new Report;
        $reports->userid = $client;
        $reports->step = '1';
        $reports->date = Carbon::now();
        $reports->status = 'In Progress';
        $reports->prac_id = $pracid;
        $reports->updated_at = Carbon::now();
        $reports->save();

        $totalAnswers = count(Question::Assessment()->lists('id'));

        for ($a = 1; $a < $totalAnswers + 1; $a++) 
        {
            $reports->questions()->attach($a, array('answers' => $_POST['answersid'][$a]));
        }

        return redirect('practitioner/reportmanager');
    }

    /**
     * Display a report.
     *
     * @param $report_id
     * @return Response
     */
    public function show($report_id)
    {
        $report = Report::find($report_id);
        $clientinfo = User::find($report->userid);
        $pracinfo = Practitioner::find($report->prac_id);

        $arraycount = $report->questions()->distinct()->Assessment()->orderBy('category_id', 'ASC')->lists('category_id');

        $answerlist = array();
        foreach ($arraycount as $ans) 
        {
            $answerlist[] = $report->questions()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }

        return view('reports.showAssessment', compact('answerlist', 'report', 'clientinfo', 'pracinfo'));
    }

    /**
     *
     * @return Redirect
     */
    public function update()
    {
        $rqid = $_POST['rqid'];
        $reportid = $_POST['reportid'];
        $answers = $_POST['answersid'];

        $report = Report::find($reportid);
        $report->updated_at = Carbon::now();
        $report->save();

        $i = 0;
        foreach($answers as $updatedanswer)
        {
            DB::update("update question_report set answers ='" . $updatedanswer . "' where rqid = ?", array($rqid[$i]));
            $i++;
        }

        Session::flash('flash_message', 'Report successfully updated!');

        return redirect("reports/Assessment/" . $reportid);
    }

    public function test()
    {
        $questions = Question::Assessment()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $clients = User::latest('created_at')->MyClient()->get();
        $questions_category = Question::Assessment()->distinct()->lists('category_id');

        $questionslist = array();
        $categories = array();
        foreach ($questions_category as $category_id)
        {
            $categories[] = Category::find($category_id);
            $questionslist[] = Question::Assessment()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
        }
        //dd($questionslist[0][0]);
        return view('reports.createTest', compact('questions', 'categories','clients', 'questionslist'));
    }

    public function showtest()
    {
        $questions = Question::Assessment()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $clients = User::latest('created_at')->MyClient()->get();
        $questions_category = Question::Assessment()->distinct()->lists('category_id');

        $questionslist = array();
        $categories = array();
        foreach ($questions_category as $category_id)
        {
            $categories[] = Category::find($category_id);
            $questionslist[] = Question::Assessment()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
        }
        //dd($questionslist[0][0]);
        return view('test', compact('questions', 'categories','clients', 'questionslist'));

    }
}
