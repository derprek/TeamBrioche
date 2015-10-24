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
use App\Version;

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
        $clients = User::latest('created_at')->MyClient()->get();

        if($clients->isEmpty())
        {   
            Session::flash('error_title', 'No Registered clients found.');
            Session::flash('error_message', 'Please create one first.');
            return redirect('practitioner/clientmanager');
        }
        else
        {   
            $questions = Question::Assessment()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
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
        
        $submitButtonText = "Upload Assessment Report";
        $thumbnail_dist = 100 /count($questions_category);
        return view('reports.createAssessment', compact('questions', 'categories','clients', 'questionslist','thumbnail_dist','submitButtonText'));
        }
        
    }

    public function setCurrentVersion($ids)
    {   
        if($ids !== null)
        {
            $get_ids = explode(",",$ids);
           
            if(count($get_ids) === 3)
            {
                 $assessment_id = $get_ids[0];
                 $version_id = $get_ids[1];
                 $version_number = $get_ids[2];

                 $assessment = Assessment::find($assessment_id);
                 $assessment->current_version = $version_id;
                 $assessment->save();

                Session::flash('flash_message', "Version has been modified to version $version_number!"); 
                return Redirect::back();
            }
        }
    
    }

    /**
     * Store a report in step one.
     *
     * @return Response
     */
    public function store()
    {
        $client = $_POST['client'];
        $practitioner_id = Session::get('prac_id');

        $report = new Report;
        $report->userid = $client;
        $report->step = '1';
        $report->status = 'In Progress';
        $report->prac_id = $practitioner_id;
        $report->save();

        $version = new Version;
        $version->report_id = $report->id;
        $version->report_type = 1;
        $version->prac_id = $practitioner_id;
        $version->save();

        $assessment = new Assessment;
        $assessment->report_id = $report->id;
        $assessment->current_version = $version->id;
        $assessment->save();

        $questionlist = Question::Assessment()->lists('id');

        foreach ($questionlist as $questionid) 
        {
            $assessment->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid], 'version_id' => $version->id));
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
        $assessment = Assessment::GetAssessment($report_id)->first();
        $client = User::find($report->userid);
        $practitioners = Practitioner::all();
        $practitioner = $practitioners->where('id', $report->prac_id)->first();

        $categories_id = $assessment->questions()->where('version_id','=',$assessment->current_version)->distinct()->orderBy('category_id', 'ASC')->lists('category_id');

        $versions = Version::GetVersion($report->id)
                        ->ByAssessment()
                        ->orderBy('updated_at', 'asc')
                        ->get(); 
        $i =1;
        $versionlist = array();
        foreach ($versions as $version) 
        {   
            $practitioner = $practitioners->where('id', $version->prac_id)->first();

            if($version->id === $assessment->current_version)
            {
                $currentversion = ['id'=>$version->id,
                    'practitioner_name'=> $practitioner->fname . " " . $practitioner->sname,
                    'version_number'=>$i,
                    'updated_at'=>$version->updated_at];
            }

            $versionlist[] = ['id'=>$version->id,
                    'practitioner_name'=> $practitioner->fname . " " . $practitioner->sname,
                    'version_number'=>$i,
                    'updated_at'=>$version->updated_at];
             $i++;
        }  

        $categories = array();
        $answerlist = array();
        foreach ($categories_id as $category_id) 
        {   
            $categories[] = Category::find($category_id);
            $answerlist[] = $assessment->questions()
                ->where('version_id','=',$assessment->current_version)
                ->Getquestionsbycat($category_id)
                ->orderBy('type', 'DESC')
                ->get();
        }

        $submitButtonText = "Update Assessment Report";
        $thumbnail_dist = 100 /count($categories_id);

        return view('reports.showAssessment', compact('answerlist','versionlist','currentversion','report','assessment', 'client', 'practitioner','thumbnail_dist','categories','submitButtonText'));
    }

    /**
     *
     * @return Redirect
     */
    public function checkhistory()
    {
        $id = $_POST['id'];
        $assessment_id = $_POST['assessment_id'];
        $reportid = $_POST['report_id'];
        $answers = $_POST['answersid'];
        $current_version_number = $_POST['current_version'];
        ksort($answers);

        $new_version = false;
        $has_changes = false;
        
        $assessment = Assessment::find($assessment_id);
        
        //check against current
        $currentversion = $assessment->questions()
                                     ->where('version_id', '=', $assessment->current_version)
                                     ->orderBy('question_id', 'ASC')
                                     ->get();
                                    
        $answercounter = count($answers);
        $i = 1;
        for ($a = 0; $a < $answercounter; $a++) 
        {
            if ($currentversion[$a]->pivot->answers !== $answers[$i])
            {
                $has_changes = true;
            } $i++;

        }
        
        //check against history if its different
        if($has_changes === true)
        {   
            $historycount = $assessment->questions()
                            ->where('version_id', '!=', $assessment->current_version)
                            ->distinct()
                            ->lists('version_id');

            if(count($historycount) !== 0)
            {   
                 $assessment_version = array();
                 foreach ($historycount as $version_id) 
                 {   
                   $version_mismatch = false;
                   $assessment_version = $assessment->questions()
                                       ->where('version_id', '=', $version_id)
                                       ->orderBy('question_id', 'ASC')
                                       ->get();

                   $question_counter = count($assessment_version); 

                    $i=1;
                    for ($a = 0; $a < $question_counter; $a++) 
                        {
                            if ($assessment_version[$a]->pivot->answers !== $answers[$i])
                            {
                               $version_mismatch = true;
                            } $i++;
                        }

                    // if still false
                    if($version_mismatch === false)
                        {   
                            $matching_version = $version_id;
                        }
                    
                  }
            }
            else
            {
                $new_version = true;
            }

            if(($new_version === true) || (!isset($matching_version)))
            {  
                Session::flash('flash_message', 'Create_New_Version!');
                Session::put('modified_answers', $answers);
                Session::put('current_assessment', $assessment);

                return redirect("reports/Assessment/" . $reportid)->with('version_number', $current_version_number);;

            }
            elseif(isset($matching_version))
            {   
                $assessment->current_version = $matching_version;
                $assessment->save();
                Session::flash('flash_message', 'Modified version');
            }
        }
        else
        {
             Session::flash('flash_message', 'No changes!');
        }

        return redirect("reports/Assessment/" . $reportid);
            
    }

    public function storeNewVersion()
    {   
        if((!Session::has('modified_answers')) || (!Session::has('current_assessment')))
        {
             return Redirect::back();
        }
        else
        {
            $assessment = Session::pull('current_assessment');
            $answers = Session::pull('modified_answers');

            $newversion = new Version;
            $newversion->report_id = $assessment->report_id;
            $newversion->report_type = 1;
            $newversion->prac_id = Session::get('prac_id');
            $newversion->save();

            $totalAnswers = count($answers);
           
            for ($a = 1; $a < $totalAnswers + 1; $a++) 
            {   
                $assessment->questions()->attach($a, array('answers' => $answers[$a], 'version_id' => $newversion->id));
            } 

            $assessment->current_version = $newversion->id;
            $assessment->save();

          Session::flash('flash_message', 'New Version added!');

          return Redirect::back();
        }
       
    }

    public function update()
    {   
        if((!Session::has('modified_answers')) || (!Session::has('current_assessment')))
        {
             return Redirect::back();
        }
        else
        {

            $assessment = Session::pull('current_assessment');
            $answers = Session::pull('modified_answers');

            $totalAnswers = count($answers);

            for ($a = 1; $a < $totalAnswers + 1; $a++) 
            {
                DB::table('assessment_answers')
                    ->where('assessment_id', $assessment->id)
                    ->where('version_id', $assessment->current_version)
                    ->where('question_id', $a)
                    ->update(['answers' => $answers[$a], 'updated_at' => Carbon::now()]);
            }

            Session::flash('flash_message', "Updated version {{ $assessment->current_version }}");

            return Redirect::back();

        }
       

    }
}
