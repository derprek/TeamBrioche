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
use App\Evaluation;

/**
 * Class ReportEvaluationController
 * @package App\Http\Controllers
 */
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

               if ((Auth::guest()) && (!Session::has('prac_id')))
               {
                    return redirect('/unauthorizedaccess');
               }
                
        });
    }

    /**
     * loads the view of creation of a new evaluation report
     *
     * @return Response
     */
    public function index($report_id)
    {   
        if((Auth::check()) || (Session::has('is_admin')))
        {
            return redirect('/unauthorizedaccess');
        }
        
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
     * controls the storage of a new evaluation
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

        Session::put('flash_message', "Evaluation successfully created!");

        return redirect()->action('ReportEvaluationController@overview', [$report_id]);
    }

     /**
     * loads the overview for all evaluation reports that is associated to this report
     *
     * @return Response
     */
    public function overview($report_id)
    {   
        $report = Report::find($report_id);

        if($report === null)
        {
            return redirect('/unauthorizedaccess');
        }

        //checks if practitioner has rights to view this report
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

        $evaluations = Evaluation::GetEvaluation($report_id)->latest('updated_at')->get();


        $client = User::find($report->userid);
        $practitioners = Practitioner::all();

        if(($report === null ) || ($client === null))
        {
            Session::put('error_message', 'There seems to be an problem retrieving this evaluation');
            return redirect()->back();
        }
        else
        {
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
        }
        
        return view('reports.evaluationoverview', compact('evaluationlist', 'report', 'clientname'));
        
    }

    /**
     * loads the view that displays the information of a evaluation
     *
     * @param $evaluation_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show($evaluation_id)
    {
        $evaluation = Evaluation::find($evaluation_id);

        if($evaluation === null)
        {
            return redirect('/unauthorizedaccess');
        }

        $report = Report::find($evaluation->report_id);

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

        $practitioner = Practitioner::find($evaluation->prac_id);
        $report = Report::find($evaluation->report_id);
        $client = User::find($report->userid); 
        $assessment = Assessment::GetAssessment($report->id)->first();

        $categories_id = $evaluation->questions()->distinct()->orderBy('category_id', 'ASC')->lists('category_id');

        $bodyfunctions = $assessment->questions()->GetBodyStructure()->get();
        $activities = $assessment->questions()->GetActivities()->get();
        $envfactors = $assessment->questions()->GetEnvFactors()->get();
        $personalfactors = $assessment->questions()->GetPersonalFactors()->get();
        
        $categories = array();
        $answerlist = array();
        foreach ($categories_id as $category_id)
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
        $thumbnail_dist = 100 /count($categories_id);
        return view('reports.showEvaluation', compact('evaluation', 'answerlist','report','client','practitioner','thumbnail_dist','categories','is_evaluation','submitButtonText'));
    }

    /**
     * controls the updating of evaluation answers
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {   
        $evaluation = Evaluation::find($request->evaluation_id);

        $answers = $_POST['answersid'];
        $questions = Question::Evaluation()->lists('id');

            foreach($questions as $id)
            {
               DB::table('evaluation_answers')
                    ->where('evaluation_id', $evaluation->id)
                    ->where('question_id', $id)
                    ->update(['answers' => $answers[$id], 'updated_at' => Carbon::now()]);
            }

        Session::flash('flash_message', 'Evaluation successfully updated!');

        return redirect()->action('ReportEvaluationController@show', [$evaluation->id]);
    }
}
