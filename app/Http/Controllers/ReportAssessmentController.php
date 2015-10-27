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
                if ((Auth::guest()) && (!Session::has('prac_id')))
                {
                   return redirect('/unauthorizedaccess');
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
        if((Auth::check()) || (Session::has('is_admin')))
        {
            return redirect('/unauthorizedaccess');
        }

        $clients = User::latest('created_at')->MyClient()->get();

        if($clients->isEmpty())
        {   
            Session::put('info_title', 'No Registered clients found.');
            Session::put('info_message', 'Please create one first.');
            Session::put('missing_info', '1');
            Session::put('report_noclients', '1');

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

    public function setCurrentVersion(Request $request)
    {   
        if(Auth::check())
        {
            return redirect('/unauthorizedaccess');
        }

        if($request !== null)
        {  
            $assessment_id = $request->assessment_id;
            $version_id =  $request->version_id;
            $version_number = $request->version_number;

            $assessment = Assessment::find($assessment_id);
            $assessment->current_version = $version_id;
            $saved = $assessment->save();    
        }
        else
        {
            $has_error = true;
        }

        if((isset($has_error)) || ($saved === false))
        {
            Session::flash('error_message', "An issue was encountered while attempting to modify the version. Process aborted :("); 
        }
        else
        {
            Session::put('flash_message', "Assessment has been modified to version $version_number!"); 
        }

        return Redirect::back();
    }

    /**
     * Store a report in step one.
     *
     * @return Response
     */
    public function store()
    {   
        if((Auth::check()) || (Session::has('is_admin')))
        {
            return redirect('/unauthorizedaccess');
        }

        $client_id = $_POST['client'];
        $practitioner_id = Session::get('prac_id');

        $report = new Report;
        $report->userid = $client_id;
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

        Session::put('flash_message', 'New report successfully created!');
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
        
        if($report === null)
        {
            return redirect('/unauthorizedaccess');
        }

        $client = User::find($report->userid);

        if(Auth::check())
        {
            if(Auth::user()->id !== $report->userid)
            { 
                return redirect('/unauthorizedaccess');
            }
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

         $practitioners = Practitioner::all();
         $practitioner = $practitioners->where('id', $report->prac_id)->first();

        $assessment = Assessment::GetAssessment($report_id)->first();
        
        if(Session::has('prac_id'))
        {
            $versions = Version::GetVersion($report->id)
                        ->ByAssessment()
                        ->orderBy('updated_at', 'asc')
                        ->get(); 

            $i =1;
            $versionlist = array();
            foreach ($versions as $version) 
            {   
                $creator_name = $practitioners->where('id', $version->prac_id)->first();

                if($version->prac_id === Session::get('prac_id'))
                {
                    $creator_name = 'You';
                }
                else
                {
                    $creator_name = $creator->fname . " " . $creator->sname;
                }

                if($version->id === $assessment->current_version)
                {
                    $currentversion = ['id'=>$version->id,
                        'practitioner_name'=> $creator_name,
                        'version_number'=>$i,
                        'updated_at'=>$version->updated_at];

                    if($version->prac_id === Session::get('prac_id'))
                    {
                        $submitButtonText = "Click here to update or create a new version";
                    }
                    else
                    {
                        $submitButtonText = "Save as new version";
                    }
                }

                $versionlist[] = ['id'=>$version->id,
                        'practitioner_name'=> $creator_name,
                        'version_number'=>$i,
                        'updated_at'=>$version->updated_at];
                 $i++;
            }  
        }

        $categories_id = $assessment->questions()->where('version_id','=',$assessment->current_version)->distinct()->orderBy('category_id', 'ASC')->lists('category_id');

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

        $thumbnail_dist = 100 /count($categories_id);

        return view('reports.showAssessment', compact('answerlist','versionlist','currentversion','report','assessment', 'client', 'practitioner','thumbnail_dist','categories','submitButtonText'));
    }

    /**
     *
     * @return Redirect
     */
    public function checkhistory()
    {
        $assessment_id = $_POST['assessment_id'];
        $reportid = $_POST['report_id'];
        $assessment_id = $_POST['assessment_id'];
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

        $version = Version::find($assessment->current_version);    

        if($version->prac_id === Session::get('prac_id'))
        {
            Session::put('is_owner','true');
        } 
        else
        {
            Session::forget('is_owner');
        }                        
                                    
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
                Session::put('flash_message', 'Create_New_Version!');
                Session::put('modified_answers', $answers);
                Session::put('current_assessment', $assessment);
                Session::put('current_version_number', $current_version_number);

                return redirect("reports/assessment/view/" . $reportid);

            }
            elseif(isset($matching_version))
            {   
                $assessment->current_version = $matching_version;
                $assessment->save();
                Session::put('flash_message', 'Your results matches an existing version. Successfully loaded existing version.');
            }
        }
        else
        {
             Session::put('flash_message', 'No changes detected');
        }

        return redirect("reports/assessment/view/" . $reportid);
            
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
            $current_version = $_POST['version_number'];
            $current_date = Carbon::now();

            $totalAnswers = count($answers);

            for ($a = 1; $a < $totalAnswers + 1; $a++) 
            {
                DB::table('assessment_answers')
                    ->where('assessment_id', $assessment->id)
                    ->where('version_id', $assessment->current_version)
                    ->where('question_id', $a)
                    ->update(['answers' => $answers[$a], 'updated_at' => $current_date]);
            }

            Session::flash('flash_message', "Updated version $current_version ");

            return Redirect::back();

        }
       

    }
}
