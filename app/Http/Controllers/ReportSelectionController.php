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
use App\Manager;
use App\Practitioner;
use App\User;
use App\Product;
use App\Tag;
use App\Category;
use App\Selection;
use App\Subcategory;

class ReportSelectionController extends Controller
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
        $questions = Question::Selection()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $report = Report::find($report_id);
        $pracname = Practitioner::find($report->prac_id)->fsname . " " . Practitioner::find($report->prac_id)->sname;
        
        $client_id = User::find($report->userid)->id;
        $clientname = User::find($report->userid)->fname ." ". User::find($report->userid)->sname;
        $questions_category = Question::Selection()->distinct()->lists('category_id');

        $bodyfunctions = $report->questions()->Assessment()->GetBodyStructure()->get();
        $activities = $report->questions()->Assessment()->GetActivities()->get();
        $envfactors = $report->questions()->Assessment()->GetEnvFactors()->get();
        $personalfactors = $report->questions()->Assessment()->GetPersonalFactors()->get();
        
        $categories = array();
        $questionslist = array();
        foreach ($questions_category as $category_id)
        {   
            $categories[] = Category::find($category_id);
            if($category_id === 2)
            {   
                $cat2 = Question::Selection()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $bodyfunctions = $bodyfunctions->merge($cat2);
                $questionslist[] =  $bodyfunctions;
            }
            elseif($category_id === 3)
            {
                $cat3 = Question::Selection()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $activities = $activities->merge($cat3);
                $questionslist[] =  $activities;

            }
            elseif($category_id === 4)
            {   
                 $cat4 = Question::Selection()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $envfactors = $envfactors->merge($cat4);
                $questionslist[] =  $envfactors;

            }   
            elseif($category_id === 5)
            {   
                $cat5 = Question::Selection()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();

                $personalfactors = $personalfactors->merge($cat5);
                $questionslist[] =  $personalfactors;

            }
            else
            {

             $questionslist[] = Question::Selection()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
            }
        }
        $submitButtonText = "Upload Evaluation Report";
        $evaluation ="true";
        $thumbnail_dist = 100 /count($questions_category);
        return view('reports.createSelection', compact('questions', 'clientname','evaluation','questionslist','pracname','report_id','client_id','thumbnail_dist','categories','submitButtonText'));
    }

     /**
     * Store a report in Selection.
     *
     * @return Response
     */
    public function store()
    {
        $report_id = $_POST['reportid'];
        $client_id = $_POST['clientid'];

        $report = Report::find($report_id);
        $selection = new Selection;

        $selection->report_id = $report_id;
        $selection->prac_id = Session::get('prac_id');
        $selection->userid = $client_id;
        $selection->save();

        $questioncount = Question::Selection()->lists('id');

        foreach ($questioncount as $questionid) {
            $selection->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
        }

        Session::flash('flash_message', "Your new report has been successfully created.");

        return redirect()->action('ReportSelectionController@overview', [$report_id]);
    }

     /**
     * Load selection manager resources.
     *
     * @return Response
     */
    public function overview($report_id)
    {   
        $selection = Selection::latest('updated_at')->GetReports($report_id)->get();
        $report = Report::find($report_id);
        $clientname = User::find($report->userid)->first()->fname . " " . User::find($report->userid)->first()->sname;
      //  dd($selection);
        

        $selectionlist = array();
        foreach($selection as $selectionreport)
        {       
            $pracname = Practitioner::find($selectionreport->prac_id)->fname . " " . Practitioner::find($selectionreport->prac_id)->sname;;
            $select_id = $selectionreport->id;
            $select_date = $selectionreport->updated_at;
            $selection_prod = $selectionreport->questions()->where('question_id','=', 27)->first()->pivot->answers;

            $selectionlist[] = ['name'=>$pracname,
                                'id'=>$select_id,
                                'date'=>$select_date,
                                'product'=>$selection_prod];
                      
        }
       

        return view('reports.selectionoverview', compact('selectionlist', 'report', 'clientname'));
        
    }

    public function show($select_id)
    {

        $selection = Selection::find($select_id);
        $practitioner = Practitioner::find($selection->prac_id)->first();
        $pracname = $practitioner->fname . " " . $practitioner->sname;
        $report = Report::find($selection->report_id);
       
        $client_id = User::find($report->userid)->id;
        $clientname = User::find($report->userid)->fname ." ". User::find($report->userid)->sname;

        $arraycount = $selection->questions()->distinct()->Selection()->orderBy('category_id', 'ASC')->lists('category_id');
        //dd($arraycount);

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

             $answerlist[] = $selection->questions()
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
            }
            
        }
        $evaluation ="true";
        $thumbnail_dist = 100 /count($arraycount);
        return view('reports.showSelection', compact('selection', 'clientname', 'answerlist','report','client_id','pracname','evaluation','thumbnail_dist','categories'));
    }

     public function update()
    {
        $rqid = $_POST['rqid'];
        $reportid = $_POST['reportid'];
        $answers = $_POST['answersid'];
        $selectid = $_POST['selectid'];
       //dd($answers);

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

}
