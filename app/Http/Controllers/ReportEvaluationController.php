<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use DB;
use Auth;
use Carbon\Carbon;
use App\Report;
use App\Question;
use App\Practitioner;
use App\User;
use App\Category;
use App\Assessment;
use App\Selection;
use App\Evaluation;

class ReportEvaluationController extends Controller
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
    public function index($report_id)
    {
        //$questions = Question::Evaluation()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $report = Report::find($report_id);
        $assessment = Assessment::GetAssessment($report->id)->first(); 
        $practitioner = Practitioner::find($report->prac_id);
        
        $client = User::find($report->userid); 
        $questions_category = Question::Evaluation()->distinct()->lists('category_id');

        $bodyfunctions = $assessment->questions()->GetBodyStructure()->get();
        $activities = $assessment->questions()->GetActivities()->get();
        $envfactors = $assessment->questions()->GetEnvFactors()->get();
        $personalfactors = $assessment->questions()->GetPersonalFactors()->get();
        
        $categories = array();
        $questionslist = array();
        foreach ($questions_category as $category_id)
        {   
            $categories[] = Category::find($category_id);
            if($category_id === 2)
            {   
                $cat2 = Question::Evaluation()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $bodyfunctions = $bodyfunctions->merge($cat2);
                $questionslist[] =  $bodyfunctions;
            }
            elseif($category_id === 3)
            {
                $cat3 = Question::Evaluation()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $activities = $activities->merge($cat3);
                $questionslist[] =  $activities;

            }
            elseif($category_id === 4)
            {   
                 $cat4 = Question::Evaluation()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $envfactors = $envfactors->merge($cat4);
                $questionslist[] =  $envfactors;

            }   
            elseif($category_id === 5)
            {   
                $cat5 = Question::Evaluation()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $personalfactors = $personalfactors->merge($cat5);
                $questionslist[] =  $personalfactors;

            }
            else
            {

             $questionslist[] = Question::Evaluation()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
            }
        }

        $submitButtonText = "Upload Evaluation Report";
        $evaluation ="true";
        $thumbnail_dist = 100 /count($questions_category);
        
        return view('reports.createEvaluation', compact('report','client','evaluation','questionslist','practitioner','thumbnail_dist','categories','submitButtonText'));
    }

     /**
     * Store a report in Evaluation.
     *
     * @return Response
     */
    public function store()
    {
        $report_id = $_POST['report_id'];
        $report = Report::find($report_id);
 
        $evaluation = new Evaluation;
        $evaluation->report_id = $report->id;
        $evaluation->prac_id = Session::get('prac_id');
        $success_save = $evaluation->save();

        if($success_save === true)
        {
            $report->step = 3;
            $report->save();

            $questionlist = Question::Evaluation()->lists('id'); 

            foreach ($questionlist as $questionid) 
            {
                $evaluation->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
            }
        }

        

        Session::flash('flash_message', "Your new Evaluation report has been successfully created.");

        return redirect()->action('ReportEvaluationController@overview', [$report_id]);
    }

     /**
     * Load selection manager resources.
     *
     * @return Response
     */
    public function overview($report_id)
    {   
        $evaluations = Evaluation::GetEvaluation($report_id)->latest('updated_at')->get();
        $report = Report::find($report_id);
        $client = User::find($report->id);
        $practitioners = Practitioner::all();

        //  $practitioners = Practitioner::all();
      //  $practitioner = $practitioners->where('id', $report->prac_id)->first();

        $evaluationlist = array();
        foreach($evaluations as $evaluation)
        {       
            $practitioner = $practitioners->where('id' , $evaluation->prac_id)->first();

            $select_date = $evaluation->updated_at;
            if($evaluation->updated_at = Carbon::today())
            {
                $date = "Today, " . date('h:ia', strtotime($evaluation->updated_at));
            }
            else
            {
                $date = date('F d, Y', strtotime($version['updated_at']));
            }

            $evaluation_product = $evaluation->questions()->GetProduct()->first()->pivot->answers;

            $evaluationlist[] = ['prac_name'=>$practitioner->fname . " " . $practitioner->sname,
                                'client_name' => $client->fname . " " . $client->sname,
                                'id'=>$evaluation->id,
                                'date'=>$date,
                                'product'=>$evaluation_product];
                      
        }
      
        return view('reports.selectionoverview', compact('evaluationlist', 'report', 'clientname'));
        
    }

    public function show($evaluation_id)
    {
        $evaluation = Evaluation::find($evaluation_id);
        $practitioner = Practitioner::find($evaluation->prac_id);
        $report = Report::find($evaluation->report_id);
        $client = User::find($report->userid); 
        $assessment = Assessment::GetAssessment($report->id)->first();

        $arraycount = $evaluation->questions()->distinct()->orderBy('category_id', 'ASC')->lists('category_id');

        $bodyfunctions = $assessment->questions()->GetBodyStructure()->get();
        $activities = $assessment->questions()->GetActivities()->get();
        $envfactors = $assessment->questions()->GetEnvFactors()->get();
        $personalfactors = $assessment->questions()->GetPersonalFactors()->get();
        
        $categories = array();
        $answerlist = array();
        foreach ($arraycount as $category_id)
        {   
            $categories[] = Category::find($category_id);
            if($category_id === 2)
            {   
                $cat2 = $evaluation->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $bodyfunctions = $bodyfunctions->merge($cat2);
                $answerlist[] =  $bodyfunctions;
            }
            elseif($category_id === 3)
            {
                $cat3 = $evaluation->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $activities = $activities->merge($cat3);
                $answerlist[] =  $activities;

            }
            elseif($category_id === 4)
            {   
                 $cat4 = $evaluation->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $envfactors = $envfactors->merge($cat4);
                $answerlist[] =  $envfactors;

            }   
            elseif($category_id === 5)
            {   
                $cat5 = $evaluation->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $personalfactors = $personalfactors->merge($cat5);
                $answerlist[] =  $personalfactors;

            }
            else
            {
             $answerlist[] = $evaluation->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
            }
        }

        $is_evaluation = true;
        $submitButtonText = "Update Evaluation Report";
        $thumbnail_dist = 100 /count($arraycount);
        return view('reports.showEvaluation', compact('evaluation', 'answerlist','report','client','practitioner','thumbnail_dist','categories','is_evaluation','submitButtonText'));
    }

     public function update()
    {
        $answers = $_POST['answersid'];
        $selectid = $_POST['selectid'];

        $i = 0;
        foreach($answers as $updatedanswer)
        {
            DB::update("update question_selection set answers ='" . $updatedanswer . "' where rqid = ?", array($rqid[$i]));
            $i++;
        }

        Session::flash('flash_message', 'Report successfully updated!');

        return redirect()->action('ReportSelectionController@show', [$selectid]);
    }

    public function delete()
    {
        $selectionid = $_POST['selectid'];
        $reportid = $_POST['reportid'];
        $deleteselection = Selection::find($selectionid);
        $deleteselection->delete();

        Session::flash('flash_message', "Report number $selectionid has been successfully deleted.");

        return redirect()->action('ReportSelectionController@overview', [$reportid]);
    }

        public function generatereport($select_id)
    {

        $selection = Selection::find($select_id);
        $practitioner = Practitioner::find($selection->prac_id)->first();
        $pracname = $practitioner->fname . " " . $practitioner->sname;
        $report = Report::find($selection->report_id);      
        $clientname = User::find($report->userid)->fname ." ". User::find($report->userid)->sname;
        $arraycount = $selection->questions()->distinct()->Selection()->orderBy('category_id', 'ASC')->lists('category_id');
        $bodyfunctions = $report->questions()->Assessment()->GetBodyStructure()->get();
        $activities = $report->questions()->Assessment()->GetActivities()->get();
        $envfactors = $report->questions()->Assessment()->GetEnvFactors()->get();
        $personalfactors = $report->questions()->Assessment()->GetPersonalFactors()->get();
        
        $categories = array();
        $answerlist = array();
        foreach ($arraycount as $category_id)
        {   
            $categories[] = Category::find($category_id);
            if($category_id === 2)
            {   
                $cat2 = $selection->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $bodyfunctions = $bodyfunctions->merge($cat2);
                $answerlist[] =  $bodyfunctions;
            }
            elseif($category_id === 3)
            {
                $cat3 = $selection->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $activities = $activities->merge($cat3);
                $answerlist[] =  $activities;

            }
            elseif($category_id === 4)
            {   
                 $cat4 = $selection->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $envfactors = $envfactors->merge($cat4);
                $answerlist[] =  $envfactors;

            }   
            elseif($category_id === 5)
            {   
                $cat5 = $selection->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $personalfactors = $personalfactors->merge($cat5);
                $answerlist[] =  $personalfactors;

            }
            else
            { 
                $answerlist[] = $selection->questions();
            }            
        }

      $pdf = \PDF::loadView('practitioner.reportManager.reportSelectionPDF', compact('selection', 'clientname', 'answerlist','report','pracname','categories'));
      return $pdf->stream('slectionReport.pdf',array("Attachment" => 0));
    }

}
