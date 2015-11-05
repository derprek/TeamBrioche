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
use App\Assessment;
use App\Typology;

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
                if ((Auth::guest()) && (!Session::has('prac_id')))
                {
                    return redirect('/unauthorizedaccess');
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
        if((Auth::check()) || (Session::has('is_admin')))
        {
            return redirect('/unauthorizedaccess');
        }

        $report = Report::find($report_id);
        $practitioner = Practitioner::find($report->prac_id);
        $client = User::find($report->userid);

        $assessment = Assessment::GetAssessment($report->id)->first();
        $fetchgoals = $assessment->questions()->Assessment()->GetGoals()->first();
        $goals = $fetchgoals->pivot->answers;

        $questions_category = Question::Typology()->distinct()->lists('category_id');

        $categories = array();
        $questionslist = array();
        foreach ($questions_category as $category_id) {

            $categories[] = Category::find($category_id);
            $questionslist[] = Question::Typology()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
        }
        
        $submitButtonText = "Upload Typology Report";
        $thumbnail_dist = 100 /count($questions_category);
        return view('reports.createTypology', compact('questions', 'goals','questionslist', 'report_id','client','practitioner','thumbnail_dist','categories','submitButtonText'));
    }

     public function show($report_id)
    {
        $report = Report::find($report_id);
        $typology = Typology::GetTypology($report->id)->first();

        if(($report === null) || ($typology === null))
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
        $practitioner = Practitioner::find($report->prac_id);

        $assessment = Assessment::GetAssessment($report->id)->first(); 
        $fetchgoals = $assessment->questions()->GetGoals()->first();
        $goals = $fetchgoals->pivot->answers;

        
        $arraycount = $typology->questions()->distinct()->Typology()->orderBy('category_id', 'ASC')->lists('category_id');

        $categories = array();
        $answerlist = array();
        foreach ($arraycount as $ans) 
        {
            $categories[] = Category::find($ans);
            $answerlist[] = $typology->questions()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }
        
        $submitButtonText = "Update Typology Report";
        $thumbnail_dist = 100 /count($arraycount);
        return view('reports.showTypology', compact('answerlist','report','typology','goals', 'client', 'practitioner','thumbnail_dist','categories','submitButtonText'));
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
        
        $typology = new Typology;
        $typology->report_id = $report->id;
        $success_save = $typology->save();

        if($success_save === true)
        {
            $report->step = 2;
            $report->save();

            $questionlist = Question::Typology()->lists('id');

            foreach ($questionlist as $questionid) 
            {
                $typology->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
            }
        }

        Session::put('flash_message', 'Typology successfully created!');
        return redirect()->action('ReportOverviewController@index', [$report_id]);
    }

    public function update()
    {
        $typology = Typology::find($_POST['typology_id']);
        $answers = $_POST['answersid'];
        $questions = Question::Typology()->lists('id');

            foreach($questions as $id)
            {
               DB::table('typology_answers')
                    ->where('typology_id', $typology->id)
                    ->where('question_id', $id)
                    ->update(['answers' => $answers[$id], 'updated_at' => Carbon::now()]);
            }
        
        Session::flash('flash_message', 'Typology successfully updated!');
        return redirect("reports/typology/view/" . $typology->report_id);
    }

    public function generatereport($report_id)
    {
        $report = Report::find($report_id);
        $typology = Typology::GetTypology($report->id)->get();
        $assessment = Assessment::GetAssessment($report->id)->get();
        $clientinfo = User::find($report->userid);
        $pracinfo = Practitioner::find($report->prac_id);

        $fetchgoals = $assessment->questions()->GetGoals()->first();
        $goals = $fetchgoals->pivot->answers;
        $arraycount = $typology->questions()->distinct()->orderBy('category_id', 'ASC')->lists('category_id');

        $categories = array();
        $answerlist = array();
        foreach ($arraycount as $ans) 
        {
            $categories[] = Category::find($ans);
            $answerlist[] = $report->questions()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }
        //dd($categories);
       
       //'answerlist','report','goals', 'clientinfo', 'pracinfo','thumbnail_dist','categories'
      $pdf = \PDF::loadView('practitioner.reportManager.reportTypologyPDF', compact('answerlist','report','clientinfo','pracinfo','goals'));

      return $pdf->stream('trypologyReport.pdf',array("Attachment" => 0));
    }
}
